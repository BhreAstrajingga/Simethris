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
        Schema::create('commitment_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('pullriph_id');
            $table->string('no_pengajuan', 50);
            $table->string('npwp', 50);
            $table->string('no_ijin');
            $table->unsignedBigInteger('commitment_id');
            $table->enum('formRiph', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formSptjm', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('logbook', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formRt', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formRta', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formRpo', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->enum('formLa', ['Sesuai', 'Tidak Sesuai'])->nullable();
            $table->string('status')->nullable()->nullable();
            $table->text('note')->nullable()->nullable();
            $table->date('verif_at')->nullable();
            $table->unsignedBigInteger('verif_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('commitment_checks');
    }
};
