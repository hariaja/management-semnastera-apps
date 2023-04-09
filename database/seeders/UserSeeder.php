<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $admin = User::create([
      'name' => 'Admin Semnastera',
      'first_name' => 'Admin',
      'last_name' => 'Semnastera',
      'email' => 'admin@gmail.com',
      'phone' => '085798888733',
      'email_verified_at' => now(),
      'password' => bcrypt('password'),
      'gender' => Constant::MALE,
      'institution' => 'POLITEKNIK SUKABUMI',
      'address' => 'Kp. Kebon Randu RT 001/022 Kec. Cibadak, Kab. Sukabumi, Jawa Barat Indonesia 43351',
      'status' => Constant::ACTIVE,
    ]);

    $admin->assignRole(Constant::ADMIN);

    for ($i = 1; $i <= 20; $i++) :
      $persenters = User::factory()->create();
      $persenters->assignRole(Constant::PRESENTER);
    endfor;

    for ($i = 1; $i <= 10; $i++) :
      $participant = User::factory()->create();
      $participant->assignRole(Constant::PARTICIPANT);
    endfor;

    for ($i = 1; $i <= 5; $i++) :
      $reviewer = User::factory()->create();
      $reviewer->assignRole(Constant::REVIEWER);
    endfor;
  }
}
