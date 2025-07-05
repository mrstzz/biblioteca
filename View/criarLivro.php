<?php

require_once __DIR__ . '/../vendor/autoload.php';
header('Content-Type: text/html; charset=UTF-8');
use App\Controller\AcervoController;

?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acervo - Criar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navbar.php');
  
    ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Adicionar Livro
                <a href="index.php" class="btn btn-outline-warning float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <form action=""accept-charset="UTF-8" method="POST">
                <div class="mb-3">
                  <label>Título</label>
                  <input type="text" name="titulo" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label>Autor</label>
                  <input type="text" name="autor" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label>Páginas</label>
                  <input type="number" name="paginas" class="form-control" required>
                </div>
                <div class="mb-3">
                  <button type="submit" name="criarL" class="btn btn-primary">Salvar</button>
                  <?php  if (isset($_POST['criarL'])) { 
                        $titulo = $_POST['titulo'] ?? '';
                        $autor = $_POST['autor'] ?? '';
                        $paginas = $_POST['paginas'] ?? 0;
                        $controller = new AcervoController(); 
                        $controller->criar($titulo, $autor, $paginas);
                      }
                  
                    ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
