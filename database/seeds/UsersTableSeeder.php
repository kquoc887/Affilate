<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phone = [
                '0901407600',
                '0901407601',
                '0901407602',
                '0901407603',
                '0901407604',

        ];
        for( $i=0; $i<=10 ;$i++){
            DB::table('tbl_users')->insert([
                    'email' => 'user_'.$i.'@gmail.com',
                    'password' => bcrypt('123456789'),
                    'firstname' =>'user_'.$i,
                    'lastname' => Str::random(5),
                    'gender' => rand(0,3),
                    'address' => Str::random(10),
                    'phone' => Arr::random($phone),
                    'uri' => 'google'.$i.'.com.vn',
                    'remember_token' => Str::random(20),
                    'role' => rand(0,1),
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
                ]);
        }
        
    }
}
