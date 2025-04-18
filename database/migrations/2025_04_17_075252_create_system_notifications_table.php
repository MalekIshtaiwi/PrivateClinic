<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // sms, whatsapp
            $table->text('message');
            $table->string('status'); // sent, failed
            $table->timestamp('sent_at')->nullable();
            $table->timestamps(); // Both created_at and updated_at for ORM compatibility
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_notifications');
    }
};
