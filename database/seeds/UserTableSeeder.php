<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $credentials = [
            'id' => 1,
            'email' => 'admin@nuitruc.edu.vn',
            'password' => 'sonna6229a@',
            'first_name' => 'System',
            'last_name' => 'Admin'
        ];

        \Cartalyst\Sentinel\Native\Facades\Sentinel::registerAndActivate($credentials);
    }

}
