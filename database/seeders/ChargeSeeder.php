<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Charge;

class ChargeSeeder extends Seeder
{

    public function run(): void
    {

        $charges = [
            "ASISTENTE",
            "SECRETARIA",
            "ESPECIALISTA",
            "ASESOR",
            "ADMINISTRADOR",
            "COORDINADOR",
            "DIRECTOR",
            "GERENTE",
            "JEFE DE OFICINA",
            "PLANIFICADOR",
            "TÉCNICO",
            "GUARDIÁN",
            "INTEGRADOR",
            "SUB GERENTE",
        ];
        
        foreach ($charges as $charge) {
            Charge::create([
                'name_charge' => $charge,
            ]);
        }
    }
}
