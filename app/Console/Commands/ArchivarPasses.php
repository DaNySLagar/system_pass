<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pass; 

class ArchivarPasses extends Command
{
    protected $signature = 'app:archivar-passes';
    protected $description = 'Archivar Papeletas al finalizar el dia';

    public function handle()
    {
        Pass::where('estado', 3)
            ->update(['estado' => 4]);

        $this->info('Registros archivados.');
    }
}
