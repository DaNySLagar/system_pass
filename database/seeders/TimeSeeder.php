<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Time;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Time::create([
            'time_permision' => '15 min',
        ]);
        Time::create([
            'time_permision' => '30 min',
        ]);
        Time::create([
            'time_permision' => '45 min',
        ]);
        Time::create([
            'time_permision' => '1 hora',
        ]);
        Time::create([
            'time_permision' => '2 horas',
        ]);
        Time::create([
            'time_permision' => '3 horas',
        ]);
        Time::create([
            'time_permision' => '4 horas',
        ]);
        Time::create([
            'time_permision' => '5 horas',
        ]);
        Time::create([
            'time_permision' => '6 horas',
        ]);
        
    }
}
