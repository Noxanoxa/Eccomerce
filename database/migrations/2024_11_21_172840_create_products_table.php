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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('product_price');
            $table->integer('product_quantity');
            $table->string('product_size')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->date('date');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
