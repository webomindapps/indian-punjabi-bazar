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
            $table->boolean('is_invoice_created')->default(false)->after('note');
            $table->date('invoice_date')->nullable()->after('is_invoice_created');
            $table->boolean('is_shipped')->default(false)->after('invoice_date');
            $table->date('shipped_date')->nullable()->after('is_shipped');
            $table->boolean('is_refunded')->default(false)->after('shipped_date');
            $table->date('refund_date')->nullable()->after('is_refunded');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_invoice_created');
            $table->dropColumn('invoice_date');
            $table->dropColumn('is_shipped');
            $table->dropColumn('shipped_date');
            $table->dropColumn('is_refunded');
            $table->dropColumn('refund_date');
        });
    }
};
