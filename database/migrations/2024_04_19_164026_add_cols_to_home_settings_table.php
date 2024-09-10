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
        Schema::table('home_settings', function (Blueprint $table) {
            $table->string('fax')->nullable()->after('phone');
            $table->text('map_location')->nullable()->after('fax');
            $table->text('working_hours')->nullable()->after('map_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_settings', function (Blueprint $table) {
            $table->dropColumn('fax');
            $table->dropColumn('map_location');
            $table->dropColumn('working_hours');
        });
    }
};
