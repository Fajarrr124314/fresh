<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('labels', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kuncinya di sini!
        $table->string('header');
        $table->string('name');
        $table->string('sub')->nullable();
        $table->string('oldPrice');
        $table->string('newPrice');
        $table->string('nonMemberPrice')->default('0.000');
        $table->string('period');
        $table->string('unit');
        $table->boolean('isMember')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labels');
    }
};
