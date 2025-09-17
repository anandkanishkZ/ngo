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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('website_url')->nullable();
            $table->enum('type', ['sponsor', 'partner', 'collaborator'])->default('partner');
            $table->boolean('is_active')->default(true);
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('background_color', 7)->default('#3498db');
            $table->timestamps();

            // Indexes for performance
            $table->index(['is_active', 'featured', 'sort_order']);
            $table->index(['is_active', 'type']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
