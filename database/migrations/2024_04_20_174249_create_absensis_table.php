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
        Schema::create('absensis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('siswa_id')->nullable()->references('id')->on('siswas')->nullOnDelete();
            $table->boolean('masuk')->nullable();
            $table->boolean('ijin')->nullable();
            $table->boolean('sakit')->nullable();
            $table->boolean('alpha')->nullable();
            $table->boolean('alasan')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tahun_ajaran')->nullable();
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
        Schema::dropIfExists('absensis');
    }
};
