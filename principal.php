<?php

session_start();


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
<body id="body-principal">
<header>
      <nav class="nav-bar">
          <div class="logo">
              <h1><ion-icon name="cafe-outline"></ion-icon>S.R.A</h1>
          </div>
          <div class="nav-list">
              <ul>
                  <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
                  <li class="nav-item"><a href="principal.php" class="nav-link">Grupos</a></li>
                  <li class="nav-item"><a href="#" class="nav-link"> Sobre</a></li>
              </ul>
          </div>
          <div class="login-button">
              <button><a href="logout.php">Sair</a></button>
          </div>

          <div class="mobile-menu-icon">
              <button onclick="menuShow()"><img class="icon" src="assets/img/menu_white_36dp.svg" alt=""></button>
          </div>
      </nav>
      <div class="mobile-menu">
          <ul>
              <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
              <li class="nav-item"><a href="principal.php" class="nav-link">Grupos</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Sobre</a></li>
          </ul>

          <div class="login-button">
              <button><a href="logout.php">Sair</a></button>
          </div>
      </div>
  </header>

  <script src="js/script.js"></script>
    <center>
    Bem vindo ao Painel, <?php echo $_SESSION['nome']; ?>.

    <div class="lista-principal" style="padding-top:100px;">
        <a href="criarGrupo.php">Criar um grupo</a> <br>
        <a href="entrarGrupo.php">Entrar em um grupo já criado</a> <br>
        <a href="tarefas.php">Menu de Tarefas</a>
        <a href="visualizar.php"></a>
    </div>
    </center>
   <footer>
   <?php

if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


if(!isset($_SESSION)) {
    session_start();
}
include('protect.php');
include('conexao.php');

$query_grupo ="SELECT id_grupo, nome_grupo, desc_grupo FROM grupo ORDER BY id_grupo DESC";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->execute();

while($row_grupo = $result_grupo->fetch(PDO::FETCH_ASSOC)) {
    extract($row_grupo);
  //  var_dump($row_grupo);
    echo "Grupo:" . $row_grupo['nome_grupo'] . "<br>";
    echo "Visualizar:" ."<a href='grupo.php?id_grupo=$id_grupo'>Visualizar</a> <br>";

}


?>
   </footer>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>