<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = "Admin";
        $admin->lastname = "Adminov";
        $admin->email = "admin@brainster.co";
        $admin->mobile = "000-000-000";
        $admin->biography = "I am a admin user";
        $admin->password = bcrypt("admin,1234");
        $admin->profile_image = "https://thumbs.dreamstime.com/b/admin-sign-laptop-icon-stock-vector-166205404.jpg";
        $admin->email_verified_at = Carbon::now();
        $admin->role_id = 1;
        $admin->is_active = true;
        $admin->save();
    }
}
