<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOrg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_org', function (Blueprint $table) {
            $table->increments('org_id');
            $table->string('org_name')->unique();
            $table->string('uri');
            $table->string('org_email');
            $table->string('org_address');
            $table->string('org_phone');
            $table->string('org_token');
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
        Schema::dropIfExists('tbl_org');
    }
}
