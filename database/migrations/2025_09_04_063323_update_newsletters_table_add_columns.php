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
        Schema::table('newsletters', function (Blueprint $table) {
            // Check and add columns only if they don't exist
            if (!Schema::hasColumn('newsletters', 'email')) {
                $table->string('email')->unique()->after('id');
            }
            if (!Schema::hasColumn('newsletters', 'ip_address')) {
                $table->string('ip_address')->nullable()->after('email');
            }
            if (!Schema::hasColumn('newsletters', 'subscribed_at')) {
                $table->timestamp('subscribed_at')->useCurrent()->after('ip_address');
            }
            if (!Schema::hasColumn('newsletters', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('subscribed_at');
            }
            if (!Schema::hasColumn('newsletters', 'unsubscribed_at')) {
                $table->timestamp('unsubscribed_at')->nullable()->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newsletters', function (Blueprint $table) {
            $table->dropColumn(['email', 'ip_address', 'subscribed_at', 'is_active', 'unsubscribed_at']);
        });
    }
};
