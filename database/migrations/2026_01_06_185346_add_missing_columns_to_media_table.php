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
        Schema::table('media', function (Blueprint $table) {
            // Add original_filename if it doesn't exist
            if (!Schema::hasColumn('media', 'original_filename')) {
                $table->string('original_filename')->after('filename');
            }
            
            // Add file_size if it doesn't exist
            if (!Schema::hasColumn('media', 'file_size')) {
                $table->bigInteger('file_size')->after('mime_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            if (Schema::hasColumn('media', 'original_filename')) {
                $table->dropColumn('original_filename');
            }
            if (Schema::hasColumn('media', 'file_size')) {
                $table->dropColumn('file_size');
            }
        });
    }
};
