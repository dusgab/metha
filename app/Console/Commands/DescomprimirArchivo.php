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
        /*Obtener ultimo archivo de precios Mayoristas de Productos Horticolas
        del Mercado de Buenos Aires*/
        
        $url = "http://www.mercadocentral.gob.ar/servicios/precios-y-volúmenes/precios-mayoristas";
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $html = curl_exec($ch);
        curl_close($ch);
        
        # Create a DOM parser object
        $dom = new \DOMDocument();

        # Parse the HTML from Google.
        # The @ before the method call suppresses any warnings that
        # loadHTML might throw because of invalid HTML in the page.
        @$dom->loadHTML($html);

        $xpath = new \DOMXpath($dom);
        
        $path = $xpath->query('//span[contains(@class, "file")]');
        
        $direccion = array();
        $i = 0;
        foreach($xpath->query('//span[contains(@class, "file")]') as $dom) 
        {   
            $path = $dom->getElementsByTagName('a')[0]->getAttribute("href");
            $direccion[] = $path;
            $i++;
        }

        $data = $direccion[1]; //Obtengo solo la URL del ultimo xsl del Mercado de BA.
        $ch1 = curl_init();
        $timeout = 5;
        curl_setopt($ch1, CURLOPT_URL, $data);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
        $dir = curl_exec($ch1);
        curl_close($ch1);
        
        // Guardar archivo
        $date = date("d-m-Y");
        $destination = "precios-" . $date . ".zip"; //Formato de nombre: precios-25-10-2017.zip
        $file = fopen($destination, "w+");
        fputs($file, $dir);
        fclose($file);

        //Descomprimir
        $zipper = new Zipper();
        $zipper->make($destination)->extractTo('public/recursos'); //Descomprimo en /public/recursos
        $res = $zipper->getStatus();
        if($res != 'No error'){
            echo 'Ocurrio un error al descomprimir.';
            echo $res;
            redirect('/');
        }
        
        $zipper->close();
        unlink($destination); //Elimino el .zip
    }
}
