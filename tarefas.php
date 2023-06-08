<?php

session_start();
ob_start();
include('conexao.php');
include('protect.php');

$id_grupo = $_GET['id_grupo'];
$query_listar = "SELECT id_tarefa,nome_tarefa,desc_tarefa,concluida FROM tarefa";
$listar = mysqli_query($conexao,$query_listar);
$dado = mysqli_fetch_all($listar);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Tarefas</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
      integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <style>
      * {
        padding: 0;
        margin: 0;
      }
      div.lista_tarefa {
        margin-top: 10px;
        padding: 10px;
        margin: auto;
        width: 400px;
      }
      div.lista_tarefa li {
        padding: 5px;
        font-size: 18px;
        margin: auto;
        justify-content: center;
        
      }
      div.lista_tarefa ul {
       align-items: inherit;
       
      }

      div.lista_tarefa a {
        font-size: 12px;
      }
    </style>
  </head>
  <body class="body-tarefa">
    <header>
      <nav class="nav-bar">
          <div class="logo">
              <h1><ion-icon name="cafe-outline"></ion-icon>S.R.A</h1>
          </div>
          <div class="nav-list">
              <ul>
                  <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
                  <li class="nav-item"><a href="principal.php" class="nav-link">Projetos</a></li>
                  <li class="nav-item"><a href="#" class="nav-link"> Sobre</a></li>
              </ul>
          </div>
          <div class="login-button">
              <button><a href="index.php">Entrar</a></button>
          </div>

          <div class="mobile-menu-icon">
              <button onclick="menuShow()"><img class="icon" src="assets/img/menu_white_36dp.svg" alt=""></button>
          </div>
      </nav>
      <div class="mobile-menu">
          <ul>
              <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
              <li class="nav-item"><a href="principal.php" class="nav-link">Projetos</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Sobre</a></li>
          </ul>

          <div class="login-button">
              <button><a href="#">Entrar</a></button>
          </div>
      </div>
  </header>

  <script src="js/script.js"></script>

    <div class="todo-container">
 
      <form action="novaTarefa.php?id_grupo=<?php echo $id_grupo?>" id="todo-form" method="post" >
      <legend> Grupo: <?php ?> </legend>
        <h1>Adicione sua tarefa</h1>
        <div class="form-control">

          <label for="nome">nome:</label>
          <input name="nome" type="text" id="todo-input" placeholder="O que você vai fazer?"/>
          
          <label for="desc">descrição:</label>
          <input name="desc_tarefa" type="text" id="todo-input" placeholder="Descrição"/>
        
          <button type="submit" name="enviar" value="cadastrar">
            <i class="fa-thin fa-plus"></i>
          </button>
        </div>
      </form>
      <div class="lista_tarefa">
      <ul style="list-style: none;">
      <?php
$query_tarefa ="SELECT id_tarefa, nome_tarefa, desc_tarefa FROM tarefa
WHERE grupo_id=:grupo_id ORDER BY id_tarefa DESC";
$result_tarefa = $conn->prepare($query_tarefa);
$result_tarefa->bindParam('grupo_id', $id_grupo);
$result_tarefa->execute();

if (($result_tarefa) and ($result_tarefa->rowCount() != 0)) {
  while($row_tarefa = $result_tarefa->fetch(PDO::FETCH_ASSOC)) {
    extract($row_tarefa);
  //  var_dump($row_tarefa);
          "id_tarefa". $row_tarefa['id_tarefa'];
    echo "Tarefa:" . $row_tarefa['nome_tarefa'] . "<br>";
    echo "Descrição:" . $row_tarefa['desc_tarefa'] . "<br>";
    // eu estava aqui fazendo o botão de excluir tarefas, não sei se vai dar certo
    echo "<a href='apagar_tarefa.php?id_tarefa=$id_tarefa'>Apagar</a><br>";

} 

} else {
  
} 

            ?>
       
      </ul>
      </div>
    
  </body>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>