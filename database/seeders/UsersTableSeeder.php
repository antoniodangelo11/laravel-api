<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'  => 'Antonio',
                'email' =>  'reapercsp@gmail.com',
                'password' => Hash::make('Eden11'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
