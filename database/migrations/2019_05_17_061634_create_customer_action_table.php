<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer_action', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_link_id')->unsigned();
            $table->foreign('user_link_id')->references('user_link_id')->on('tbl_user_link')->onDelete('cascade');
            $table->dateTime('action_date');
            $table->integer('action');
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
        Schema::dropIfExists('tbl_customer_action');
    }
}
