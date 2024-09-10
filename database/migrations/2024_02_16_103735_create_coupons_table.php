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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('coupon')->default('123');

            $table->date('from');
            $table->date('to');

            $table->integer('discount_type')->comment('1 percentage 2 fixed amount');
            $table->double('discount_type_value')->default(0);

            $table->boolean('is_condition_coupon')->default(false);
            $table->double('min_amount_for_discount')->default(0);
            $table->double('max_discount_amount')->default(0);

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
