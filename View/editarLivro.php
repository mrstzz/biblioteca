<?php


require_once __DIR__ . '/../vendor/autoload.php';
header('Content-Type: text/html; charset=UTF-8');



use App\Controller\AcervoController;

?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acervo - Atualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Atualizar Livro
                <a href="index.php" class="btn btn-outline-warning float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <form action="" accept-charset="UTF-8" method="POST">
                <div class="mb-3">
                  <label>Titulo</label>
                  <input type="text" name="titulo" class="form-control" require>
                </div>
                <div class="mb-3">
                  <label>Autor</label>
                  <input type="text" name="autor" class="form-control" >
                </div>
                <div class="mb-3">
                  <label>Paginas</label>
                  <input type="number" name="paginas" class="form-control" >
                </div>

                <button type="submit" name="salvarEdit" class="btn btn-primary">Salvar</button>
              </form>

              <?php
              
                if (isset($_POST['salvarEdit'])) { 
                    
                    $titulo = $_POST['titulo'];
                    $autor = $_POST['autor'];
                    $paginas = $_POST['paginas'];

                    $controller = new AcervoController();
                    $id = $_GET['id']; 
                    $controller->atualizar($titulo, $autor, $paginas, $id);

                    echo "<script>Livro atualizado com sucesso!;</script>";
                    echo "<script>window.location='./index.php' </script>";




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
