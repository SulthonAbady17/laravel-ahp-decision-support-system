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
        Schema::create('period_criterion', function (Blueprint $table) {
            $table->foreignId('selection_period_id')->constrained()->onDelete('cascade');
            $table->foreignId('criterion_id')->constrained()->onDelete('cascade');
            $table->primary(['selection_period_id', 'criterion_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period_criterion');
    }
};
