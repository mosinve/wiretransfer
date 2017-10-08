<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_user')->unsigned();
	        $table->integer('to_user')->unsigned();
	        $table->string('sum');
	        $table->boolean('approved')->default('0');
	        $table->boolean('completed')->default('0');;
	        $table->string('pincode')->nullable();
            $table->timestamps();

	        $table->foreign('from_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
	        $table->foreign('to_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('transactions', function (Blueprint $table){
		    $table->dropForeign(['from_user']);
		    $table->dropForeign(['to_user']);
	    });

        Schema::dropIfExists('transactions');
    }
}
