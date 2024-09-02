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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('payment_id');
            $table->foreignId('template_undangan_id');
            $table->string('nama_pemesan');
            $table->string('email_pemesan');
            $table->string('no_hp_pemesan');
            $table->date('tgl_pemesanan');
            $table->enum('status', ['dp', 'lunas', 'batal'])->default('dp');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
