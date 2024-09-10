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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_type')->nullable()->after('note');
            $table->date('date')->nullable()->after('delivery_type');
            $table->string('time')->nullable()->after('date');
            $table->double('delivery_charge')->nullable()->after('time');
            $table->double('min_price')->nullable()->after('delivery_charge');
            $table->string('city')->nullable()->after('min_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('delivery_type');
            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('delivery_charge');
            $table->dropColumn('min_price');
            $table->dropColumn('city');
        });
    }
};
