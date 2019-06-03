<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Auth;
use DateTime;
use Carbon\Carbon;

class PublisherController extends Controller
{
    //Trả về màn hình dashboard
    public function index()
    {
        $user = Auth::user();
        
       
        $numberOrder = DB::table('tbl_user_link')->join('tbl_customer_action', 'tbl_user_link.user_link_id', '=', 'tbl_customer_action.user_link_id')
                                  ->where('tbl_user_link.user_id', $user->user_id)
                                  ->count();
        // $org_id = DB::table('tbl_user_link')->where('user_id', $user->id)->value('org_id');
        $totalCommission =  DB::table('tbl_user_link')->join('tbl_customer_action', 'tbl_user_link.user_link_id', '=', 'tbl_customer_action.user_link_id')
                                ->where('tbl_user_link.user_id', $user->user_id)
                                ->sum('tbl_customer_action.total') * 0.2;

        $totalCommissionOfMonth = DB::table('tbl_user_link')->join('tbl_customer_action', 'tbl_user_link.user_link_id', '=', 'tbl_customer_action.user_link_id')
                                        ->where('tbl_user_link.user_id', $user->user_id)
                                        ->whereMonth('tbl_customer_action.created_at',  Carbon::now()->month)
                                        ->sum('tbl_customer_action.total') * 0.2;
     
        return view('affilate.publisher.dashboard', compact('numberOrder', 'totalCommission', 'totalCommissionOfMonth'));
    }

    public function getSaleProfit() 
    {
        return view('affilate.publisher.sale_profit');
    }

    public function getAdvertiser(Request $request)
    {
        return view('affilate.publisher.advertisers');
    }

    // Lấy danh sách các công ty để CTV có thể đăng ký
    public function getDataAdvertiser() {
        DB::statement(DB::raw('set @rownum=0'));
        $orgs = DB::table('tbl_org')->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'org_name', 'org_uri', 'org_address', 'org_id')->get();
       
        return Datatables::of($orgs)
                        ->addColumn('action', function($org) {
                            $user_id = Auth::user()->user_id;

                            //exists() trả về true false;
                            $result = DB::table('tbl_user_link')->where('user_id', $user_id)
                                                                ->where('org_id', $org->org_id)
                                                                ->exists();
                            if ($result) {
                                $button_html = '<button type="button" class="btn btn-primary btn-flat" id="' .$org->org_id .'" name="register-advertiser" disabled>Đăng ký </button>' ;
                            } else {
                                $button_html = '<button type="button" class="btn btn-primary btn-flat" id="' .$org->org_id .'" name="register-advertiser">Đăng ký </button>' ;
                            }
                            return $button_html;
                         
                        })
                        ->make(true);
    }

    // Lấy danh sách các công ty mà CTV đã đăng ký
    public function getDataOrg() {
        DB::statement(DB::raw('set @rownum=0'));
        
        $data = DB::table('tbl_user_link')
                    ->join('tbl_org', 'tbl_user_link.org_id', '=', 'tbl_org.org_id')
                    ->where('user_id', Auth::user()->user_id)
                    ->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'), DB::raw('concat(tbl_org.org_uri, "?uc=",  tbl_user_link.user_code) as link_referal'), 'tbl_org.org_name', 'tbl_user_link.created_at')
                    ->take(5)
                    ->get();
        
                    return Datatables::of($data)
                        ->editColumn('created_at', function($item) {
                            return $item->created_at ? with(new Carbon($item->created_at))->format('d/m/Y') : '';
                        })
                        ->addColumn('stt', '')
                        ->make(true);
    }

    // Lấy danh sách các đơn hàng thành công của CTV
    public function getDataOrder() {
        DB::statement(DB::raw('set @rownum=0'));
        
        $data = DB::table('tbl_customer_action')
                    ->join('tbl_user_link', 'tbl_customer_action.user_link_id', '=', 'tbl_user_link.user_link_id')
                    ->where('tbl_user_link.user_id', Auth::user()->user_id)
                    ->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'tbl_customer_action.order_id', 'tbl_customer_action.total', 'tbl_customer_action.created_at')
                    ->orderBy('tbl_customer_action.created_at', 'desc')
                    ->get();
       
                    return Datatables::of($data)
                        ->editColumn('created_at', function($item) {
                            return $item->created_at ? with(new Carbon($item->created_at))->format('d/m/Y') : '';
                        })
                        // ->filterColumn('created_at', function ($query, $keyword) {
                        //     $query->whereRaw("DATE_FORMAT(created_at,'%m/%d/%Y') like ?", ["%$keyword%"]);
                        // })
                        ->addColumn('stt', '')
                        ->make(true);
    }   
    

   

    public function registerAdvertiser(Request $request) {
        if ($request->ajax()) {
            $org_id     = $request->post('org_id');
            $org        = DB::table('tbl_org')->where('org_id', $org_id)->first();
            $user_id    = Auth::user()->user_id;
            $user_code  = str_random(20);
        
            $data = [
                'org_id' => $org_id,
                'user_id' => $user_id,
                'user_code' => $user_code,
                'created_at'=> new DateTime(),
                'updated_at'=> new DateTime(),
            ];

            $result = DB::table('tbl_user_link')->insert($data);   
            
            if ($request == true) {
                return response()->json(['user_code' => $user_code, 'org_name' => $org->org_name]);
            }
        }
    }

    public function getEditProfile() {
        $user = Auth::user();
        return view('affilate.publisher.edit_profile', compact('user'));
    }

    public function postEditProfile(Request $request) {    
        $user = Auth::user();
        if ($request->fileAvatar) {
            $image              = $request->file('fileAvatar');
            $fileName           = $image->getClientOriginalName();        
            $image->move('img', $fileName);
            $user->avatar       = $fileName;
         }
        
        if ($request->has('password')) {
            $user->password     = $request->password;
        }

        $user->email        = $request->email;
        $user->lastname     = $request->lastname;
        $user->firstname    = $request->firstname;
        $user->address      = $request->address;
        $user->phone        = $request->phone;
        $user->uri          = $request->uri;
        $user->save();
        return redirect()->route('publisher.infoUser');
    }

    public function getInfoUser() {
        return view('affilate.publisher.info_user');
    }
}
