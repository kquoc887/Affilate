<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')->references('org_id')->on('tbl_org')->onDelete('cascade');
            $table->string('email')->unique();
            $table->boolean('gender');
            $table->string('username');
            $table->string('password');
            $table->string('address');
            $table->string('aff_code');
            $table->string('user_token');
            $table->boolean('active')->default(0);
            $table->integer('role');
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
        Schema::dropIfExists('tbl_user');
    }
}
