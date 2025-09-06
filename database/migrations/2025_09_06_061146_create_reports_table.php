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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('executive_summary')->nullable();
            $table->text('content');
            $table->string('type')->default('annual'); // annual, quarterly, monthly, project, financial, impact
            $table->string('category')->nullable(); // financial, impact, project, governance
            $table->string('fiscal_year', 10)->nullable(); // e.g., "2024-2025"
            $table->date('report_date');
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('author')->default('JIDS Nepal');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_public')->default(true);
            $table->integer('sort_order')->default(0);
            $table->integer('download_count')->default(0);
            $table->json('metadata')->nullable(); // Additional report metadata
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'is_public']);
            $table->index(['type', 'fiscal_year']);
            $table->index(['category', 'report_date']);
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
