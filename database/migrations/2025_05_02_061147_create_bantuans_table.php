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
        Schema::create('bantuans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('tanggal');
            $table->unsignedBigInteger('id_jenisBantuan');
            $table->string('nama');
            $table->date('date_birth');
            $table->text('keluhan');
            $table->string('alamat');
            $table->string('kontak');
            $table->enum('status', ['proses', 'belum diproses', 'selesai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuans');
    }
};
