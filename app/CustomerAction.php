<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAction extends Model
{
    protected $table = 'tbl_customer_action';
    protected $fillable = [
        'id','user_link_id','order_id','total','created_at','updated_at'

   ];
}
