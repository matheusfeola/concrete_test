<?php

class Dependencies
{
    
    //onde os valores de dependencias ficam armazenados
    public $matriz_dependencias;
    
    public function __construct()
    {
        $this->matriz_dependencias = array();
    }

    public function add_direct($indice, $dependencies)
    {
        $this->matriz_dependencias[$indice] = explode(",", $dependencies);
    }
    public function dependencies_for($elemento)
    {
        //array onde serao guardados as dependencias do elemento passado no parametro
        $dependentes = array();
        //processar recebe as dependencias do elemento 
        $processar   = $this->matriz_dependencias[$elemento];
        
        while (!empty($processar)) {
            
            //pegar um item do topo de processar
            $x = array_shift($processar);
            
            //se x nao e o proprio elemento, e nao esta no array de dependentes
            if ($x != $elemento && !in_array($x, $dependentes)) {
                
                //colocar no array de dependentes
                $dependentes[] = $x;
                
                //se x existe em na matriz_dependencias
                if (array_key_exists($x, $this->matriz_dependencias)) {
                    
                    //quebrar a proxima lista de dependencias em strings
                    if (gettype($this->matriz_dependencias[$x]) == "array") {
                        foreach ($this->matriz_dependencias[$x] as $key => $value) {
                            array_push($processar, $value);
                        }
                    }
                    
                    else {
                        //colocar  a linha de x no processar
                        array_push($processar, array_values($this->matriz_dependencias[$x]));
                    }
                }
            }
        }
        return $dependentes;
    }
} //endclass