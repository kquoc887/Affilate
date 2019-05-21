<?php

use Illuminate\Database\Seeder;

class User_linkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        for($i=0;$i<=10;$i++){
            DB::table('tbl_user_link')->insert([
                'user_id' => rand(1,11),
                'org_id'  => rand(1,6),
                'user_code'  => Str::random(15),
                'created_at'  => new DateTime(),
                'updated_at' => new DateTime()
            ]);
            
        }
    }
}
