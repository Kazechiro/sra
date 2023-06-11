<?php

session_start();
ob_start();
include('conexao.php');
include('protect.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];

$query_listar = "SELECT id_tarefa, nome_tarefa, desc_tarefa FROM tarefa";
$listar = $conn->query($query_listar);
$dado = $listar->fetchAll(PDO::FETCH_ASSOC);


$query_colaboradores = "SELECT c.id_usuario, c.nome FROM usuario AS c
                       INNER JOIN colaborador_grupo AS cg ON c.id_usuario = cg.usuario_id
                       WHERE cg.grupo_id = $id_grupo";
$result_colaboradores = mysqli_query($conexao, $query_colaboradores);

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
        display: inline-block;
      }
   
    .lista_tarefa ul {
       align-items: inherit;
       
      }

      
      .lista_tarefa a {
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
  <form action="novaTarefa.php?id_grupo=<?php echo $id_grupo?>&nome_grupo=<?php echo $nome_grupo?>" id="todo-form" method="post" >
      <center><h2> Projeto: <?php echo $nome_grupo?> </h2> 
       <span>Adicione sua tarefa</span> 
        <br><br>
    <div id="popup-form" style="display: none;">  
      <!-- Campos do formulário -->
      
      <label for="nome">Nome:</label>
      <input name="nome_tarefa" type="text" id="todo-input" placeholder="O que você vai fazer?" required/><br>
                  Descrição:
                  <br>
      <textarea id="todo-input" name="desc_tarefa" placeholder="Descreva brevemente seu Projeto" rows=10 cols=35 maxlength="250" required> </textarea>
      <br>
        
                  <br>
      
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
 <br>
 <!-- NÃO SEI PQ NÃO FUNCIONA  -->
 <span>Responsável:</span>
 <br>
 <select name="colaborador_id" required>
          <option value="">Selecione um colaborador</option>
          <?php
          while ($row_colaborador = mysqli_fetch_assoc($result_colaboradores)) {
            echo "<option value='" . $row_colaborador['id_usuario'] . "'>" . $row_colaborador['nome'] . "</option>";
          }
          ?>
        </select>
      <button class="botao" id="close-button" type="button">Fechar</button> 
      
      <button type="submit">Adicionar Tarefa</button>
    </div>

   

    <div class="form-control">
      <button name="enviar" type="button" onclick="openPopup()">
        <i class="fa-thin fa-plus"></i>
      </button>
    </div>
  </form>
  </center>
  <br>
  </center>
  <br>
  <div class="lista_tarefa">
    <ul style="list-style: none;">
      <!-- Loop das tarefas -->
      <?php
$sql_tarefa = "SELECT t.id_tarefa, t.nome_tarefa, t.desc_tarefa, ts.nome_status, u.nome AS nome_colaborador
FROM tarefa t
INNER JOIN tarefa_status ts ON t.status_tarefa = ts.id_status
INNER JOIN usuario u ON t.colaborador_id = u.id_usuario
WHERE t.grupo_id = :grupo_id";

$stmt_tarefa = $conn->prepare($sql_tarefa);
$stmt_tarefa->bindParam(':grupo_id', $id_grupo);
$stmt_tarefa->execute();

while ($row_tarefa = $stmt_tarefa->fetch(PDO::FETCH_ASSOC)) {
echo "<li>";
echo "<span>Tarefa: " . $row_tarefa['nome_tarefa'] . "</span><br>";
echo "<span>Descrição: " . $row_tarefa['desc_tarefa'] . "</span><br>";
echo "<span>Status: " . $row_tarefa['nome_status'] . "</span><br>";
echo "<span>Responsável: " . $row_tarefa['nome_colaborador'] . "</span><br>";
echo "<button type='button' class='botao'><a href='editar_tarefa.php?id_tarefa=" . $row_tarefa['id_tarefa'] . "&id_grupo=$id_grupo&nome_grupo=$nome_grupo'>Editar</a></button>";
echo "<button type='button' class='botao'><a href='apagar_tarefa.php?id_tarefa=" . $row_tarefa['id_tarefa'] . "&id_grupo=$id_grupo&nome_grupo=$nome_grupo'>Apagar</a></button><br>";
echo "</li>";
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
