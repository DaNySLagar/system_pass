<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Yury Brayan Huaquilla Torres',
            'email' => 'admin@otic.com',
            'ncard' => '0001',
            'charge_id' => rand(1,4),
            'dependence_id' => rand(1,27),
            'password' => bcrypt('password'),
        ])->assignRole('Administrador');

//        User::create([
//            'name' => 'Brad Tyler Sanchez Mamani',
//            'email' => 'brad@hotmail.com',
//            'ncard' => '0002',
//            'charge_id' => rand(1,4),
//            'dependence_id' => rand(1,27),
//            'password' => bcrypt('password'),
//        ])->assignRole('Empleado');
//
//        User::create([
//            'name' => 'Marcos Deniss Choque Castro',
//            'email' => 'deniss@hotmail.com',
//            'ncard' => '0003',
//            'charge_id' => rand(1,4),
//            'dependence_id' => rand(1,27),
//            'password' => bcrypt('password'),
//        ])->assignRole('JefeOficina');
//
//        User::create([
//            'name' => 'Milton Jarata Quispe',
//            'email' => 'Milton@hotmail.com',
//            'ncard' => '0004',
//            'charge_id' => rand(1,4),
//            'dependence_id' => rand(1,27),
//            'password' => bcrypt('password'),
//        ])->assignRole('JefeRrHh');
//
//        User::create([
//            'name' => 'Henry Denilson Huaralla Chipana',
//            'email' => 'Henry@hotmail.com',
//            'ncard' => '0005',
//            'charge_id' => rand(1,4),
//            'dependence_id' => rand(1,27),
//            'password' => bcrypt('password'),
//        ])->assignRole('Guardian');
//
//        User::factory(70)->create();

    }
}
