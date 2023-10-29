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
        Schema::create('hosting_rates', function (Blueprint $table) {
            $table->id();
            $table->string('definition_name');
            $table->integer('server_number');
            $table->string('definition_status');
            $table->integer('definition_userId');
            $table->string('definition_paymentStatus');
            $table->string('definition_publicStatus');
            $table->integer('daily_prices');
            $table->integer('monthly_prices');
            $table->integer('yearly_prices');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosting_rates');
    }
};
