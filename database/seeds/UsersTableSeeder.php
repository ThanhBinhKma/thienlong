<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
        'name' => 'Huy Dương',
        'email' => 'DunngManhHuy@gmail.com',
        'password' => bcrypt('123456'),
      ],
      [
        'name' => 'Hoàng Quân',
        'email' => 'HoangQuan@gmail.com',
        'password' => bcrypt('123456'),
      ],[
        'name' => 'Thanh Bình',
        'email' => 'thanhbinhkma27@gmail.com',
        'password' => bcrypt('123456'),
      ],
    ]);
  }
}
