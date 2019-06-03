<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Link extends Model
{
    protected $table = 'tbl_user_link';
    protected $date = 'created_at';
    protected $fillable = [
        'user_link_id','user_id', 'org_id', 'user_code','created_at'
    ];
    protected $primaryKey = 'user_link_id';
    
}
