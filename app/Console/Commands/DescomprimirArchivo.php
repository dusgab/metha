<?php

namespace MOHA\Console\Commands;

use Illuminate\Console\Command;
use \Chumper\Zipper\Zipper;

class DescomprimirArchivo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'descomprimir:archivo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Descargar y descomprimir archivo excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
    }
}
