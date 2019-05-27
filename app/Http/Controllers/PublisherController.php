<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Auth;
use DateTime;

class PublisherController extends Controller
{
    public function index()
    {
        return view('affilate.publisher.dashboard');
    }

    public function getSaleProfit() 
    {
        return view('affilate.publisher.sale_profit');
    }


    public function getDataAdvertiser() {
        $orgs = DB::table('tbl_org')->get();
        return Datatables::of($orgs)
                        ->addColumn('action', function($org) {
                            return '<button type="button" class="btn btn-primary btn-flat" id="' .$org->org_id .'" name="register-advertiser">Đăng ký </button>' ;
                        })
                        ->make(true);
    }

    public function getDataOrg() {
        $data = DB::table('tbl_user_link')
                    ->join('tbl_org', 'tbl_user_link.org_id', '=', 'tbl_org.org_id')
                    ->where('user_id', Auth::user()->user_id)
                    ->select( DB::raw('concat(tbl_org.org_uri, "?uc=",  tbl_user_link.user_code) as link_referal'), 'tbl_org.org_name', 'tbl_user_link.created_at')
                    ->get();
        return Datatables::of($data)
                        ->addColumn('stt', '')
                        ->make(true);
    }

    public function getAdvertiser(Request $request)
    {
        return view('affilate.publisher.advertisers');
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

    // public function createRelationship(Request $request) {
    //     $user_code = $request->get('user_code');
    //     $user_link_id = DB::table('tbl_user_link')->where('user_code', $user_code)->value('user_link_id');
    //     DB::table('tbl_customer_action')->insert([
    //         'user_link_id' => $user_link_id,
    //         'action' => 1,
    //         'created_at'=> new DateTime(),
    //         'updated_at'=> new DateTime(),
    //     ]);
    // }
}
