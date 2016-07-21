<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call('UserTableSeeder');

        //Admin seeder
        DB::table('users')->delete();
        $arrUser = array(
            'email' => 'phucanh94@gmail.com',
            'password' => Hash::make(12345678),
            'userable_id' => '',
            'userable_type' => 'admin',
            'remember_token' => ''
        );
        DB::table('users')->insert($arrUser);
    }

}
