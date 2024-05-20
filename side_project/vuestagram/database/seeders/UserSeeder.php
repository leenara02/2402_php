<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'account' => 'admin',
            'password' => Hash::make('asdf'),
            'name' => '관리자',
            'gender' => '1',
            'profile' => '/profile/default.png'
        ];
        User::create($data);
    }
}
