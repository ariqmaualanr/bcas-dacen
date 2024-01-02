<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandoversTable extends Migration
{
    public function up()
    {
        Schema::create('handovers', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger('petugas1')->nullable(); // Tambahkan kolom petugas1
            $table->unsignedBigInteger('petugas2')->nullable(); // Tambahkan kolom petugas2
            $table->text('pekerjaan');
            $table->text('status_pekerjaan')->nullable();

            // Tambahkan foreign key ke tabel karyawans
            $table->foreign('petugas1')->references('id')->on('karyawans')->onDelete('set null');
            $table->foreign('petugas2')->references('id')->on('karyawans')->onDelete('set null');

            // Tambahkan kolom-kolom lain sesuai kebutuhan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('handovers');
    }
}

