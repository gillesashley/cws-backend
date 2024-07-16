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
        Schema::create('constituencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('region_id');
            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->unique(['name', 'region_id']); // Add unique constraint to avoid duplicate constituency names within the same region
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constituencies');
    }
};
