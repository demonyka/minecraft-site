<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\Payment\YookassaService;
use Illuminate\Http\Request;
use Illuminate\Notifications\Events\NotificationFailed;
use YooKassa\Common\Exceptions\ApiException;
use YooKassa\Common\Exceptions\BadApiRequestException;
use YooKassa\Common\Exceptions\ExtensionNotFoundException;
use YooKassa\Common\Exceptions\ForbiddenException;
use YooKassa\Common\Exceptions\InternalServerError;
use YooKassa\Common\Exceptions\NotFoundException;
use YooKassa\Common\Exceptions\ResponseProcessingException;
use YooKassa\Common\Exceptions\TooManyRequestsException;
use YooKassa\Common\Exceptions\UnauthorizedException;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;

class YookassaController extends Controller
{
    public function create(Request $request, YookassaService $service)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100|max:10000',
        ]);
        $amount = (float)$request->input("amount");
        $description = "Пополнение баланса из ЛК";

        $payment = Payment::create([
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'method' => 'yookassa',
            'description' => $description,
        ]);

        $url = $service->createPayment($amount, $description, [
            'payment_id' => $payment->id,
        ]);

        return response()->json(['url' => $url]);
    }

    /**
     * @throws NotFoundException
     * @throws ResponseProcessingException
     * @throws ApiException
     * @throws ExtensionNotFoundException
     * @throws BadApiRequestException
     * @throws InternalServerError
     * @throws ForbiddenException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     */
    public function callback(Request $request, YookassaService $service)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        if ($requestBody && isset($requestBody['event'])) {
            $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);
            $object = $notification->getObject();

            if (isset($object->status) && $object->status == 'waiting_for_capture') {
                $service->getClient()->capturePayment([
                    'amount' => $object->amount,
                ], $object->id, uniqid('', true));
            }

            if (isset($object->status) && $object->status == 'succeeded') {
                if ($object->paid === true) {
                    $metadata = $object->metadata;
                    if (isset($metadata->payment_id)) {
                        $paymentId = $metadata->payment_id;
                        $payment = Payment::find($paymentId);
                        \Log::debug('payment id: ' . $paymentId);
                        $payment->status = 'confirmed';
                        $payment->save();

                        $user = $payment->user();
                        $user->addBalance($payment->amount);
                    }
                }
            }
        }
    }
}
