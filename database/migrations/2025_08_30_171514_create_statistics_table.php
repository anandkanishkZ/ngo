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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g., 'lives_impacted', 'donors_count'
            $table->string('label'); // e.g., 'Lives Impacted', 'Generous Donors'
            $table->bigInteger('value'); // The numeric value
            $table->string('icon')->nullable(); // Font Awesome icon class
            $table->string('color')->default('#f39c12'); // Color for the icon/number
            $table->integer('sort_order')->default(0); // For ordering
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable(); // Admin notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
