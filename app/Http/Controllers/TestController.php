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
        $org_id = DB::table('tbl_org')->where('org_email', Auth::user()->email)->value('org_id');
        $new_order =  DB::table('tbl_user_link')
                                ->join('tbl_customer_action', 'tbl_user_link.user_link_id', '=', 'tbl_customer_action.user_link_id')
                                ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                                ->where('tbl_user_link.org_id', $org_id)->orderBy('tbl_customer_action.created_at','DESC')
                                ->select(DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'),'tbl_customer_action.created_at','tbl_customer_action.order_id')

                                ->take(2)
                                ->get();
        
        return view('affilate.web.home',['new_order'=>$new_order]);

    }
    public function getDataUserLink(){

        $org_id = DB::table('tbl_org')->where('org_email', Auth::user()->email)->value('org_id');

        $user_link = DB::table('tbl_user_link')
                        ->join('tbl_users','tbl_user_link.user_id','=','tbl_users.user_id')
                        ->join('tbl_org','tbl_user_link.org_id','=','tbl_org.org_id')
                        ->where('tbl_user_link.org_id', $org_id)
                        ->select('tbl_user_link.*','tbl_user_link.user_id','tbl_users.email','tbl_org.org_name','tbl_users.active', DB::raw('concat(tbl_users.lastname, " ",  tbl_users.firstname) as fullname'))
                        ->get();
        // return $user_link;

         return datatables()->of($user_link)
            ->addColumn('action',function($data){
                switch($data->active){
                    case 1:
                        $button = '<button type="button" name="unlock" id="'.$data->user_id.'" class="btn_unlock btn btn-primary btn -sm" disabled>Mở Khóa</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button  type="button" name="lock" id="'.$data->user_id.'" class="btn_lock btn btn-danger btn-sm">Khóa</button>';
                        return $button;
                        break;
                    case 2:
                        $button = '<button type="button" name="unlock" id="'.$data->user_id.'" class="btn_unlock btn btn-primary btn -sm" >Mở Khóa</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button  type="button" name="lock" id="'.$data->user_id.'" class="btn_lock btn btn-danger btn-sm" disabled>Khóa</button>';
                        return $button;
                        break;
                }
               
            })
            ->addColumn('active',function($data){
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
            if(!empty($request->get('todate'))){
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
                        $button = '<button type="button" name="calc_commission" id="btn_calc_commission" value="'.$data->order_id.'" class=" btn btn-primary btn -sm">Tạm tính Hoa Hồng</button>';
                        return $button;
                    })
                    ->addColumn('STT','')
                    ->rawColumns(['STT','action'])
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
                        $button = '<button type="button" name="calc_commission" id="btn_calc_commission" value="'.$data->order_id.'" class=" btn btn-primary btn -sm">Tạm tính Hoa Hồng</button>';
                        return $button;
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
            'customer_id' => $payment->customer_id,
            'order_id' => $payment->order_id,
            'discount' => $payment->total*$payment->org_commision,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
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
        $table_ctv = DB::table('tbl_user_link')->where('org_id', $org->org_id)->get();
        $arr = array();
        foreach ($table_ctv as $ctv) {
            $total = DB::table('tbl_customer_action')
                                ->join('tbl_payment', 'tbl_customer_action.customer_id', '=', 'tbl_payment.customer_id')
                                ->where('user_link_id',$ctv->user_link_id)
                                ->whereMonth('tbl_customer_action.created_at', $month)
                                ->sum('discount');
            $total_profit = DB::table('tbl_customer_action')
                                ->whereMonth('tbl_customer_action.created_at', $month)
                                ->where('user_link_id',$ctv->user_link_id)
                                ->sum('total');
            $user = DB::table('tbl_users')->where('user_id', $ctv->user_id)->select(DB::raw('concat(lastname, " ",  firstname) as fullname'))->first();
            $arr_record= array(
            
                    'fullname' => $user->fullname,
                    'totalProfit'=> $total_profit,
                    'commision' => $org->org_commision,
                    'total' => $total
            );
            array_push($arr,$arr_record);
        }
        return datatables()->of($arr)
        ->addColumn('action',function($data){
            $button = '<button type="button" name="calc_commission" id="btn_calc_commission" class=" btn btn-primary btn -sm">Thanh Toán</button>';
            return $button;
        })
        ->addColumn('STT','')
        ->rawColumns(['STT','action'])
        ->make(true);

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
