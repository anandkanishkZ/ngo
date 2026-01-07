<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            // Check and add new columns only if they don't exist
            if (!Schema::hasColumn('hero_slides', 'text_position')) {
                $table->string('text_position')->default('center')->after('subtitle_size');
            }
            if (!Schema::hasColumn('hero_slides', 'vertical_position')) {
                $table->string('vertical_position')->default('middle')->after('text_position');
            }
            if (!Schema::hasColumn('hero_slides', 'animation')) {
                $table->string('animation')->default('fadeIn')->after('vertical_position');
            }
            if (!Schema::hasColumn('hero_slides', 'animation_duration')) {
                $table->string('animation_duration')->default('1s')->after('animation');
            }
            if (!Schema::hasColumn('hero_slides', 'overlay_enabled')) {
                $table->boolean('overlay_enabled')->default(false)->after('animation_duration');
            }
        });
        
        // Rename column using raw SQL for MariaDB compatibility
        if (Schema::hasColumn('hero_slides', 'sort_order') && !Schema::hasColumn('hero_slides', 'position')) {
            DB::statement('ALTER TABLE hero_slides CHANGE sort_order position int(11) NOT NULL DEFAULT 0');
        }
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
        });
        
        // Rename back using raw SQL for MariaDB compatibility
        DB::statement('ALTER TABLE hero_slides CHANGE position sort_order int(11) NOT NULL');
    }
};
