<?php
session_start();


// Mostra todos os seus empréstimos e o status dele (Devolvido, No prazo, Em atraso)

require_once __DIR__ . '/../vendor/autoload.php';
use App\Model\Conexao;
use App\Controller\EmprestimoController;
use App\Model\EmprestimoDao;

header('Content-Type: text/html; charset=UTF-8');


if (isset($_POST)) {

    $controller = new EmprestimoDao();   
    $controller->verificaStatus();
  
} else {
    echo "<script>alert('Erro .');</script>";
}




?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
	<div class="container-md">

		<a class="navbar-brand" href="#">Biblioteca v2 <span class="bi bi-cup-hot-fill"></span>&nbsp;</a>
    
	</div>
    </nav>
    <div class="container mt-4">
      <?php include('mensagem.php'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h4 class="mb-0">Lista de Empréstimos</h4>
              <div class="d-flex gap-2">
                <a href="index.php" class="btn btn-outline-warning   float-end">Voltar</a>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID </th>
                    <th>Livro</th>
                    <!-- <th>Livro</th> -->
                    <th>Data Inicio</th>
                    <th>data Final</th>
                    <th>Status</th>
                    <th>Ação</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php

                    
                        // $emprestimo = new emprestimo();
                        $sql = "SELECT 
                                      e.id, 
                                      e.idAcervo,
                                      a.titulo,
                                      e.dataInicio,
                                      e.dataFinal,
                                      e.statusE
                                  FROM 
                                      emprestimo e
                                  JOIN acervo a ON e.idAcervo = a.id";
                        $stmt = Conexao::getConexao()->prepare($sql);

                        
                    // print_r($emprestimos);
                
                    if ($stmt->execute()) {
                        $emprestimos = $stmt->fetchAll();
                        foreach($emprestimos as $emprestimo){
                          
                  ?>
                  <tr>
                    <td><?=$emprestimo['id']?></td>
                    <td><?=$emprestimo['titulo']?></td>
                    <td><?=$emprestimo['dataInicio']?></td>
                    <td><?=$emprestimo['dataFinal']?></td>
                    <td><?=$emprestimo['statusE']?></td>
                    
                    <td>
                      <?php if ($emprestimo['statusE'] != 'Devolvido') {
                        ?>
                        <form action="devolverLivro.php" method="POST" class="d-inline" onsubmit="return confirm('Confirmar devolução?')">
                        <input type="hidden" name="id" value="<?= $emprestimo['id'] ?>">
                        <button type="submit" name="devolver_emprestimo" class="btn btn-primary btn-sm">
                        <span class="bi bi-arrow-left-circle"></span>&nbsp;Devolver
                        </button>
                        </form>
                       
                     <?php }else{
                        ?>
                     <?php } ?>
                    </td>
                    
                  </tr>
                  <?php
                }
                 } else {
                   echo '<h5>Nenhum usuário encontrado</h5>';
                 }
                 ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>