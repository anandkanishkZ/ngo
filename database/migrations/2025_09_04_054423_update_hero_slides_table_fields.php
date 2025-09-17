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
        Schema::table('hero_slides', function (Blueprint $table) {
            // Add new columns that match our form
            $table->string('text_position')->default('center')->after('subtitle_size');
            $table->string('vertical_position')->default('middle')->after('text_position');
            $table->string('animation')->default('fadeIn')->after('vertical_position');
            $table->string('animation_duration')->default('1s')->after('animation');
            $table->boolean('overlay_enabled')->default(false)->after('animation_duration');
            
            // Rename sort_order to position to match our form
            $table->renameColumn('sort_order', 'position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            // Remove added columns
            $table->dropColumn([
                'text_position',
                'vertical_position', 
                'animation',
                'animation_duration',
                'overlay_enabled'
            ]);
            
            // Rename back
            $table->renameColumn('position', 'sort_order');
        });
    }
};
