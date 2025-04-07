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
        Schema::create('temp_videos', function (Blueprint $table) {
            $table->bigInteger('message_id');
            $table->bigInteger('chat_id');
            $table->json('data');
            $table->timestamps();
            $table->primary(['chat_id', 'message_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_videos');
    }
};
