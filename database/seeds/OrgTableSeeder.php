<?php

use Illuminate\Database\Seeder;
use App\User;
class OrgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_role_admin = User::all()->where('role',1);
       foreach($user_role_admin as $usr)
       {
        DB::table('tbl_org')->insert([
            'org_name' => Str::random(30),
            'org_email'=> $usr->email,
            'org_address' =>$usr->address,
            'org_phone' => $usr->phone,
            'org_token' =>Str::random(30),
            'created_at'=>new DateTime(),
            'updated_at' =>new DateTime(),
        ]);
       }
        
    }
}
