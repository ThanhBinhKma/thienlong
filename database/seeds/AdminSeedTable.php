<?php

use Illuminate\Database\Seeder;

class AdminSeedTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
        	[
        		'name' => 'Thanh Bình',
        		'email' => 'Thanhbinhkma27@gmail.com',
        		'password' => bcrypt(123456),
        		'created_at'=>null,
        		'updated_at'=>null
        	],
        ]);
    }
}
