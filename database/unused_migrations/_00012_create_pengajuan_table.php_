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
		Schema::create('pengajuans', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('npwp');
			$table->string('no_pengajuan');
			$table->string('no_ijin');
			$table->unsignedBigInteger('commitment_id');
			$table->string('no_doc', 13)->unique();
			$table->string('status')->nullable(); //
			$table->text('note')->nullable();

			$table->string('onlinestatus')->nullable();
			$table->text('onlinenote')->nullable();
			$table->date('onlinedate')->nullable();
			$table->string('baonline')->nullable();
			$table->bigInteger('onlinecheck_by')->nullable();

			$table->decimal('luas_verif')->nullable();
			$table->decimal('volume_verif')->nullable();
			$table->string('metode')->nullable();
			$table->string('onfarmstatus')->nullable();
			$table->text('onfarmnote')->nullable();
			$table->date('onfarmdate')->nullable();
			$table->string('baonfarm')->nullable();
			$table->bigInteger('onfarmcheck_by')->nullable();
			$table->date('verif_at')->nullable();
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
		Schema::dropIfExists('pengajuans');
	}
};
