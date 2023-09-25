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
        Schema::create('twits', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('twitter_id')->unique();
            $table->string('twitter_title');
            $table->text('twitter_text');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twits');
    }
};
