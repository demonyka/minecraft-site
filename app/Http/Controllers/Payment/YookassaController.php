<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\Payment\YookassaService;
use Illuminate\Http\Request;
use Illuminate\Notifications\Events\NotificationFailed;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;

class YookassaController extends Controller
{
    public function create(Request $request, YookassaService $service)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100|max:10000',
        ])
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
    public function callback(Request $request, YookassaService $service)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);
        $notificationObject = $notification->getObject();
        if (isset($notificationObject->status) && $notificationObject->status === 'succeeded') {
            if ($notificationObject->paid === true) {
                $metadata = (object)$notificationObject->metadata;
                if (isset($metadata->payment_id)) {
                    $paymentId = $metadata->payment_id;
                    $payment = Payment::find($paymentId);
                    $payment->status = 'confirmed';
                    $payment->save();
                    $user = $payment->user;
                    $user->addBalance($payment->amount * 100);
                }
            }
        }
    }
}
