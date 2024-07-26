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
        Schema::create('campaign_messages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('constituency_id');
            $table->string('title');
            $table->text('content');
            $table->string('image_url')->nullable();
            $table->integer('reads')->default(0);
            $table->unsignedInteger('likes_count')->default(0);
            $table->unsignedInteger('shares_count')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('constituency_id')->references('id')->on('constituencies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_messages');
    }
};
