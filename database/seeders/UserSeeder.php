<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = [
            [ 'role_id' => 1, 'name' => 'Admin User', 'email' => 'admin@example.com', 'phone' => '+88 (012) 34-567890', 'status' => 1, 'password' => Hash::make('admin123') ],
            [ 'role_id' => 2, 'name' => 'Employee User', 'email' => 'employee@example.com', 'phone' => '+88 (012) 34-567891', 'status' => 1, 'password' => Hash::make('employee123') ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
