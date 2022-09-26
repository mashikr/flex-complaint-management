<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcrteamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcrteam', function (Blueprint $table) {
            $table->string('eid', 8)->primary();
            $table->string('uname', 75)->nullable(false);
            $table->string('department', 50)->nullable();
            $table->string('designation', 50)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->dateTime('bdate')->nullable();
            $table->dateTime('jdate')->nullable();
            $table->string('notes', 500)->nullable();
            $table->binary('photo')->nullable();
            $table->string('usrid', 16)->nullable(false);
            $table->string('grpid', 8)->nullable();
            $table->string('utyp', 50)->nullable();
            $table->string('password', 16)->nullable();
            $table->string('phint', 150)->nullable();
            $table->string('status', 8)->nullable();
            $table->string('opt1', 1500)->nullable();
            $table->string('opt2', 500)->nullable();
            $table->string('opt3', 50)->nullable();
            $table->string('opt4', 50)->nullable();
            $table->string('opt5', 50)->nullable();
            $table->string('upstatus', 12)->nullable();
            $table->string('dnstatus', 12)->nullable();
            $table->string('cusrid', 16)->nullable();
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
        Schema::dropIfExists('tblcrteam');
    }
}
