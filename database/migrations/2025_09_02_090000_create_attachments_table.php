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
        Schema::create('attachments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('original_name');
            $table->string('file_name');
            $table->string('file_path');
            $table->bigInteger('file_size');
            $table->string('mime_type');
            $table->string('file_type'); // image, pdf, document
            $table->text('url');
            $table->string('context')->default('content'); // where it's used: content, notice, blog, etc.
            $table->string('context_id')->nullable(); // ID of the related model
            $table->boolean('is_used')->default(false); // whether the file is actually used in content
            $table->timestamp('uploaded_at');
            $table->timestamps();
            
            $table->index(['context', 'context_id']);
            $table->index('is_used');
            $table->index('uploaded_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
