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
        Schema::create('comparison_inputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('selection_period_id')->constrained()->onDelete('cascade');
            $table->enum('comparison_type', ['criterion', 'alternative']);
            $table->foreignId('criterion_id')->nullable()->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('item_1_id');
            $table->unsignedBigInteger('item_2_id');
            $table->unsignedTinyInteger('value');
            $table->timestamps();

            $table->index(['selection_period_id', 'user_id', 'comparison_type'], 'comp_inputs_period_user_type_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comparison_inputs');
    }
};
