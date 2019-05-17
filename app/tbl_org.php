<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_org extends Model
{
    protected $table = "tbl_org";

    protected $fillable = [
        'org_id','org_name','org_email','org_address','org_phone','org_token',

   ];

}
