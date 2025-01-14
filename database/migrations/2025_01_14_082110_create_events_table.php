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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('order_number')->nullable();
            $table->text('details')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Y', 'N', 'R'])->default('Y');
            $table->string('slug')->nullable();
            $table->string('address')->nullable();
            $table->string('venue')->nullable();
            $table->string('event_date')->nullable();
            $table->string('event_time_start')->nullable();
            $table->string('event_time_end')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('feature_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};