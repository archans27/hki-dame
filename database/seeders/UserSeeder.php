<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //USER
        User::create([
            'name' => 'Admin HKI',
            'email' => 'hkidame@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor01',
            'email' => 'sektor1@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor02',
            'email' => 'sektor2@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor03',
            'email' => 'sektor3@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor04',
            'email' => 'sektor4@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor05',
            'email' => 'sektor5@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor06',
            'email' => 'sektor6@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor07',
            'email' => 'sektor7@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor08',
            'email' => 'sektor8@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor09',
            'email' => 'sektor9@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor10',
            'email' => 'sektor10@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor11',
            'email' => 'sektor11@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor12',
            'email' => 'sektor12@mail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Admin Sektor13',
            'email' => 'sektor13@mail.com',
            'password' => Hash::make('password')
        ]);
    }
}
