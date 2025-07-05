<?php


namespace App\Model;
use PDO;
use PDOException;



class EmprestimoDao{


    public function createEmprest(Emprestimo $emprestimo) {

        // insere na tabela emprestimo as informações do novo emprestimo realizado

        try {
            $sql = "INSERT INTO emprestimo (idAcervo, dataInicio, dataFinal, statusE) 
                    VALUES (:idAcervo, :dataInicio, :dataFinal,:statusE)";
           
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindParam(':idAcervo', $emprestimo->getIdAcervo());
            $stmt->bindParam(':dataInicio', $emprestimo->getDataInicio(),\PDO::PARAM_STR);
            $stmt->bindParam(':dataFinal', $emprestimo->getDataFinal(),\PDO::PARAM_STR);
            $stmt->bindParam(':statusE', $emprestimo->getStatusE(),\PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                
                echo  "<script>alert('Empréstimo realizado com Sucesso!');</script>"; 
                echo "<script>window.location='./index.php' </script>";

            } else {
                echo  "<script>alert('erro ao  realizar empréstimo!');</script>";
                print_r($emprestimo);
                
            }
            
        } catch (\PDOException $erro) {
            echo "Erro de Conexão ou SQL" .$erro->getMessage();
        }
    }

      public function verificaStatus() {
        
        // verifica sempre que entrar na página se algum empréstimo está em atraso
        // se a data atual for maior q a data final do empréstimo, atualiza o status para "Em atraso"
        

        $sql = "UPDATE emprestimo SET statusE = 'Em atraso' WHERE CURRENT_DATE  > dataFinal
                AND statusE != 'Em atraso'
                AND statusE != 'Devolvido'";


        $stmt = Conexao::getConexao()->prepare($sql);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Você possui livros atrasados!');</script>";
            } else {
                echo "<script>alert('Nenhum empréstimo foi atualizado.');</script>";
            }
        } else {
            echo "<script>alert('Erro ao atualizar o status!');</script>";
            
        }
    }


    public function devolverEmprest(Emprestimo $emprestimo) {


        if (!empty($emprestimo->getId())) {

            // Atualizar o status do livro para 'devolvido'
            $sql = "UPDATE emprestimo SET statusE = 'Devolvido' WHERE id = :id";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(':id', $emprestimo->getId(), PDO::PARAM_INT);
            $stmt->execute();

            echo "<script>alert('Livro devolvido com sucesso.');</script>";
            echo "<script>window.location='./index.php' </script>";

        } else {
            echo "<script>alert('Empréstimo não encontrado ou livro não associado');</script>";
            echo "<script>window.location='./viewEmprestimo.php' </script>";


        }
    }


     
    
            
}

