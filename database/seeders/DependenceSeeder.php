<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Dependence;

class DependenceSeeder extends Seeder
{
    public function run(): void
    {

        // Crear oficinas principales
        $gobernacionRegional = Dependence::create(['name_dependence' => 'GOBERNACIÓN REGIONAL']);
        $consejoRegional = Dependence::create(['name_dependence' => 'CONSEJO REGIONAL']);
        $gerenciaRegional = Dependence::create(['name_dependence' => 'GERENCIA GENERAL REGIONAL']);

        // Crear suboficinas de //gobernacionRegional
        Dependence::create(['name_dependence' => 'OFICINA REGIONAL DE CONTROL INSTITUCIONAL', 'belonging_to' => $gobernacionRegional->id]);
        Dependence::create(['name_dependence' => 'PROCURADURÍA PÚBLICA REGIONAL', 'belonging_to' => $gobernacionRegional->id]);
        Dependence::create(['name_dependence' => 'OFICINA DE COMUNICACIONES Y RELACIONES PÚBLICAS', 'belonging_to' => $gobernacionRegional->id]);
        Dependence::create(['name_dependence' => 'OFICINA REGIONAL DE GESTIÓN DEL RIESGO DE DESASTRES Y SEGURIDAD', 'belonging_to' => $gobernacionRegional->id]);
        Dependence::create(['name_dependence' => 'OFICINA DE DIÁLOGO E INTEGRIDAD INSTITUCIONAL', 'belonging_to' => $gobernacionRegional->id]);
        Dependence::create(['name_dependence' => 'CONSEJO DE COORDINACIÓN REGIONAL', 'belonging_to' => $gobernacionRegional->id]);
        Dependence::create(['name_dependence' => 'CONSEJOS CONSULTIVOS REGIONALES', 'belonging_to' => $gobernacionRegional->id]);


        // Crear suboficinas de //consejoRegional
        Dependence::create(['name_dependence' => 'SECRETARIA DEL CONSEJO REGIONAL', 'belonging_to' => $consejoRegional->id]);

        // Crear suboficinas de //gerenciaRegional
        $administracion = Dependence::create(['name_dependence' => 'OFICINA REGIONAL DE ADMINISTRACIÓN', 'belonging_to' => $gerenciaRegional->id]);
        $secretariaInst = Dependence::create(['name_dependence' => 'SECRETARÍA INSTITUCIONAL', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'OFICINA REGIONAL DE SUPERVISIÓN Y LIQUIDACIÓN DE PROYECTOS', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'OFICINA REGIONAL DE ASESORÍA JURÍDICA', 'belonging_to' => $gerenciaRegional->id]);
        $modernizacion = Dependence::create(['name_dependence' => 'GERENCIA REGIONAL DE PLANEAMIENTO, PRESUPUESTO Y MODERNIZACIÓN', 'belonging_to' => $gerenciaRegional->id]);
        $economico = Dependence::create(['name_dependence' => 'GERENCIA REGIONAL DE DESARROLLO ECONÓMICO', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'GERENCIA REGIONAL DE DESARROLLO AGRARIO', 'belonging_to' => $gerenciaRegional->id]);
        $desarrollosocial = Dependence::create(['name_dependence' => 'GERENCIA REGIONAL DE DESARROLLO SOCIAL', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'GERENCIA REGIONAL DE EDUCACIÓN', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'DIRECCIÓN DE ESTUDIOS DE PRE INVERSIÓN', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'GERENCIA REGIONAL DE SALUD', 'belonging_to' => $gerenciaRegional->id]);
        $infraestructura = Dependence::create(['name_dependence' => 'GERENCIA REGIONAL DE INFRAESTRUCTURA', 'belonging_to' => $gerenciaRegional->id]);
        $ambiental =Dependence::create(['name_dependence' => 'GERENCIA REGIONAL DE AUTORIDAD AMBIENTAL', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'PROGRAMA DE APOYO AL DESARROLLO RURAL AMBIENTAL', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'PROGRAMA REGIONAL DE RIEGO Y DRENAJE', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'PROGRAMA REGIONAL PUNO DESARROLLA', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'AUTORIDAD AUTÓNOMA INKANI', 'belonging_to' => $gerenciaRegional->id]);
        Dependence::create(['name_dependence' => 'ARCHIVO REGIONAL DE PUNO', 'belonging_to' => $gerenciaRegional->id]);

        // Crear suboficinas de administracion
        Dependence::create(['name_dependence' => 'OFICINA DE RECURSOS HUMANOS', 'belonging_to' => $administracion->id]);
        Dependence::create(['name_dependence' => 'OFICINA DE ABASTECIMIENTO Y SERVICIOS AUXILIARES', 'belonging_to' => $administracion->id]);
        Dependence::create(['name_dependence' => 'OFICINA DE CONTABILIDAD', 'belonging_to' => $administracion->id]);
        Dependence::create(['name_dependence' => 'OFICINA DE TESORERÍA', 'belonging_to' => $administracion->id]);
        Dependence::create(['name_dependence' => 'OFICINA DE BIENES REGIONALES', 'belonging_to' => $administracion->id]);
        Dependence::create(['name_dependence' => 'OFICINA DE EQUIPO MECÁNICO', 'belonging_to' => $administracion->id]);

        // Crear suboficinas de INSTITUCIONAL
        Dependence::create(['name_dependence' => 'OFICINA DE GESTIÓN DOCUMENTARIA Y ARCHIVO CENTRAL', 'belonging_to' => $secretariaInst->id]);
        Dependence::create(['name_dependence' => 'OFICINA DE TECNOLOGÍAS DE LA INFORMACIÓN', 'belonging_to' => $secretariaInst->id]);

        // Crear suboficinas de MODERNIZACIÓN
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE PLANEAMIENTO', 'belonging_to' => $modernizacion->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE PROGRAMACIÓN MULTIANUAL DE INVERSIONES Y C.T.I', 'belonging_to' => $modernizacion->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE PRESUPUESTO', 'belonging_to' => $modernizacion->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE MODERNIZACIÓN INSTITUCIONAL', 'belonging_to' => $modernizacion->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE ORDENAMIENTO Y DEMARCACIÓN TERRITORIAL', 'belonging_to' => $modernizacion->id]);

        // Crear suboficinas de ECONÓMICO
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE INVERSIÓN PRIVADA', 'belonging_to' => $economico->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE COMPETIVIDAD E INNOVACIÓN TECNOLÓGICA', 'belonging_to' => $economico->id]);

        // Crear suboficinas de SOCIAL
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE ASUNTOS SOCIALES', 'belonging_to' => $desarrollosocial->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE CULTURA', 'belonging_to' => $desarrollosocial->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE ATENCIÓN A PERSONAS CON DISCAPACIDAD', 'belonging_to' => $desarrollosocial->id]);

        // Crear suboficinas de INFRAESTRUCTURA
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE ESTUDIOS DEFINITIVOS', 'belonging_to' => $infraestructura->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE OBRAS', 'belonging_to' => $infraestructura->id]);

        // Crear suboficinas de AMBIENTAL
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE RECURSOS NATURALES', 'belonging_to' => $ambiental->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE GESTIÓN AMBIENTAL', 'belonging_to' => $ambiental->id]);
        Dependence::create(['name_dependence' => 'SUB GERENCIA DE RECURSOS HÍDRICOS', 'belonging_to' => $ambiental->id]);

    
    }
}
