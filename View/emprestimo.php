<?php


require_once __DIR__ . '/../vendor/autoload.php';
header('Content-Type: text/html; charset=UTF-8');


use App\Controller\EmprestimoController;

use App\Model\Conexao;



$sql = "SELECT COUNT(*) as total FROM emprestimo WHERE statusE = 'Em atraso'";
$stmt = Conexao::getConexao()->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result && $result['total'] > 0) {
    echo "<script>alert('Existe empréstimo em atraso!');</script>";
    echo "<script>window.location.href = 'viewEmprestimo.php';</script>";
    exit(); 
}




?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acervo - Empréstimo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Solicitar Empréstimo
                <a href="index.php" class="btn btn-outline-warning float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
                <?php

            
                
                if (isset($_GET['idAcervo']) && !empty($_GET['idAcervo'])) {
                    $id = $_GET['idAcervo'];

                    // Verifica se o livro já está emprestado
                  $sqlVerifica = "SELECT * FROM emprestimo WHERE idAcervo = :idAcervo AND statusE != 'Devolvido'";
                  $stmtVerifica = Conexao::getConexao()->prepare($sqlVerifica);
                  $stmtVerifica->bindParam(':idAcervo', $id, PDO::PARAM_INT);
                  $stmtVerifica->execute();
                  $emprestimoExistente = $stmtVerifica->fetch(PDO::FETCH_ASSOC);

                  if ($emprestimoExistente) {
                      echo "<script>alert('Este livro já está emprestado. Aguarde a devolução.');</script>";
                      echo "<script>window.location.href = 'viewEmprestimo.php';</script>";
                      exit();
                      }
  
                    
                    
                    // select só pra mostrar o livro o qual você deseja pedir emprestado
                    $sql = "SELECT * FROM acervo WHERE id = :id";
                    $stmt = Conexao::getConexao()->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);  
                    
                    if ($stmt->execute()) {
                        $resultado = $stmt->fetchAll();
                        if (count($resultado) > 0) {
                            foreach ($resultado as $valor) {
                              
                ?>
                <div class="mb-3 ">
                  <label>Título</label>
                  <style>#keyword[disabled="true"]:hover {cursor: not-allowed;}</style>
                  <p class="form-control " disabled="true"  id="keyword"  >
                    <?=$valor['titulo'];?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Páginas</label>
                  <p class="form-control" disabled="true"  id="keyword"  >
                    <?=$valor['paginas'];?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Autor</label>
                  <p class="form-control" disabled="true"  id="keyword" >
                    <?=$valor['autor'];?>
                  </p>
                </div>
                <?php
                            }
                        } else {
                            echo "<h5>Livro não encontrado</h5>";
                        }
                    } else {
                        echo "<h5>Erro ao executar a consulta</h5>";
                    }
                } else {
                    echo "<h5>ID não especificado</h5>";
                }
                ?>
              <form action="" accept-charset="UTF-8" method="POST">
                <div class="mb-3">
                    <?php $dataInicio = date("d/m/Y");?>
                  <label>Data início</label>
                  <p class="form-control" disabled="true"  id="keyword"  ><?=$dataInicio?></p>
                </div>
                <div class="mb-3">
                    <?php   
                         $dataFinal = date('d/m/Y', strtotime("+3 days"));
                    ?>
                  <label>Data Final</label>
                  <p class="form-control" disabled="true"  id="keyword"  ><?=$dataFinal?></p>
                </div>
                <button type="submit" name="salvarEmprestimo" class="btn btn-primary">Salvar</button>
              </form>

              <?php

                // pega as informações de data atual/final e armazena dentro de uma função
              
               if (isset($_POST['salvarEmprestimo'])) { 
                  $idAcervo = $_GET['idAcervo'];

                  

                  
                  $dataInicio = date("Y-m-d"); 
                  $timestampInicio = strtotime($dataInicio);

                  
                  $timestampFinal = strtotime("+3 days", $timestampInicio);
                  $dataFinal = date("Y-m-d", $timestampFinal);

                  $statusE = 'No prazo';

                  
                  $controller = new EmprestimoController();
                  $controller->criarEmprestimo($dataInicio, $dataFinal, $idAcervo, $statusE);

                    // print_r($controller);
                    


                }else{
                    // print_r($controller);
                }
                ?>
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
