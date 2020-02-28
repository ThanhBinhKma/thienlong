<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'ThanhBinh',
        	'email' => 'ThanhBinhKma27@gmail.com',
        	'password'=> bcrypt('123456'),
        	'phone' => '0972365339',
        	'date' => '27/11/1998',
        	'address' => 'Nam Định',
        	'gender' => 1,
        	'status' => 1
        ]);
    }
}
