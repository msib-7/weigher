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
        Schema::create('ms303s_1s', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('device_name')->nullable();
            $table->string('kode_asset')->nullable();
            $table->timestamp('datetime')->nullable();
            $table->bigInteger('epoc')->nullable();
            $table->float('no')->nullable();
            $table->float('weight')->nullable();
            $table->float('n')->nullable();
            $table->float('x')->nullable();
            $table->float('s_dev')->nullable();
            $table->float('s_rel')->nullable();
            $table->float('min')->nullable();
            $table->float('max')->nullable();
            $table->float('diff')->nullable();
            $table->float('sum')->nullable();
            $table->string('lot')->nullable();
            $table->string('name')->nullable();
            $table->integer('cnt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms303s_1s');
    }
};
