<?php

class Palabras {
    static private $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Palabras("txt/palabras.txt");
        }
        return self::$instance;
    }

    protected $nombreFichero = "txt/palabras.txt";
    protected $listaPalabras = [];
    protected $elegida;

    private function __construct($nombreFichero) {

         $this->nombreFichero = $nombreFichero;

        $palabraFichero = ''; //Almacena cada palabra leida del fichero
        // Proceso para leer las palabras del fichero de texto

        $fichero = fopen($this->nombreFichero, 'r');
        // recorre todas las palabras y las guarda en el array $listaPalabras.
        // de forma separada
        while ($palabraFichero = fgets($fichero)) {
            $this->listaPalabras[] = trim($palabraFichero);
        }
    }
    
    public function getPalabra(){
        $this->elegida = $this->listaPalabras[array_rand($this->listaPalabras,1)];
        return $this->elegida;
    }
    function tamanioPalabra(){
        return strlen($this->elegida);
    }
    
  
}
