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
        Schema::create('skl_olds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_skl')->nullable();
            $table->string('npwp')->nullable();
            $table->string('no_ijin')->nullable();
            $table->string('periodetahun')->nullable();
            $table->unsignedBigInteger('submit_by')->nullable();
            $table->date('published_date')->nullable();
            $table->string('qrcode')->nullable();
            $table->text('nota_attch')->nullable();
            $table->text('sklfile')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skl_olds');
    }
};
