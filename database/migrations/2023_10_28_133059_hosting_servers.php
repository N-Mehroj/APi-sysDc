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
        Schema::create('hosting_servers', function (Blueprint $table) {
            $table->id();
            $table->string('server_name');
            $table->string('server_ip');
            $table->string('server_login');
            $table->string('server_password');
            $table->integer('server_userId');
            $table->string('server_status');
            $table->string('server_type');
            $table->string('server_address');
            $table->integer('server_port');
            $table->string('NS1_address')->nullable();
            $table->string('NS2_address')->nullable();
            $table->string('NS3_address')->nullable();
            $table->string('NS4_address')->nullable();
            $table->string('IP1_address')->nullable();
            $table->string('IP2_address')->nullable();
            $table->string('IP3_address')->nullable();
            $table->string('IP4_address')->nullable();
            $table->string('server_location');
            $table->text('server_description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosting_servers');
    }
};
