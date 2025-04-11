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
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->id();
            $table->string('model')->nullable(); // Nama model yang diubah
            $table->uuid('model_id')->nullable(); // UUID dari record yang diubah
            $table->string('action'); // Tipe operasi: created, updated, deleted
            $table->string('location')->nullable();
            $table->string('reason');
            $table->string('how');
            $table->timestamp('timestamp');
            $table->json('old_data')->nullable(); // Data sebelum perubahan
            $table->json('new_data')->nullable(); // Data setelah perubahan
            $table->uuid('user_id')->nullable(); // UUID dari user yang melakukan perubahan
            $table->timestamps(); // Waktu perubahan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_trails');
    }
};
