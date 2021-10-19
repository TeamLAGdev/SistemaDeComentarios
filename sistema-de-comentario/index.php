<?php
require_once './assets/Conn.assets.php';
$comentario = Comentario::MostrarComentario($_GET['id']);
if(isset($_POST['nome'])) {
  $inserir = Comentario::InserirComentario($_GET['id'],$_POST['nome'],$_POST['mensagem']);
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Comentário</title>
</head>
<body>
    <div class="container">

 
<div class="comentario" style="margin-top: 10px;">
      <h3 style="color: white;">Faça seu comentário:</h3>
      <fieldset>
        <form class="barracomen" method="POST" action="produto.php?id=<?php echo $_GET['id']?>">
          <h4 style="color: white;">Nome:</h4><br />
          <input type="text" name="nome" required /><br /><br />

          <h4 style="color: white;">Mensagem:</h4><br />
          <textarea name="mensagem" required></textarea><br /><br />

          <input class="btn btn-primary btn-lg" type="submit" value="Enviar Mensagem" />
        </form>
      </fieldset>
      <br /><br />
      <h3 id="texto"style="color: white;">Comentários:</h3>
      <?php
      if ($comentario == null) {
        echo '<h3>Nenhum comentário</h3>';
      } else {


        foreach ($comentario as $a) {

      ?>
          <div class="comentariofeitos">
            <div class="mensagens">
              <div class="mensagem">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" style="color: white;">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
                <p class="user" style="display:inline;color: white;"><?php echo $a->nome; ?></p>
                <p style="display:inline;color: white;"><?php echo $a->data_comentario; ?></p>

              </div style="color: white;">
             <p style="color: white;"> <?php echo $a->mensagem; ?></p>
            </div>

          </div>
      <?php }
      }

      ?>
   </div>
 </div>
 </div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</html>