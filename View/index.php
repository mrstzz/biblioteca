<?php
session_start();


require_once __DIR__ . '/../vendor/autoload.php';
use App\Model\Conexao;
header('Content-Type: text/html; charset=UTF-8');


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
  <body >
    <nav class="navbar navbar-dark bg-dark">
	<div class="container-md ">

		<a class="navbar-brand" href="#">Biblioteca v2 <span class="bi bi-cup-hot-fill"></span>&nbsp;</a>
    
	</div>
    </nav>
    <div class="container mt-4 ">
      <?php include('mensagem.php'); ?>
      <div class="row ">
        <div class="col-md-12">
          <div class="card  ">
          <div class="card-header d-flex justify-content-between align-items-center bg">
              <h4 class="mb-0">Acervo</h4>
              <div class="d-flex gap-2">
                <a href="./criarLivro.php" class="btn btn-primary btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Adicionar Livro</a>
                <a href="./viewEmprestimo.php" class="btn btn-warning btn-sm"><span class="bi-arrow-left-right"></span>&nbsp;Visualizar Empréstimos</a>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Páginas</th>
                    <th>Autor</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    
                        // $acervo = new Acervo();
                        $sql = "SELECT * FROM acervo";
                        $stmt = Conexao::getConexao()->prepare($sql);
                    
                    // print_r($stmt);


                    //mostrar todo o acervo
                
                    if ($stmt->execute()) {
                        $acervos = $stmt->fetchAll();
                        foreach($acervos as $acervo){
                  ?>
                  <tr>
                    <td><?=$acervo['id']?></td>
                    <td><?=$acervo['titulo']?></td>
                    <td><?=$acervo['paginas']?></td>
                    <td><?=$acervo['autor']?></td>

                    <td>
                      <a href="viewAcervo.php?id=<?=$acervo['id']?>" name='viewAcervo' class="btn btn-secondary btn-sm"><span class="bi-eye-fill"></span>&nbsp;Visualizar</a>
                      <a href="editarLivro.php?id=<?=$acervo['id']?>" class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Atualizar</a>
                      <a href="emprestimo.php?idAcervo=<?=$acervo['id']?>" class="btn btn-primary btn-sm"><span class="bi-arrow-left-right"></span>&nbsp;Empréstimo</a>
                                            
                      <form action="excluirLivro.php" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                      <input type="hidden" name="id" value="<?= $acervo['id'] ?>">
                      <button type="submit" name="delete_acervo" class="btn btn-danger btn-sm">
                          <span class="bi-trash3-fill"></span>&nbsp;Excluir
                      </button>
                      </form>

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