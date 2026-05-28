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
    $table->string('name')->nullable(); // Nama Buah
    $table->string('sub')->nullable();  // Deskripsi/Varian
    $table->text('benefit')->nullable(); // Manfaat Kesehatan
    $table->string('image')->nullable(); // Path/Nama File Gambar
    $table->string('old_price')->nullable();
    $table->string('new_price')->nullable();
    $table->string('non_member_price')->nullable();
    $table->boolean('is_member')->default(false);
    $table->string('type')->default('a3-led'); // Untuk membedakan fitur
    $table->foreignId('user_id')->constrained(); // Relasi ke user
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
