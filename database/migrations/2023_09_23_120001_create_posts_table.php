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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id');
            $table->string('title');
            $table->string('worth');
            $table->string('thumbnail');
            $table->string('image');
            $table->text('description');
            $table->text('instructions');
            $table->string('open_giveaway_url');
            $table->string('redirect_url');
            $table->string('type');
            $table->string('platforms');            
            $table->string('published_date');
            $table->string('end_date');
            $table->string('status');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
