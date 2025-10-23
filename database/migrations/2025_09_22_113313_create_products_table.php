<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('image')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->decimal('retail_price', 10, 2);
            $table->decimal('actual_price', 10, 2);
            $table->integer('quantity')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('action', ['available', 'out_of_stock'])->default('available');
            // ✅ new field as per document
            $table->boolean('is_customizable')->default(true);
            $table->json('customization_fields')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
