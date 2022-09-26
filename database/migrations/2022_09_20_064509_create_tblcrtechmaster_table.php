<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcrtechmasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcrtechmaster', function (Blueprint $table) {
            $table->string('crcid', 6)->primary();
            $table->string('tmid', 6)->nullable(false);
            $table->string('ptype', 50)->nullable();
            $table->string('sversion', 50)->nullable();
            $table->string('smodule', 50)->nullable();
            $table->string('officebrance', 5)->nullable();
            $table->string('dbname', 25)->nullable();
            $table->string('comprefix', 4)->nullable();
            $table->string('comname', 100)->nullable();
            $table->string('title', 150)->nullable();
            $table->string('comaddress', 250)->nullable();
            $table->dateTime('insdate')->nullable();
            $table->dateTime('lstdate')->nullable();
            $table->dateTime('expdate')->nullable();
            $table->string('backuploocation', 250)->nullable();
            $table->string('backuploocationii', 250)->nullable();
            $table->integer('backupcopy')->nullable();
            $table->string('rrcoloocation', 250)->nullable();
            $table->string('demoorg', 5)->nullable();
            $table->boolean('onf')->nullable();
            $table->boolean('pg')->nullable();
            $table->boolean('bm')->nullable();
            $table->boolean('sl')->nullable();
            $table->boolean('fh')->nullable();
            $table->boolean('pb')->nullable();
            $table->boolean('ft')->nullable();
            $table->boolean('tl')->nullable();
            $table->boolean('fr')->nullable();
            $table->boolean('nw')->nullable();
            $table->boolean('hd')->nullable();
            $table->boolean('dw')->nullable();
            $table->string('licenceno', 50)->nullable();
            $table->string('option1', 50)->nullable();
            $table->string('option2', 50)->nullable();
            $table->string('option3', 50)->nullable();
            $table->string('option4', 50)->nullable();
            $table->string('option5', 50)->nullable();
            $table->string('option6', 50)->nullable();
            $table->string('option7', 50)->nullable();
            $table->string('option8', 50)->nullable();
            $table->string('option9', 50)->nullable();
            $table->string('option10', 50)->nullable();
            $table->string('status', 12)->nullable();
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
        Schema::dropIfExists('tblcrtechmaster');
    }
}
