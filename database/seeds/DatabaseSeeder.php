<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //Admin seeder
        DB::table('users')->delete();
        $arrUser = array(
            'email' => 'phucanh@gmail.com',
            'password' => Hash::make(12345678),
//            'userable_id' => '',
//            'userable_type' => 'admin',
//            'remember_token' => ''
        );
        DB::table('users')->insert($arrUser);
    }
}
