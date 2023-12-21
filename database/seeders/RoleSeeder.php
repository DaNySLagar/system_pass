<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $rolAdmin = Role::create(['name' => 'Administrador']);
        $rolEmployee = Role::create(['name' => 'Empleado']);
        $rolBoss = Role::create(['name' => 'JefeOficina']);
        $rolRh = Role::create(['name' => 'JefeRrHh']);
        $rolGuardian = Role::create(['name' => 'Guardian']);


        Permission::create(['name' => 'home'])->syncRoles([$rolAdmin, $rolEmployee,$rolBoss, $rolRh, $rolGuardian]);

        Permission::create(['name' => 'dashboard'])->syncRoles([$rolAdmin, $rolEmployee,$rolBoss, $rolRh, $rolGuardian]);
        
        Permission::create(['name' => 'petition.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'petition.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'petition.update'])->syncRoles([$rolAdmin]);

        Permission::create(['name' => 'users.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'users.update'])->syncRoles([$rolAdmin]);

        Permission::create(['name' => 'passes.index'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'passes.show'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'passes.create'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'passes.edit'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'passes.destroy'])->syncRoles([$rolEmployee]);

        Permission::create(['name' => 'passes.reporte'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'passes.print'])->syncRoles([$rolEmployee]);

        Permission::create(['name' => 'passes.firmar'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'passes.firmaruser'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'passes.firmarboss'])->syncRoles([$rolBoss]);
        Permission::create(['name' => 'passes.firmarrh'])->syncRoles([$rolRh]);

        Permission::create(['name' => 'passes.archivar'])->syncRoles([$rolGuardian]);
        Permission::create(['name' => 'archived.index'])->syncRoles([$rolAdmin, $rolGuardian, $rolRh]);
        Permission::create(['name' => 'archived.show'])->syncRoles([$rolAdmin, $rolGuardian]);
        Permission::create(['name' => 'archived.reporte'])->syncRoles([$rolAdmin, $rolGuardian]);

        Permission::create(['name' => 'hours.index'])->syncRoles([$rolGuardian]);
        Permission::create(['name' => 'hours.asignarHoraSalida'])->syncRoles([$rolGuardian]);
        Permission::create(['name' => 'hours.asignarHoraRetorno'])->syncRoles([$rolGuardian]);
        Permission::create(['name' => 'hours.store'])->syncRoles([$rolGuardian]);

        Permission::create(['name' => 'passesadmin.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'usernocheck.index'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'usercheck.index'])->syncRoles([$rolEmployee]);
        Permission::create(['name' => 'bosscheck.index'])->syncRoles([$rolBoss]);
        Permission::create(['name' => 'rhcheck.index'])->syncRoles([$rolRh]);

        Permission::create(['name' => 'charges.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'charges.create'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'charges.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'charges.destroy'])->syncRoles([$rolAdmin]);

        Permission::create(['name' => 'dependences.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'dependences.create'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'dependences.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'dependences.destroy'])->syncRoles([$rolAdmin]);

        Permission::create(['name' => 'times.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'times.create'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'times.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'times.destroy'])->syncRoles([$rolAdmin]);
    }
}






