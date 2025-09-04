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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('detailed_description')->nullable();
            $table->string('status')->default('ongoing'); // 'ongoing' or 'completed'
            $table->string('category')->nullable(); // e.g., 'education', 'healthcare', 'environment'
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->decimal('funds_raised', 15, 2)->default(0);
            $table->string('location')->nullable();
            $table->json('images')->nullable(); // Store multiple images
            $table->string('featured_image')->nullable();
            $table->integer('beneficiaries')->nullable();
            $table->text('goals')->nullable();
            $table->text('achievements')->nullable();
            $table->json('partners')->nullable(); // Partner organizations
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('slug')->unique();
            $table->timestamps();
            
            $table->index(['status', 'is_active']);
            $table->index(['is_featured', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
