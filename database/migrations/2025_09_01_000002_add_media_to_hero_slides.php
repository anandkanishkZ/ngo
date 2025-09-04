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
            $table->unsignedBigInteger('bg_image_id')->nullable()->after('bg_image');
            $table->foreign('bg_image_id')->references('id')->on('media')->onDelete('set null');
            $table->index('bg_image_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropForeign(['bg_image_id']);
            $table->dropColumn('bg_image_id');
        });
    }
};
