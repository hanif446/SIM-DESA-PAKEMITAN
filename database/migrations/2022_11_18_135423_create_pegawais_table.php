<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama_pegawai');
            $table->string('jabatan');
            $table->string('tempat_lhr');
            $table->date('tgl_lhr');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('no_sk_pengangkatan');
            $table->string('thn_sk_pengangkatan');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
};
