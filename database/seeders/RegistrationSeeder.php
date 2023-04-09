<?php

namespace Database\Seeders;

use App\Helpers\Global\Constant;
use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'title' => 'Jadwal Submit Makalah',
        'date_start' => '2023-03-01',
        'date_end' => '2023-03-06',
        'status' => Constant::OPEN,
      ],
      [
        'title' => 'Jadwal Seminar',
        'date_start' => '2023-03-10',
        'date_end' => '2023-03-11',
        'status' => Constant::CLOSE,
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      Registration::firstOrCreate($value);
    endforeach;
  }
}
