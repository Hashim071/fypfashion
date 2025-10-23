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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('first_name');
            $table->string('last_name')->nullable(); // Last name optional ho sakta hai
            $table->string('phone_number')->nullable(); // Phone number optional ho sakta hai
            $table->string('email');
            $table->text('message'); // Message lamba ho sakta hai is liye 'text' type
            $table->timestamps(); // created_at aur updated_at columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
