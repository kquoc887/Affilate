<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use App\Notifications\UserNotification;
use App\User;
use App\CustomerAction;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('tbl_user_link')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $org_token = $request->post('data_customer')['org_token'];
        $order_id = $request->post('data_customer')['order_id'];
        $order_total = $request->post('data_customer')['order_total'];
        $org = DB::table('tbl_org')->where('org_token', $org_token)->first();
        if (!empty($org)) {
            
            $user_code = $request->post('user_code');
            $user = DB::table('tbl_user_link')->where('user_code',$user_code)->first();
            
            $dataCustomer = [
                'user_link_id' => $user->user_link_id,
                'order_id' => $order_id,
                'total' => $order_total,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ];

            $order = CustomerAction::create($dataCustomer);
            
            if ($order) {
                $user_id = DB::table('tbl_users')->where('email',$org->org_email)->value('user_id');
                $user_admin = User::find($user_id);
                $user_admin->notify(new UserNotification($order));
            }
       } 


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
