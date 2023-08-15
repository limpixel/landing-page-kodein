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
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lembaga')->default(0);
            $table->string('title');
            $table->string('buttonText1')->nullable();
            $table->string('buttonLink1')->nullable();
            $table->string('buttonText2')->nullable();
            $table->string('buttonLink2')->nullable();
            $table->string('image');
            $table->timestamps();

            $table->foreign('id_lembaga')->references('id')->on('lembagas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousels');
    }
};
