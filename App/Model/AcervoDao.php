<?php


namespace App\Model;
use PDO;
use PDOException;
class AcervoDao{

    public function create(Acervo $acervo){

        // insere na tabela acervo as informações do novo livro criado'
    
        try{
            $sql = "INSERT INTO acervo (titulo, paginas , autor) VALUES (:titulo, :paginas, :autor)";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindParam(':titulo', $acervo->getTitulo(),\PDO::PARAM_STR);
            $stmt->bindParam(':paginas', $acervo->getPag(),\PDO::PARAM_INT);
            $stmt->bindParam(':autor', $acervo->getAutor(),\PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                
                echo  "<script>alert('Livro enviado com Sucesso!');</script>"; 
                echo "<script>window.location='./index.php' </script>";

            } else {
                echo  "<script>alert('erro ao enviar livro!');</script>";
                
            }
        }catch (\PDOException $erro){
            echo "Erro de conexão ou de sql: " . $erro;
        }
    }

    
    public function read(Acervo $acervo){
        // caso precise'

        try {
            
            if (!empty($acervo->getTitulo()) || !empty($acervo->getAutor())) {
                $sql = "SELECT * FROM acervo WHERE titulo = ? OR autor = ?";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt->bindParam(':titulo', $acervo->getTitulo(),\PDO::PARAM_STR);
                $stmt->bindParam(':autor', $acervo->getAutor(),\PDO::PARAM_STR);
            } else {
                $sql = "SELECT * FROM acervo";
                $stmt = Conexao::getConexao()->prepare($sql);
            }
            // print_r($stmt);
        
            if ($stmt->execute()) {
                $resultado = $stmt->fetchAll();
                
                echo "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
                echo "<tr><th>ID</th><th>Titulo</th><th>Paginas</th><th>Autor</th></tr>"; 
        
                foreach ($resultado as $valor) {
                    echo "<tr>";
                    echo "<td>" . $valor["id"] . "</td>";
                    echo "<td>" . $valor["titulo"] . "</td>";
                    echo "<td>" . $valor["paginas"] . "</td>";
                    echo "<td>" . $valor["autor"] . "</td>";
                    echo "</tr>";
                }
        
                echo "</table>";
            } else {
                echo "Nenhum resultado encontrado.";
            }
        } catch (\PDOException $erro) {
            echo "Erro de conexão ou de SQL: " . $erro->getMessage();
        }
        
    }


    

   public function update(Acervo $acervo) {
    //  atualizar informações do livro de acordo com o que for informado.
    //  se o usuario não informar alguma informação o mesmo campo não será atualizado 
    //  e  manterá o valor padrão ao qual foi atribuido anteriormente


        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<script>alert('ID inválido.');</script>";
            return;
        }

        $id = $_GET['id'];
        $campos = [];
        $respostas = [];

    
        if (!empty($acervo->getTitulo())) {
            $campos[] = "titulo = :titulo";
            $respostas[':titulo'] = $acervo->getTitulo();
        }

        if (!empty($acervo->getPag())) {
            $campos[] = "paginas = :paginas";
            $respostas[':paginas'] = $acervo->getPag();
        }

        if (!empty($acervo->getAutor())) {
            $campos[] = "autor = :autor";
            $respostas[':autor'] = $acervo->getAutor();
        }

        if (empty($campos)) {
            echo "<script>alert('Nenhum campo para atualizar.');</script>";
            return;
        }

        $sql = "UPDATE acervo SET " . implode(", ", $campos) . " WHERE id = :id";
        $stmt = Conexao::getConexao()->prepare($sql);

        // Associa os parâmetros dinâmicos
        foreach ($respostas as $selecionados => $valor) {
            if ($selecionados === ':paginas') {
                $stmt->bindValue($selecionados, $valor, \PDO::PARAM_INT);
            } else {
                $stmt->bindValue($selecionados, $valor, \PDO::PARAM_STR);
            }
        }

        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>alert('Livro atualizado com sucesso!');</script>";
            echo "<script>window.location='./index.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar o livro!');</script>";
        }
    }



    public function delete(Acervo $acervo) {
        // exclui livro da tabela de acordo com id

        $sql = "DELETE FROM acervo WHERE id = :id";
        $stmt = Conexao::getConexao()->prepare($sql);

        $stmt->bindParam(':id', $acervo->getId(), PDO::PARAM_INT);  

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Livro apagado com sucesso!');</script>";
                echo "<script>window.location='./index.php' </script>";

            } else {
                echo "<script>alert('Erro ao apagar o livro!');</script>";
            }
        } else {
            echo "Erro de conexão ou de SQL.";
        }
    }


}
