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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // Kolom dari form Register Pengguna
            $table->string('nama_lengkap');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('jenis_kelamin')->nullable(); // Laki-laki / Perempuan
            
            // Kolom untuk Login
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            // KOLOM KUNCI untuk membedakan Admin dan Pengguna
            // 'pengguna' adalah nilai default saat registrasi
            $table->string('role')->default('pengguna'); // 'admin' | 'pengguna'
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};