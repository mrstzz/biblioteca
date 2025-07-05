<?php


namespace App\Controller;
// require_once __DIR__ . '/../vendor/autoload.php';


use App\Model\Acervo;
use App\Model\AcervoDao;

// CRUD acervo

class AcervoController{


    public function criar($titulo, $autor, $paginas){
       
        $acervo = new Acervo();

        $acervo->setTitulo($titulo);
        $acervo->setAutor($autor);
        $acervo->setPag($paginas);
        $acervoD = new AcervoDao();
        $acervoD->create($acervo);
    }


    public function atualizar($titulo, $autor, $paginas, $id){
        $acervoAt = new Acervo();

        if ($_POST){

        if (isset($_GET['id']) && !empty($_GET['id'])) { 
            if ($id > 0){
                $acervoAt->setTitulo($titulo);
                $acervoAt->setAutor($autor);
                $acervoAt->setPag($paginas); 

                $acervoD = new AcervoDao();
                $acervoD->update($acervoAt); 

            }else{
                echo "<script>alert('ID inválido.');</script>";
                echo "<script>window.location='./index.php'</script>";
            }
        }
            echo "<script>Livro atualizado com sucesso!;</script>";
        }
    }
    
    
    public function excluir($id){
        
        if ($_POST) {
        if ($id > 0) {
            $acervoD = new AcervoDao();
            $acervo = new Acervo();
            $acervo->setId($id);
            $acervoD->delete($acervo); 
        } else {
            echo "<script>alert('ID inválido.');</script>";
        }
    }
    }
}