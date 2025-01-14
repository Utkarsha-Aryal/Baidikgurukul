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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('aboutus_title')->nullable();
            $table->text('introduction')->nullable();
            $table->string('img_introduction')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('goals')->nullable();
            $table->enum('status', ['Y', 'R', 'N'])->default('Y');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
