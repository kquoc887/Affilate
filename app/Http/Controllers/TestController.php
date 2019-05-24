<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_Link;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\tbl_org;
use App\User;
use DB;
use Illuminate\Database\Eloquent\Collection;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('affilate.web.home');
    }
    public function getDataUserLink(){

        $org_id = DB::table('tbl_org')->where('org_email', Auth::user()->email)->value('org_id');

        $user_link = DB::table('tbl_user_link')
                        ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                        ->join('tbl_org','tbl_user_link.org_id','=','tbl_org.org_id')
                        ->where('tbl_user_link.org_id', $org_id)
                        ->select('tbl_user_link.*','tbl_user_link.user_id','tbl_org.org_name','tbl_users.active', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'))
                        ->get();
        // return $user_link;
         return datatables()->of($user_link)
            ->addColumn('action',function($data){
                $button = '<button type="button" name="unlock" id="'.$data->user_id.'" class="btn_unlock btn btn-primary btn -sm">Mở Khóa</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button  type="button" name="lock" id="'.$data->user_id.'" class="btn_lock btn btn-danger btn-sm">Khóa</button>';
                return $button;
            })
            ->addColumn('active',function($data){
                // if($data->active == 3)
                // {
                //     $input = '<label id="alert-status" class="alert alert-danger"> Tài Khoản đã khóa';
                //     return $input;
                // }
                switch($data->active){
                    case 1:
                        $input = '<label id="alert-status" class="alert alert-success"> Đang hoạt động';
                        return $input;
                        break;
                    case 2:
                        $input = '<label id="alert-status" class="alert alert-danger"> Tài khoản đã khóa';
                        return $input;
                        break;
                }
               
            })
            ->addColumn('STT','')
            ->rawColumns(['STT','active','action'])
            ->make(true);

        
    }
    //lấy dữ liệu lợi nhuận của các user 
    public function getDataSaleProfit(){
        $customer = DB::table('tbl_user_link')
                        ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                        ->join('tbl_customer_action','tbl_user_link.user_link_id','=','tbl_customer_action.user_link_id')
                        ->select('tbl_user_link.*','tbl_customer_action.*', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'))
                        ->get();
            return $customer;
        // return datatables()->of($customer)
        //     ->addColumn('active',function($data){
        //         switch($data->active){
        //             case 0:
        //                 $input = '<label id="alert-status" class="alert alert-warning"> Đang chờ';
        //                 return $input;
        //                 break;
        //             case 1:
        //                 $input = '<label id="alert-status" class="alert alert-success"> Đã thanh toán';
        //                 return $input;
        //                 break;
        //             case 2:
        //                 $input = '<label id="alert-status" class="alert alert-danger"> Đã hủy đơn hàng';
        //                 return $input;
        //                 break;
        //         }
            
        //     })
        //     ->addColumn('STT','')
        //     ->rawColumns(['STT'])
        //     ->make(true);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSaleProfit(){
        return view('affilate.web.saleprofit');
    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lock_n_unlock_publisher()
    {
       $action = $_POST['action'];
       $id = $_POST['id_user'];
       $user = User::find($id);
       if($action == 'lock')
       {
            $user->active = 2;
            
       } else {
            $user->active = 1;
       }
        $user->save();
        return response()->json(['message' => 'success']);
        
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
