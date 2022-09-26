<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcregroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcregroup', function (Blueprint $table) {
            $table->string('creid', 2)->primary();
            $table->string('crename', 25)->nullable(false);
            $table->string('description', 250)->nullable();
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
        Schema::dropIfExists('tblcregroup');
    }
}
