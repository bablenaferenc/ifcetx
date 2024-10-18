<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'products', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->integer('price')->unsigned();

                $table->timestamps();
            }
        );

        Schema::create(
            'categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();

                $table->timestamps();
            }
        );

        Schema::create(
            'product_categories', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('category_id');

                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');

                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
    }
};
