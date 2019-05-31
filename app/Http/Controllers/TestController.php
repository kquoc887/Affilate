<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_Link;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use DateTime;
use Illuminate\Support\Facades\View;




class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */public function __construct(){
        //  if(Auth::check()){
        //     $org_id = DB::table('tbl_org')->where('org_email', Auth::user()->email)->value('org_id');
        //     $new_order =  DB::table('tbl_user_link')
        //                             ->join('tbl_customer_action', 'tbl_user_link.user_link_id', '=', 'tbl_customer_action.user_link_id')
        //                             ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
        //                             ->where('tbl_user_link.org_id', $org_id)->orderBy('tbl_customer_action.created_at','DESC')
        //                             ->select(DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'),'tbl_customer_action.created_at','tbl_customer_action.order_id')
        //                             ->take(2)
        //                             ->get();
        //     View::share('new_order',$new_order);
        //  }
     }
    public function index()
    {
        // $org_id = DB::table('tbl_org')->where('org_email', Auth::user()->email)->value('org_id');
        // $new_order =  DB::table('tbl_user_link')
        //                         ->join('tbl_customer_action', 'tbl_user_link.user_link_id', '=', 'tbl_customer_action.user_link_id')
        //                         ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
        //                         ->where('tbl_user_link.org_id', $org_id)->orderBy('tbl_customer_action.created_at','DESC')
        //                         ->select(DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'),'tbl_customer_action.created_at','tbl_customer_action.order_id')
        //                         ->take(2)
        //                         ->get();
        
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
    //lấy dữ liệu của CTV khi người dùng click vào link của ctv và thanh toán
    // public function saveProfilePublisher(Request $request){
    //     $user_code = $request->get('user_code');
    //     $total = $request->get('total');
    //     $order_id = $request->get('order_id');
    //     $user = DB::table('tbl_user_link')->where('user_code',$user_code)->first();
       
    //     $dataCustomer = [
    //         'user_link_id' => $user->user_link_id,
    //         'order_id' => $order_id,
    //         'total' => $total,
    //         'created_at' => new DateTime(),s
    //         'updated_at' => new DateTime(),
    //     ];
    //     $result = DB::table('tbl_customer_action')->insert($dataCustomer);
    //     return response()->json(['success' => 'everythings ok']);
    // }
    //lấy dữ liệu lợi nhuận của các user 
    public function getDataSaleProfit(){
        $customer = DB::table('tbl_user_link')
                        ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                        ->join('tbl_customer_action','tbl_user_link.user_link_id','=','tbl_customer_action.user_link_id')
                        ->select('tbl_user_link.*','tbl_customer_action.*', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'))
                        ->get();
            
        return datatables()->of($customer)
            ->addColumn('action',function($data){
                    $button = '<button type="button" name="calc_commission" id="'.$data->user_id.'" class="btn_calc_commission btn btn-primary btn -sm">Tính Hoa Hồng</button>';
                    return $button;
            })
            ->addColumn('STT','')
            ->rawColumns(['STT','action'])
            ->make(true);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //MỞ trang sale profit
    public function getSaleProfit(){
        return view('affilate.web.saleprofit');
    }
    public function alertToApp()
    {
        return 123;
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
    public function lock_n_unlock_publisher(Request $request)
    {
       $action = $request->post('action');
       $id = $request->post('id_user');
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
