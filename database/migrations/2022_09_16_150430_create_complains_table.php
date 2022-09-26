<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('from', ['admin', 'user']);
            $table->enum('to', ['admin', 'user']);
            $table->integer('admin_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->enum('message_type', ['text','img','pdf','doc','txt']);
            $table->text('message')->nullable();
            $table->string('file_name')->nullable();
            $table->boolean('seen')->default(0);
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
        Schema::dropIfExists('complains');
    }
}
