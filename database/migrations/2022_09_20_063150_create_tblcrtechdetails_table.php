<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcrtechdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcrtechdetails', function (Blueprint $table) {
            $table->string('tmid', 6)->primary();
            $table->string('tdid', 8)->nullable(false);
            $table->string('swtype', 50)->nullable();
            $table->string('swname', 100)->nullable();
            $table->string('swversion', 100)->nullable();
            $table->string('cusrid', 16)->nullable();
            $table->string('cusrpass', 16)->nullable();
            $table->string('tvrid', 16)->nullable();
            $table->string('tvrpass', 16)->nullable();
            $table->string('ipadd', 16)->nullable();
            $table->string('subnet', 16)->nullable();
            $table->string('dgateway', 16)->nullable();
            $table->string('pdns', 16)->nullable();
            $table->string('sdns', 16)->nullable();
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
        Schema::dropIfExists('tblcrtechdetails');
    }
}
