<?php

require_once 'Dependencies.class.php';

 class Dependencies_Test {

     public $dependencies;

     public function __construct() {
         $this->dependencies = new DependenciesList();
     }

     public function add_direct_test() {
         $this->dependencies->add_direct('A', 'B,C');
          $this->dependencies->add_direct('B', 'C,E');
          $this->dependencies->add_direct('C', 'G');
          $this->dependencies->add_direct('D', 'A,F');
          $this->dependencies->add_direct('E', 'F');
         $this->dependencies->add_direct('F', 'H');
     }

 }

$test = new Dependencies_Test();
$test->add_direct_test();
$resultado = $test->dependencies->dependencies_for("A");

//imprimir o array de dependencias na tela
var_dump($resultado);