<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcrregionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcrregion', function (Blueprint $table) {
            $table->string('diid', 8)->primary();
            $table->string('diname', 75)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('distance', 50)->nullable();
            $table->string('elevation', 50)->nullable();
            $table->string('aboutdestination', 8000)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('notes', 500)->nullable();
            $table->string('glid', 12)->nullable();
            $table->string('option1', 50)->nullable();
            $table->string('option2', 50)->nullable();
            $table->string('option3', 50)->nullable();
            $table->string('status', 12)->nullable(false);
            $table->string('upstatus', 12)->nullable();
            $table->string('dnstatus', 12)->nullable();
            $table->string('usrid', 16)->nullable();
            $table->string('bid', 16)->nullable();
            $table->bigInteger('acsid')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblcrregion');
    }
}
