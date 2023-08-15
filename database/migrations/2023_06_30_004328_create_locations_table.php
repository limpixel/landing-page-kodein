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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lembaga')->default(0);
            $table->longText('map');
            $table->longText('description');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('buttonText1')->nullable();
            $table->string('buttonLink1')->nullable();
            $table->string('buttonText2')->nullable();
            $table->string('buttonLink2')->nullable();
            $table->timestamps();

            $table->foreign('id_lembaga')->references('id')->on('lembagas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
