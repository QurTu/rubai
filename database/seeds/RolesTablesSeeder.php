<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'id'   => 1
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
            'id'   => 2
        ]);
        
    }
}
