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
        'name' => 'Thanh Bình',
        'email' => 'thanhbinhkma27@gmail.com',
        'password' => bcrypt('123456'),
      ]
    ]);
  }
}
