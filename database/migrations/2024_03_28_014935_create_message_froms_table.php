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
        Schema::create('message_froms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('message')->nullable();
            $table->string('slug')->nullable();
            $table->string('designation')->nullable();
            $table->string('title')->nullable();
            $table->integer('order')->nullable();
            $table->string('display_in_home')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_froms');
    }
};
