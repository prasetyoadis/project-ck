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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email');
            $table->string('no_hp');
            $table->enum('gender', ['l', 'p']);
            $table->string('foto')->nullable();
            $table->enum('role', ['staff', 'kaadmin'])->default('staff');
            $table->enum('isactive', ['1', '0'])->default('0');
            $table->enum('isreqreset', ['1', '0'])->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
