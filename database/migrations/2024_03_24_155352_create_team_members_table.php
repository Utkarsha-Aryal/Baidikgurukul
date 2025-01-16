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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_category_id')->constrained('team_categories', 'id');
            $table->foreignId('time_interval_id')->constrained('time_intervals', 'id');
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->integer('order')->nullable();
            $table->string('slug')->nullable();
            $table->string('designation')->nullable();
            $table->text('details')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->enum('status', ['Y', 'R', 'N'])->default('Y');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};