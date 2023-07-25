<?php

namespace Database\Seeders;

use App\Models\Stack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stacks = ['Laravel', 'CodeIgniter', 'Wordpress', 'Jquery', 'Flutter', 'Bootstrap', 'Tailwind'];

        foreach ($stacks as $key => $value) {
            if (!Stack::where('name', $value)->first()) {
                Stack::create([
                    'name' => $value
                ]);
            }
        }
    }
}
