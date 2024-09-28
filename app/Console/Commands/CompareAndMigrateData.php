<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CompareAndMigrateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:compare {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compara e migra dados entre a base antiga e nova';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Pegando o nome da tabela a ser comparada
        $table = $this->argument('table');

        // Definindo as conexões de banco de dados
        $oldDb = DB::connection('mysql_old');  // conexão para o banco antigo
        $newDb = DB::connection('mysql');      // conexão para o banco novo

        // Buscando todos os dados da tabela antiga
        $oldData = $oldDb->table($table)
                        ->get();

        $this->info('Comparando e migrando dados...');
        $this->info('Localizamos ' . $oldData->count() . ' registros para serem comparados...');

        $insertedCount = 0;

        // Loop sobre cada registro da base antiga
        foreach ($oldData as $oldRow) {

            // Verifica se o ID já existe na base nova
            $exists = $newDb->table($table)->where('id', $oldRow->id)->exists();

            if (!$exists) {
                $this->info('#'.$insertedCount . " - Registro inserido com sucesso: ID {$oldRow->id}");
                // Se não existir, insere o registro na nova base
                $newDb->table($table)->insert((array) $oldRow);
                $insertedCount++;
            }
        }

        $this->info("$insertedCount registros foram migrados com sucesso!");
    }
}
