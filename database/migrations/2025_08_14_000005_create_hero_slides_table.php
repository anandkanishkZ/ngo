<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('title_color')->default('#ffffff');
            $table->string('subtitle_color')->default('#ffffff');
            $table->string('title_size')->default('3.5rem');
            $table->string('subtitle_size')->default('1.25rem');
            $table->string('button1_text')->nullable();
            $table->string('button1_url')->nullable();
            $table->string('button1_style')->default('primary');
            $table->string('button2_text')->nullable();
            $table->string('button2_url')->nullable();
            $table->string('button2_style')->default('outline');
            $table->string('bg_image')->nullable();
            $table->string('overlay_from')->default('#2c3e50');
            $table->string('overlay_to')->default('#e74c3c');
            $table->decimal('overlay_opacity', 3, 2)->default(0.55);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
