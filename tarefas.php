<?php

session_start();
ob_start();
include('conexao.php');
include('protect.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];
$query_listar = "SELECT id_tarefa,nome_tarefa,desc_tarefa FROM tarefa";
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
      .lista_tarefa {
        margin-top: 10px;
        padding: 10px;
        margin: auto;
        width: 400px;
        height: 400px;
        overflow-y: scroll;
        display: inline-block;
      }
      .lista_tarefa li {
        padding: 5px;
        font-size: 18px;
        margin: auto;
        justify-content: center;
        display: inline-block;
      }
    .lista_tarefa ul {
       align-items: inherit;
       
      }

      .lista_tarefa a {
        font-size: 12px;
      }
      .botao{
        width: 50%;
border: none;
padding: 10px;
color: black;
background-color: white;
font-size: 15px;
cursor: pointer;
border-radius: 10px;
      }
      .butao:hover{
    background-color: whitesmoke;
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

  <div class="todo-container">
  <form action="novaTarefa.php?id_grupo=<?php echo $id_grupo?>&nome_grupo=<?php echo $nome_grupo  ?>" id="todo-form" method="post" >
      <center><h1> Projeto: <?php echo $nome_grupo?> </h1> 
       <span>Adicione sua tarefa</span> 
        <br><br>
    <div id="popup-form" style="display: none;"> 
      <!-- Campos do formulário -->
      <label for="nome">Nome:</label>
      <input name="nome_tarefa" type="text" id="todo-input" placeholder="O que você vai fazer?" required/><br>
                  Descrição:
                  <br>
      <textarea id="todo-input" name="desc_tarefa" placeholder="Descreva brevemente seu Projeto"rows=10 cols=35 maxlength="250" required> </textarea>
      <br>
        <span>Status da Tarefa:</span><br>
        <select name="status_tarefa" required>
          <br>
    <option value="">Selecione o status</option>
    <?php
    $query_status = "SELECT id_status, nome_status FROM tarefa_status";
    $result_status = mysqli_query($conexao, $query_status);
    while ($row_status = mysqli_fetch_assoc($result_status)) {
        echo "<option value='" . $row_status['id_status'] . "'>" . $row_status['nome_status'] . "</option>";
    }
    ?>
</select>
 <br>
<label for="colaborador">Responsável:</label>
<select name="colaborador" id="colaborador">
  <?php
    $query_colaboradores = "SELECT id_usuario, nome FROM usuario WHERE id_usuario IN (SELECT usuario_id FROM colaborador_grupo WHERE grupo_id = :grupo_id)";
    $result_colaboradores = $conn->prepare($query_colaboradores);
    $result_colaboradores->bindParam('grupo_id', $id_grupo);
    $result_colaboradores->execute();

    while($row_colaborador = $result_colaboradores->fetch(PDO::FETCH_ASSOC)) {
      $colaboradorId = $row_colaborador['id_usuario'];
      $colaboradorNome = $row_colaborador['nome'];

      echo "<option value=\"$colaboradorId\">$colaboradorNome</option>";
    }
  ?>
</select>
    

      <button class="botao" id="close-button" type="button">Fechar</button> 
       <button class="botao" type="submit" name="enviar" value="cadastrar">Adicionar</button>
    </div>

    <div class="form-control">
      <button name="enviar" type="button" onclick="openPopup()">
        <i class="fa-thin fa-plus"></i>
      </button>
    </div>
  </form>
  </center>
  <br>
  <div class="lista_tarefa">
    <ul style="list-style: none;">
      <!-- Loop das tarefas -->
      <?php
        $query_tarefa = "SELECT id_tarefa, nome_tarefa, desc_tarefa, status_tarefa FROM tarefa WHERE grupo_id=:grupo_id ORDER BY id_tarefa DESC";
        $result_tarefa = $conn->prepare($query_tarefa);
        $result_tarefa->bindParam('grupo_id', $id_grupo);
        $result_tarefa->execute();

        if (($result_tarefa) and ($result_tarefa->rowCount() != 0)) {
          while($row_tarefa = $result_tarefa->fetch(PDO::FETCH_ASSOC)) {
            extract($row_tarefa);

           $status_tarefa = $row_tarefa['status_tarefa'];

            echo "<li>Tarefa: " . $row_tarefa['nome_tarefa'] . "</li>";
            echo "<li>Descrição: " . $row_tarefa['desc_tarefa'] . "</li>";
             echo $status_tarefa = $row_tarefa['status_tarefa'];
            // Botão de excluir tarefas
            echo "<li><a href='apagar_tarefa.php?id_tarefa=$id_tarefa&id_grupo=$id_grupo&nome_grupo=$nome_grupo'>Apagar</a></li>";
          }
        } else {
          // Nenhuma tarefa encontrada
        }
      ?>
    </ul>
  </div>

 <script>
  function openPopup() {
    var popup = document.getElementById("popup-form");
    popup.style.display = "block";
  }

  function closePopup() {
    var popup = document.getElementById("popup-form");
    popup.style.display = "none";
  }

  document.getElementById("close-button").addEventListener("click", closePopup);

</script>
</div>




    
  </body>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>




    
  </body>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>