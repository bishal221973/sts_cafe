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
        Schema::create('sub_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('combo_id');
            $table->foreign('combo_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->string('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_products');
    }
};
