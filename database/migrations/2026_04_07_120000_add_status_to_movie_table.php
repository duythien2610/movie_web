<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('movie', 'status')) {
            Schema::table('movie', function (Blueprint $table) {
                $table->tinyInteger('status')->default(1)->after('updated_at');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('movie', 'status')) {
            Schema::table('movie', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
