<?php

date_default_timezone_set('America/Sao_Paulo');
 abstract class Conn
 {
     // LOCAL
     const host = 'localhost';
     const dbname = 'nomeDoBanco';
     const user = 'root';
     const password = '';
   
 
      static function conectar()
      {
            try
            {
                $pdo = new PDO("mysql:host=".self::host.";dbname=".self::dbname.";charset=utf8", self::user, self::password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
            }
      }


abstract class Comentario{
    static function InserirComentario($id)
    {
        try
        {
            //conexao
            $pdo = Conn::conectar();
        //verifica se existe o nome vindo do formulário pelo metodo post e a mensagem
        if (isset($_POST["nome"]) && isset($_POST["mensagem"])) {
             //declara uma variavel e prepara para fazer uma inserção no banco   
        $insert = $pdo->prepare("INSERT INTO comentario(nome,mensagem,data_comentario,id_produto,status) VALUES (:nome, :mensagem, NOW(),:id_produto,0)");
        $insert->bindValue(":nome", $_POST["nome"]);
        $insert->bindValue(":mensagem", $_POST["mensagem"]);
        $insert->bindValue(":id_produto", $id);
        $insert->execute();
        
        $insert = $insert->fetchAll(PDO::FETCH_OBJ);
        
        return $insert;
        }  
    } catch (PDOException $e){
        echo "ERROR: ".$e->getMessage();
    }
    }
   
    static function MostrarComentario($id)
      {
          try{
              //conexao
             $pdo = Conn::conectar();       
             //declara uma variavel e prepara para fazer uma consulta no banco            
            $q = $pdo->prepare("SELECT * FROM comentario  WHERE id_produto = :id_produto and status = 1 ORDER BY id DESC LIMIT 0,5 ");
            $q->bindValue(":id_produto", $id);
            $q->execute();

            $q = $q->fetchAll(PDO::FETCH_OBJ);
            return $q;
         }catch (PDOException $e){
            echo "ERROR: ".$e->getMessage();
       
    
          }  
       
} 

    }