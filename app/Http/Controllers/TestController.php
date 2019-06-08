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
use App\Notification;
use Carbon\Carbon;




class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month =  Carbon::now()->month;
        $percent_growup = 0;
        $org_id = DB::table('tbl_org')->where('org_email', Auth::user()->email)->value('org_id');
        $total_order =  DB::table('tbl_user_link')
                                ->join('tbl_customer_action', 'tbl_user_link.user_link_id', '=', 'tbl_customer_action.user_link_id')
                                ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                                ->where('tbl_user_link.org_id', $org_id)->orderBy('tbl_customer_action.created_at','DESC')
                                ->select(DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'),'tbl_customer_action.created_at','tbl_customer_action.order_id')
                                ->count();
        $total_pub =  DB::table('tbl_user_link')->where('org_id', $org_id)->count();
        $month_current = DB::table('tbl_customer_action')
                            ->whereMonth('tbl_customer_action.created_at', $month)
                            ->sum('total');
        $month_before = DB::table('tbl_customer_action')
                        ->whereMonth('tbl_customer_action.created_at', $month - 1 )
                        ->sum('total');
        if($month_before != 0){
            $percent_growup = ($month_current - $month_before)/$month_before * 100;
        }
        return view('affilate.web.home',compact('total_order','total_pub','percent_growup'));

    }
    public function getDataUserLink(){

        $org_id = DB::table('tbl_org')->where('org_email', Auth::user()->email)->value('org_id');

        $user_link = DB::table('tbl_user_link')
                        ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                        ->join('tbl_org','tbl_user_link.org_id','=','tbl_org.org_id')
                        ->where('tbl_user_link.org_id', $org_id)
                        ->select('tbl_user_link.*','tbl_user_link.user_id','tbl_users.email','tbl_org.org_name','tbl_users.active', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'))
                        ->get();

         return datatables()->of($user_link)
            ->addColumn('action',function($data){
                switch($data->active){
                    case 1:
                        $button = '<button  type="button" name="lock" id="'.$data->user_id.'" class="btn_lock btn btn-danger btn-sm col-sm-5">Khóa</button>';
                        return $button;
                        break;
                    case 2:
                        $button = '<button type="button" name="unlock" id="'.$data->user_id.'" class="btn_unlock btn btn-primary btn-sm col-sm-5" >Mở Khóa</button>';
                        return $button;
                        break;
                }
               
            })
            ->addColumn('active',function($data){
                switch($data->active){
                    case 1:
                        $input = '<label id="alert-status" class="alert alert-success col-sm-8"> Đang hoạt động';
                        return $input;
                        break;
                    case 2:
                        $input = '<label id="alert-status" class="alert alert-danger  col-sm-8"> Tài khoản đã khóa';
                        return $input;
                        break;
                }
               
            })
            ->addColumn('STT','')
            ->rawColumns(['STT','active','action'])
            ->editColumn('created_at',function($data){
                $dt = $data->created_at;
                $dt2 = Carbon::parse($dt)->format('d/m/Y');
                return $dt2;
            })
            ->make(true);

        
    }
   
    public function getDataSaleProfit(){
        $customer1 = DB::table('tbl_user_link')
                    ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                    ->join('tbl_customer_action','tbl_user_link.user_link_id','=','tbl_customer_action.user_link_id')
                    ->select('tbl_user_link.*','tbl_customer_action.*', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'))
                    ->get();
       
        return datatables()->of($customer1)
                            ->addColumn('action',function($data){
                                $have_payment = DB::table('tbl_payment')->where('order_id',$data->order_id)->first();
                                if(!empty($have_payment)){
                                    $button = '<button type="button" name="calc_commission" id="'.$data->customer_id.'" class="btn_calc_commission btn btn-success btn -sm" disabled>Đã tạm tinh</button>';
                                    return $button;
                                }
                                else{
                                    $button = '<button type="button" name="calc_commission" id="'.$data->customer_id.'" class="btn_calc_commission btn btn-primary btn -sm">Tạm tính Hoa Hồng</button>';
                                    return $button;
                                }
                            })
                            ->addColumn('STT','')
                            ->rawColumns(['STT','action'])
                            ->editColumn('created_at',function($data){
                                $dt = $data->created_at;
                                $dt2 = Carbon::parse($dt)->format('d/m/Y');
                                return $dt2;
                            })
                            ->editColumn('total',function($data){
                                
                                return number_format($data->total, 0, ',', '.' );
                            })
                            ->make(true); 
    }
    
    public function getSaleProfitFromToDate(Request $request){
        $fromdate = new Carbon($request->get('fromdate'));
        
        if (!empty($request->get('todate'))){
            $todate = new Carbon($request->get('todate'));
            $todate   = $todate->hour(23)->minute(59)->second(59);
            $customer = DB::table('tbl_user_link')
                            ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                            ->join('tbl_customer_action','tbl_user_link.user_link_id','=','tbl_customer_action.user_link_id')
                            ->whereBetween('tbl_customer_action.created_at',[$fromdate->toDateTimeString(),$todate->toDateTimeString()])
                            ->select('tbl_user_link.*','tbl_customer_action.*', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'))
                            ->get();
            

            return datatables()->of($customer)                               
                    ->addColumn('action',function($data){
                    $have_payment = DB::table('tbl_payment')->where('order_id',$data->order_id)->first();
                    if(!empty($have_payment)){
                        $button = '<button type="button" name="calc_commission" id="'.$data->customer_id.'" class="btn_calc_commission btn btn-success btn -sm" disabled>Đã tạm tinh</button>';
                        return $button;
                    }
                    else{
                        $button = '<button type="button" name="calc_commission" id="'.$data->customer_id.'" class="btn_calc_commission btn btn-primary btn -sm">Tạm tính Hoa Hồng</button>';
                        return $button;
                    }
                    })
                    ->addColumn('STT','')
                    ->rawColumns(['STT','action'])
                    ->editColumn('created_at',function($data){
                        $dt = $data->created_at;
                        $dt2 = Carbon::parse($dt)->format('d/m/Y');
                        return $dt2;
                    })
                    ->editColumn('total',function($data){
                        
                        return number_format($data->total, 0, ',', '.' );
                    })
                    ->make(true); 
        }
        else{
                $customer = DB::table('tbl_user_link')
                ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                ->join('tbl_customer_action','tbl_user_link.user_link_id','=','tbl_customer_action.user_link_id')
                ->whereDate('tbl_customer_action.created_at',$fromdate)
                ->select('tbl_user_link.*','tbl_customer_action.*', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'))
                ->get();
                return datatables()->of($customer)
                    ->addColumn('action',function($data){
                        $have_payment = DB::table('tbl_payment')->where('order_id',$data->order_id)->first();
                        if(!empty($have_payment)){
                            $button = '<button type="button" name="calc_commission" id="'.$data->customer_id.'" class="btn_calc_commission btn btn-success btn -sm" disabled>Đã tạm tinh</button>';
                            return $button;
                        }
                        else{
                            $button = '<button type="button" name="calc_commission" id="'.$data->customer_id.'" class="btn_calc_commission btn btn-primary btn -sm">Tạm tính Hoa Hồng</button>';
                            return $button;
                        }
                    })
                    ->addColumn('STT','')
                    ->rawColumns(['STT','action'])
                    ->make(true);
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //MỞ trang sale profit
    public function getSaleProfit(Request $request){
        $id = $request->get('id');
        
        if($request->ajax()){   
            $notification = Notification::find($id);
            $notification->update(['read_at' => now()]);
            // $notification->delete();
            return response()->json(['success'=>'ok']);
        }

        return view('affilate.web.saleprofit');
        
    }

    public function realTimeNotify(Request $request) {
        $numberNotifyInTable = DB::table('notifications')->count();
        if ($request->ajax() && $request->has('numberNotify')) {
            if ($request->get('numberNotify') < $numberNotifyInTable) {
                return   response()->json(['notify' =>   Auth::user()->unreadNotifications]);
            }
        }
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPayment(Request $request)
    {
        $customer_id = $request->get('customer_id');
        $payment = DB::table('tbl_user_link')
                        ->join('tbl_org','tbl_user_link.org_id','=','tbl_org.org_id')
                        ->join('tbl_customer_action','tbl_user_link.user_link_id','=','tbl_customer_action.user_link_id')
                        ->where('customer_id',$customer_id)
                        ->select('tbl_user_link.user_link_id','tbl_customer_action.*','tbl_org.org_commision')
                        ->first();
        $data = [
            'customer_id'   => $payment->customer_id,
            'order_id'      => $payment->order_id,
            'discount'      => $payment->total*$payment->org_commision,
            'action'        => 1,
            'created_at'    => new DateTime(),
            'updated_at'    => new DateTime(),
        ];
        $for_payment = DB::table('tbl_payment')->insert($data);
        return response()->json(['success'=>"Tạm tính hoa hồng thành công cho cộng tác viên"]);
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
    public function getPaymentAllUser()
    {
        return view('affilate.web.payment');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDataPayment(Request $request)
    {
        $month =  Carbon::now()->month;
        if(!empty($request->get('optionMonth'))){
           $month = $request->get('optionMonth');
        }
        $org = DB::table('tbl_org')->where('org_email', Auth::user()->email)->first();
        $publishers = DB::table('tbl_user_link')->where('org_id', $org->org_id)->get();
        $arr = array();

        foreach ($publishers as $publisher) {
            $totalOrder = DB::table('tbl_customer_action')
                                ->join('tbl_payment', 'tbl_customer_action.customer_id', '=', 'tbl_payment.customer_id')
                                ->where('user_link_id',$publisher->user_link_id)
                                ->where('tbl_payment.action', 1)
                                ->whereMonth('tbl_customer_action.created_at', $month)
                                ->sum('total');
            if ($totalOrder > 0) {
                $user = DB::table('tbl_users')->where('user_id', $publisher->user_id)->select(DB::raw('concat(lastname, " ",  firstname) as fullname'))->first();
                $arr_record = array(
                    'user_link_id' => $publisher->user_link_id,
                    'fullname' => $user->fullname,
                    'totalOrder'=> $totalOrder,
                    'commision' => $org->org_commision,
                    'moneyCommission' => $totalOrder * $org->org_commision
                );
                array_push($arr,$arr_record);
            }
        }
        return datatables()->of($arr)
                            ->addColumn('action',function($data){
                                $paid = false;
                            
                                $arrCustomerID = DB::table('tbl_customer_action')->where('user_link_id', $data['user_link_id'])->get();
                                foreach ($arrCustomerID as $item) {
                                    $action = DB::table('tbl_payment')->where('customer_id', $item->customer_id)->value('action');
                                    if ($action == 2) {
                                        $paid = true;
                                    }
                                    $paid = false;
                                }

                                if ($paid == true) {
                                    $button = '<button type="button" name="calc_commission" id="btn_calc_commission" data-content="'. $data['user_link_id'] .'" class=" btn btn-primary btn -sm" disabled>Đã thanh toán</button>';
                                    
                                } else {
                                    $button = '<button type="button" name="calc_commission" id="btn_calc_commission" data-content="'. $data['user_link_id'] .'" class=" btn btn-primary btn -sm" >Thanh Toán</button>';
                                }
                                return $button;
                            })
                            ->addColumn('STT','')
                            ->rawColumns(['STT','action'])
                            ->make(true);
    }

    public function postPay(Request $request) {
        $user_link_id = $request->post('user_link_id');
        $arr_customer_action = DB::table('tbl_customer_action')->where('user_link_id', $user_link_id)->get();
        foreach ($arr_customer_action as $item) {
            DB::table('tbl_payment')->where('customer_id', $item->customer_id)->update(['action' => 2]);
        }
        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCustomFilterData(Request $request)
    {
        $customer1 = DB::table('tbl_user_link')
                        ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                        ->join('tbl_customer_action','tbl_user_link.user_link_id','=','tbl_customer_action.user_link_id')
                        ->select(['tbl_user_link.*','tbl_customer_action.*', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname')]);
        // ->get();
        // return $customer1;

        return datatables()->of($customer1)
                ->addColumn('action',function($data){
                    $have_payment = DB::table('tbl_payment')->where('order_id',$data->order_id)->first();
                    if(!empty($have_payment)){
                        $button = '<button type="button" name="calc_commission" id="'.$data->customer_id.'" class="btn_calc_commission btn btn-success btn -sm" disabled>Đã tạm tinh</button>';
                        return $button;
                    }
                    else{
                        $button = '<button type="button" name="calc_commission" id="'.$data->customer_id.'" class="btn_calc_commission btn btn-primary btn -sm">Tạm tính Hoa Hồng</button>';
                        return $button;
                    }
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('dataSearch')) {
                        $sql = "CONCAT(tbl_users.lastname,' ',tbl_users.firstname)  like ?";
                        $query->whereRaw($sql, ["%{$request->get('dataSearch')}%"])
                            ->orWhere('order_id','LIKE',"%{$request->get('dataSearch')}%");
                    }
                })
                ->addColumn('STT','')
                ->rawColumns(['STT','action'])
                ->editColumn('created_at',function($data){
                    $dt = $data->created_at;
                    $dt2 = Carbon::parse($dt)->format('d/m/Y');
                    return $dt2;
                })
                ->editColumn('total',function($data){
                    
                    return number_format($data->total, 0, ',', '.' );
                })
                ->make(true); 
    }
}
