<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['skin_id']);
            $table->dropColumn('skin_id');
            $table->string('skin_path')->nullable()->after('password');
        });
        Schema::dropIfExists('skins');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('skin_path');
        });
        Schema::create('skins', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('skin_id')->nullable()->after('password');
            $table->foreign('skin_id')->references('id')->on('skins')->onDelete('set null');
        });
    }
};
