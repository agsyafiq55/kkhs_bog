<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE events ADD thumbnail LONGBLOB AFTER event_date");
        Schema::table('events', function (Blueprint $table) {
            $table->binary('thumbnail')->nullable()->after('event_date'); // Store image as binary data (LONGBLOB)
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });
    }
};
