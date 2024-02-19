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
		Schema::dropIfExists('pks_checks');
		Schema::create('pks_checks', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('pengajuan_id');
			$table->unsignedBigInteger('commitcheck_id');
			$table->unsignedBigInteger('pks_id');
			$table->unsignedBigInteger('poktan_id');
			$table->string('npwp', 50);
			$table->string('no_ijin');
			$table->string('status')->nullable();
			$table->text('note')->nullable();
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
		Schema::dropIfExists('pks_checks');
	}
};
