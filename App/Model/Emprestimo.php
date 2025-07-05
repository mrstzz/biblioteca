<?php

namespace App\Model;

// setters e getters


class Emprestimo{
    public $dataInicio, $id, $dataFinal, $statusE, $idAcervo;
    

    public function setDataInicio($dataInicio) {$this->dataInicio= $dataInicio;}
    public function getDataInicio() {return $this->dataInicio;}

    public function setDataFinal($dataFinal) {$this->dataFinal= $dataFinal;}
    public function getDataFinal() {return $this->dataFinal;}
    
    public function setStatusE($statusE) {$this->statusE= $statusE;}
    public function getStatusE() {return $this->statusE;}

    public function setId($id) {$this->id= $id;}
    public function getId() {return $this->id;}

    public function setIdAcervo($idAcervo) {$this->idAcervo= $idAcervo;}
    public function getIdAcervo() {return $this->idAcervo;}

   







}