<?php

if (!isset($_SESSION)) {
  session_start();
}
ob_start();

include('conexao.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Painel</title>
</head>
<style>
  .GrupoTela {
    border: 1px solid #000;
    padding: 20px;
    width: 45%;
    background: white;
    box-shadow: 10px 20px grey;
    border-radius: 10px 20px 30px;
    margin: 60px auto;
    text-align: center;
  }

  .ButtonVoltar button {
    background: #c7c5c5;
    border-radius: 20px;
    width: 5%;
  }

  .ButtonVoltar button a {
    text-decoration: none;
    color: black;
    font-weight: 500;
    font-size: 1.1rem;
  }

  .ButtonTarefa button {
    width: 50%;
    padding: 15px;
    color: black;
    background-color: #c7c5c5;
    font-size: 15px;
    cursor: pointer;
    border-radius: 10px;
    margin: 0 auto;
  }

  .ButtonTarefa button a {
    text-decoration: none;
    color: black;
    font-weight: 500;
    font-size: 1.1rem;
  }
</style>

<body>
  <header>
    <nav class="nav-bar">
      <div class="logo">
        <h1>
          <ion-icon name="cafe-outline">

          </ion-icon>
          S.R.A
        </h1>
      </div>
      <div class="nav-list">
        <ul>
          <li class="nav-item">
            <a href="menu.html" class="nav-link">
              Início
            </a>
          </li>
          <li class="nav-item">
            <a href="principal.php" class="nav-link">
              Menu
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Sobre
            </a>
          </li>
        </ul>
      </div>
      <div class="login-button">
        <button>
          <a href="logout.php">
            Logout
          </a>
        </button>
      </div>
      <div class="mobile-menu-icon">
        <button onclick="menuShow()">
          <img class="icon" src="assets/img/menu_white_36dp.svg" alt="">
        </button>
      </div>
    </nav>
    <div class="mobile-menu">
      <ul>
        <li class="nav-item">
          <a href="menu.html" class="nav-link">
            Início
          </a>
        </li>
        <li class="nav-item">
          <a href="principal.php" class="nav-link">
            Grupos
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            Sobre
          </a>
        </li>
      </ul>
      <div class="login-button">
        <button>
          <a href="logout.php">
            Logout
          </a>
        </button>
      </div>
    </div>
  </header>
  <br><br><br><br><br><br><br><br><br><br>
  <div class="GrupoTela">
    <div class="ButtonVoltar">
      <button>
        <a href="principal.php">
          X
        </a>
      </button>
    </div>
    <h1>
      <p>
        <?php
        echo $nome_grupo;
        ?>
      </p>
    </h1>
    <br>
    <p>
      Código do projeto:
      <span style="color:limegreen">
        <?php
        echo $id_grupo;
        ?>
      </span>
      (use este codigo para convidar alguém para o seu projeto)
    </p>
    <br><br><br><br>
    <div class="ButtonTarefa">
      <button>
        <a href=<?php echo "tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo"; ?>>
          Menu de tarefas
        </a>
      </button>
      <br>
      <br>
      <button>
        <a href=<?php echo "criarRelatorio.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo"; ?>>
          Menu de Relatórios
        </a>
      </button>
      <br>
      <br>
      <?php if ($_SESSION['adm'] == 1) { ?>
      <button>
        <?php 
      
                echo '<a href="apagar_grupo.php?id_grupo=' . $id_grupo . '">Excluir</a>';
           
            ?>
            </button>
       <?php   } else {
                
              } ?>
    </div>
  </div>
  </center>
  <?php
  if (!empty($id_grupo)) {
    $query_grupo = "SELECT id_grupo, nome_grupo, desc_grupo FROM grupo WHERE id_grupo=:id_grupo";
    $result_grupo = $conn->prepare($query_grupo);
    $result_grupo->bindParam(':id_grupo', $id_grupo);
    $result_grupo->execute();
  } else {
    $_SESSION['msg'] = "<p>Erro: grupo não encontrado</p>";
    header("Location: principal.php");
  }
  if (($result_grupo) and ($result_grupo->rowCount() != 0)) {
    $row_grupo = $result_grupo->fetch(PDO::FETCH_ASSOC);
    extract($row_grupo);
    $query_tarefa = "SELECT id_tarefa, nome_tarefa, desc_tarefa FROM tarefa
    WHERE grupo_id=:grupo_id ORDER BY id_tarefa DESC LIMIT 1";
    $result_tarefa = $conn->prepare($query_tarefa);
    $result_tarefa->bindParam('grupo_id', $id_grupo);
    $result_tarefa->execute();
    //echo 'Código do Prjeto: ' . $row_grupo['id_grupo'] . "<br>";
    //echo "Nome do Projeto: " . $nome_grupo . "<br>";
    


    if (($result_tarefa) and ($result_tarefa->rowCount() != 0)) {
      while ($row_tarefa = $result_tarefa->fetch(PDO::FETCH_ASSOC)) {
        extract($row_tarefa);
        //  var_dump($row_tarefa);
        //echo "Menu de tarefas" . "<a href='tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo'>Visualizar</a>";
      }
    } else {
      //echo "Menu de tarefas" . "<a href='tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo'>Visualizar</a>";
    }
  } else {
    $_SESSION['msg'] = "<p>Erro: grupo não encontrado</p>";
    header("Location: principal.php");
  }
  ?>

  <script src="js/script.js"></script>

  <footer>

  </footer>

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>