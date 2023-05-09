<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ["Admin","Гурман","Готвач"];

        foreach($roles as $role){
            $addRole = new Roles();
            $addRole->role_name = $role;
            $addRole->save();
        }
    }
}
