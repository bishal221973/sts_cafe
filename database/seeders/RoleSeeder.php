<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadminUser=User::create([
            'name'=>'STS Entertainment',
            'email'=>'sts@gmail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('password')
        ]);
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superadminUser->assignRole($superAdmin);
        Role::firstOrCreate(['name' => 'admin']);


        Permission::firstOrCreate(['name' => 'category']);
        Permission::firstOrCreate(['name' => 'subcategory']);
        Permission::firstOrCreate(['name' => 'product']);
        Permission::firstOrCreate(['name' => 'supplier']);
        Permission::firstOrCreate(['name' => 'purchase']);
        Permission::firstOrCreate(['name' => 'stock']);
        Permission::firstOrCreate(['name' => 'user']);
        Permission::firstOrCreate(['name' => 'report']);
        Permission::firstOrCreate(['name' => 'pos']);



        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $superadminUser->givePermissionTo($permission);
        }
    }
}
