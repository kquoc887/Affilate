<?php

use Illuminate\Database\Seeder;

class Customer_actionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<=10;$i++)
            DB::table('tbl_customer_action')->insert([
                'user_link_id' => rand(1,14),
                'action' =>rand(0,3),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
    }
}
