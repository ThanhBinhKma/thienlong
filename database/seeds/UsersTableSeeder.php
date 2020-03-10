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
        'name' => 'Phi Long Media',
        'email' => 'Philongmedia@gmail.com',
        'password' => bcrypt('Philongmedia123@'),
      ]
    ]);
  }
}
