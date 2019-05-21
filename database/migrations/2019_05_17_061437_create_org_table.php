<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgTable extends Migration
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
            $table->string('org_name');
            $table->string('org_email');
            $table->string('org_uri')->default('');
            $table->string('org_address');
            $table->string('org_phone');
            $table->string('org_token')->default('');
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
