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
        Schema::create('user_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('campaign_message_id');
            $table->enum('action_type', ['like', 'share', 'read']);
            $table->integer('points_earned');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('campaign_message_id')->references('id')->on('campaign_messages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_actions');
    }
};
