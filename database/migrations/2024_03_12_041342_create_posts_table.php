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
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->enum('category', ['news', 'notice', 'article', 'event', 'blog'])->default('news');
            $table->string('event_date')->nullable();
            $table->string('event_address')->nullable();
            $table->string('image')->nullable();
            $table->string('feature_image')->nullable();
            $table->text('details')->nullable();
            $table->enum('status', ['Y', 'N'])->default('Y');
            // $table->integer('posted_by')->nullable();
            $table->foreignId('user_id')->nullable();

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
