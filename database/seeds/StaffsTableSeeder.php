<?php

use Illuminate\Database\Seeder;

class StaffsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Excel::load('\database\seeds\excel\all_staffs.xlsx', function($reader) {
        foreach ($reader->toArray() as $row) {
          DB::table('staffs')->insert([
            'name' => $row['name'],
          ]); 
        }      
      });
  }
}