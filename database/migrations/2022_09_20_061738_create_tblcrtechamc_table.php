<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcrtechamcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcrtechamc', function (Blueprint $table) {
            $table->string('tmid', 4)->primary();
            $table->string('taid', 8)->nullable(false);
            $table->date('update')->nullable();
            $table->string('olicence', 50)->nullable();
            $table->string('olstatus', 12)->nullable();
            $table->boolean('fr')->nullable();
            $table->boolean('nw')->nullable();
            $table->boolean('hd')->nullable();
            $table->boolean('dw')->nullable();
            $table->boolean('onf')->nullable();
            $table->boolean('pg')->nullable();
            $table->boolean('bm')->nullable();
            $table->boolean('sl')->nullable();
            $table->boolean('fh')->nullable();
            $table->boolean('pb')->nullable();
            $table->boolean('ft')->nullable();
            $table->boolean('tl')->nullable();
            $table->string('ptype', 25)->nullable();
            $table->string('swversion', 50)->nullable();
            $table->string('nlicence', 50)->nullable();
            $table->date('rdate')->nullable();
            $table->date('edate')->nullable();
            $table->float('quantity')->nullable();
            $table->float('sprice')->nullable();
            $table->float('discount')->nullable();
            $table->float('tds')->nullable();
            $table->float('total')->nullable();
            $table->string('option1', 50)->nullable();
            $table->string('option2', 50)->nullable();
            $table->string('option3', 50)->nullable();
            $table->string('option4', 50)->nullable();
            $table->string('option5', 50)->nullable();
            $table->date('cdate')->nullable();
            $table->date('udate')->nullable();
            $table->string('status', 12)->nullable(false);
            $table->string('upstatus', 12)->nullable();
            $table->string('dnstatus', 12)->nullable();
            $table->string('usrid', 16)->nullable();
            $table->string('bid', 16)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblcrtechamc');
    }
}
