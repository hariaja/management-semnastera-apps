<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      'users.name',
      'roles.name',
      'registrations.name',
    ];

    foreach ($items as $item) :
      PermissionCategory::create([
        'name' => $item
      ]);
    endforeach;
  }
}
