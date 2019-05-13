<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $role = array(
            ['name' => 'Root', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['name' => 'Mod', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['name' => 'Admin', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['name' => 'User', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('roles')->insert($role);
    }
}
