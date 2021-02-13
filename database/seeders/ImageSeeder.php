<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'remember_token' => '',]

        ];

        $passwords = [
            ['password' => Hash::make('openadmin')],
        ];

        foreach ($users as $key => $value) {
            User::firstOrCreate($value, $passwords[$key]);
        }
    }
}
