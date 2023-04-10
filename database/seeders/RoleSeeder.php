<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    // Role Name
    $datas = [
      Constant::ADMIN,
      Constant::PRESENTER,
      Constant::REVIEWER,
      Constant::PARTICIPANT,
    ];

    foreach ($datas as $data) :
      $roles = Role::create([
        'name' => $data,
        'guard_name' => 'web'
      ]);
    endforeach;

    $presenter = $roles->where('name', Constant::PRESENTER)->first();
    $presenter->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->orWhere('name', 'LIKE', 'transactions.index')
        ->orWhere('name', 'LIKE', 'transactions.create')
        ->orWhere('name', 'LIKE', 'transactions.store')
        ->orWhere('name', 'LIKE', 'transactions.show')
        ->orWhere('name', 'LIKE', 'transactions.destroy')
        ->get()
    );

    $reviewer = $roles->where('name', Constant::REVIEWER)->first();
    $reviewer->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->get()
    );

    $perticipant = $roles->where('name', Constant::PARTICIPANT)->first();
    $perticipant->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->get()
    );
  }
}
