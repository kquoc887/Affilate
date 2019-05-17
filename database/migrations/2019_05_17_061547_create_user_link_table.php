<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_link', function (Blueprint $table) {
            $table->increments('user_link_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('tbl_users')->onDelete('cascade');
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')->references('org_id')->on('tbl_org')->onDelete('cascade');
            $table->string('user_code');
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
        Schema::dropIfExists('tbl_user_link');
    }
}
