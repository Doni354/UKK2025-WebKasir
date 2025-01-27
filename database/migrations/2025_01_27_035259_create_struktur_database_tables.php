<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateStrukturDatabaseTables extends Migration
{
    public function up()
    {
        // Tabel Users
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('role')->nullable();
            $table->timestamps();
        });

        // Tabel Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // Tabel Products
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_product')->nullable();
            $table->string('name')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();  // Pastikan ini unsignedBigInteger
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });

        // Tabel Detail_Penjualan
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_penjualan')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->integer('qty')->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // Tabel Logs
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('action')->nullable();
            $table->string('model')->nullable();
            $table->string('msg')->nullable();
            $table->timestamp('created_at');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel Penjualan
        Schema::create('penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_penjualan')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->date('tgl')->nullable();
            $table->decimal('total_harga', 10, 2)->nullable();
            $table->decimal('bayar', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('detail_penjualan');
        Schema::dropIfExists('penjualan');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
    }
}

