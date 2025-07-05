<?php


// mostrar livro que você clicou em "visualizar

require_once __DIR__ . '/../vendor/autoload.php';
header('Content-Type: text/html; charset=UTF-8');

use App\Model\Conexao;


?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acervo - Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Visualizar livro
                <a href="index.php" class="btn btn-outline-warning float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
                <?php
               
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = $_GET['id'];  
                    
                    
                    $sql = "SELECT * FROM acervo WHERE id = :id";
                    $stmt = Conexao::getConexao()->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);  
                    
                    if ($stmt->execute()) {
                        $resultado = $stmt->fetchAll();
                        if (count($resultado) > 0) {
                            foreach ($resultado as $valor) {
                ?>
                <div class="mb-3">
                  <label>Título</label>
                  <style>#keyword[disabled="true"]:hover {cursor: not-allowed;}</style>
                  <p class="form-control " disabled="true"  id="keyword" >
                    <?=$valor['titulo'];?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Páginas</label>
                  <p class="form-control" disabled="true"  id="keyword" >
                    <?=$valor['paginas'];?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Autor</label>
                  <p class="form-control"disabled="true"  id="keyword" >
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
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
