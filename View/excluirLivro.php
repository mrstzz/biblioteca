<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Controller\AcervoController;

if (isset($_POST['delete_acervo']) && isset($_POST['id'])) {
    $controller = new AcervoController();   
    $id = (int) $_POST['id']; 
    $controller->excluir($id);
} else {
    echo "<script>alert('Erro ao excluir. ID não informado.');</script>";
}

    
    ?>