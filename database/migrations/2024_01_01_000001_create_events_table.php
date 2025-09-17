<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Events feature removed; keep empty migration to avoid runtime errors
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void { /* intentionally left blank */ }

    /**
     * Reverse the migrations.
     */
    public function down(): void { /* intentionally left blank */ }
};
