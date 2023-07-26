<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'denny.az45@gmail.com')->first()) {
            User::create([
                'name' => 'Denny',
                'email' => 'denny.az45@gmail.com',
                'password' => Hash::make('Sayarudi12'),
                'email_verified_at' => Carbon::now()
            ]);
        }
    }
}
