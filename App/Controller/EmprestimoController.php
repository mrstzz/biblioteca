<?php

namespace App\Controller;

use App\Model\Emprestimo;
use App\Model\EmprestimoDao;

// criar / devolver 

class EmprestimoController{


    public function criarEmprestimo($dataInicio, $dataFinal, $idAcervo, $statusE){
        $emprestimo = new Emprestimo();
        
        $emprestimo->setIdAcervo($idAcervo);
        $emprestimo->setStatusE($statusE);
        $emprestimo->setDataInicio($dataInicio);
        $emprestimo->setDataFinal($dataFinal);
        // $emprestimo->setStatusE($statusE);

        $emprestimoD = new EmprestimoDao();
        $emprestimoD->createEmprest($emprestimo);
    }


    public function DevolverLivro($id){

        if ($_POST) {
            if ($id > 0) {
                $emprestimo = new Emprestimo();
                $emprestimoD = new EmprestimoDao(); 
                
                $emprestimo->setId($id);
                $emprestimoD->devolverEmprest($emprestimo);
               

            } else {
                echo "<script>alert('ID inválido.');</script>";

            }
        }
    }



}





