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
        Schema::create('form_apego_etico', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('area')->nullable(); // Selected dependency
            $table->string('pregunta1')->nullable(); // Ética Pública definition
            $table->string('pregunta2')->nullable(); // Importance of Code of Ethics
            $table->string('pregunta3')->nullable(); // Constitutional Principles
            $table->text('pregunta4')->nullable(); // Code of Ethics description
            $table->string('pregunta5')->nullable(); // Importance of ethical norms
            $table->text('pregunta6')->nullable(); // Specific situation description
            $table->text('pregunta7')->nullable(); // Actions to strengthen ethics
            $table->string('pregunta8')->nullable(); // Conflict of interest handling
            $table->string('pregunta9')->nullable(); // Training received
            $table->string('pregunta10')->nullable(); // Need for ethics training
            $table->json('principios')->nullable(); // Selected constitutional principles
            $table->text('pregunta11_explicacion')->nullable(); // Explanation for principles
            $table->string('pregunta12')->nullable(); // Ethical value definition
            $table->string('pregunta13')->nullable(); // Knowledge of reporting channels
            $table->text('pregunta13_explicacion')->nullable(); // Explanation of channels
            $table->string('pregunta14')->nullable(); // Reporting instances
            $table->text('pregunta15')->nullable(); // Knowledge of committee members
            $table->text('pregunta16')->nullable(); // Superior's example
            $table->string('ip_address')->nullable(); // IP address for tracking
            $table->string('user_agent')->nullable(); // User agent for tracking
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_apego_etico');
    }
};
