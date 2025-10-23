<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->nullable();
            $table->string('basket_id')->nullable();
            $table->string('issuer_name')->nullable();
            $table->string('payment_name')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('status', ['success', 'failed'])->default('failed');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
