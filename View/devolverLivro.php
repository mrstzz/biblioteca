<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Controller\EmprestimoController;


if (isset($_POST['devolver_emprestimo'])&& isset($_POST['id'])) {
    $id = $_POST['id']; 

    $controller = new EmprestimoController();   
    $controller->DevolverLivro($id);
  
} else {
    echo "<script>alert('Erro ao devolver livro. ID não informado.');</script>";
}
    
    ?>