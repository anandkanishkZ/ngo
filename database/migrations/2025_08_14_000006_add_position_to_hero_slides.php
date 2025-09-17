<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('content_x')->default('center')->after('overlay_opacity'); // left|center|right or CSS value
            $table->string('content_y')->default('center')->after('content_x'); // top|center|bottom or CSS value
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['content_x','content_y']);
        });
    }
};
