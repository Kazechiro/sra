<?php
if(!isset($_SESSION)) {
    session_start();
}
include('protect.php');

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
              <button><a href="index.php">Entrar</a></button>
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
              <button><a href="#">Entrar</a></button>
          </div>
      </div>
  </header>
  <script src="js/script.js"></script>
    <center>
    Bem vindo ao Painel, <?php echo $_SESSION['nome']; ?>.

    <div class="lista-principal" style="padding-top:100px;">
        <a href="criarGrupo.php">Criar um grupo</a> <br>
        <a href="entrarGrupo.php">Entrar em um grupo já criado</a> <br>
        <a href="logout.php">Sair</a> <br>
        <a href="tarefas.php">Menu de Tarefas</a>
    </div>
    </center>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>