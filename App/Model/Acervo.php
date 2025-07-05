<?php

namespace App\Model;
// use PDO;
// use PDOException;


// setters e getters
class Acervo{
    public $id, $titulo,$paginas,$autor;



    public function setId($id) {$this->id= $id;}
    public function getId() {return $this->id;}

    public function setTitulo($titulo) {$this->titulo= $titulo;}
    public function getTitulo() {return $this->titulo;}
    
    public function setPag($paginas) {$this->paginas = $paginas;}  
    public function getPag() {return $this->paginas;}
      
    public function setAutor($autor) {$this->autor = $autor;}
    public function getAutor() {return $this->autor;}



}
