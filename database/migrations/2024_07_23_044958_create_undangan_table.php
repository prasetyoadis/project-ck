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
        Schema::create('undangan', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('cpria_id');
            $table->integer('cwanita_id');
            $table->text('story');
            $table->string('song');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undangan');
    }
};
