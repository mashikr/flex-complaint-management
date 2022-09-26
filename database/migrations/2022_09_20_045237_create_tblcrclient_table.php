<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcrclientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcrclient', function (Blueprint $table) {
            $table->string('crcid', 6)->primary();
            $table->string('crcname', 75)->nullable();
            $table->string('crprefix', 4)->nullable();
            $table->string('crgid', 2)->nullable(false);
            $table->string('street', 150)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('region', 50)->nullable();
            $table->string('state', 6)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('cname', 50)->nullable();
            $table->string('designation', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('mobile', 75)->nullable();
            $table->string('email', 75)->nullable();
            $table->string('emailii', 75)->nullable();
            $table->string('web', 75)->nullable();
            $table->string('paddress', 250)->nullable();
            $table->string('grade', 8)->nullable();
            $table->string('about', 2550)->nullable();
            $table->string('notes', 5000)->nullable();
            $table->string('option1', 50)->nullable();
            $table->string('option2', 50)->nullable();
            $table->string('option3', 50)->nullable();
            $table->string('option4', 50)->nullable();
            $table->string('option5', 50)->nullable();
            $table->date('cdate')->nullable();
            $table->date('udate')->nullable();
            $table->binary('clogo')->nullable(false);
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
        Schema::dropIfExists('tblcrclient');
    }
}
