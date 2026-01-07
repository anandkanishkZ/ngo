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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('position');
            $table->string('location')->default('Udayapur, Nepal');
            $table->string('employment_type')->default('Full Time'); // Full Time, Part Time, Contract
            $table->integer('number_of_positions')->default(1);
            $table->string('experience_required')->nullable(); // e.g., "2-3 years"
            $table->string('education_level')->nullable(); // e.g., "Bachelor's Degree"
            $table->string('salary_range')->nullable(); // e.g., "As per organization rules"
            $table->text('description');
            $table->text('responsibilities')->nullable();
            $table->text('requirements')->nullable();
            $table->text('skills')->nullable(); // JSON or comma-separated
            $table->text('benefits')->nullable();
            $table->text('how_to_apply')->nullable();
            $table->string('application_email')->nullable();
            $table->string('application_phone')->nullable();
            $table->date('deadline');
            $table->date('published_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_urgent')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->string('department')->nullable(); // e.g., "Field Operations", "Administration"
            $table->string('category')->nullable(); // e.g., "Development", "Management"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
