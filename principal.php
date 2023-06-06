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
<style>
    .grupos{
    border: 1px solid #000;
    padding: 10px;
    width: 12%;
    background: white;
    border-radius: 10px 20px 30px;
    }
   
</style>
<body>
<header>
      <nav class="nav-bar">
          <div class="logo">
              <h1><ion-icon name="cafe-outline"></ion-icon>S.R.A</h1>
          </div>
          <div class="nav-list">
              <ul>
                  <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
                  <li class="nav-item"><a href="principal.php" class="nav-link">Menu</a></li>
                  <li class="nav-item"><a href="#" class="nav-link"> Sobre</a></li>
              </ul>
          </div>
          <div class="login-button">
              <button><a href="logout.php">Logout</a></button>
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
  <br><br>
  <br><br>
  <br><br>
  <br><br>
<center>
        <div class="boxtags">
        
    
   <legend> Bem vindo ao SRA, <?php echo $_SESSION['nome']; ?>. </legend>
<br>
        
        <a href="criarGrupo.php"> <button class="butao">Criar Projeto</button> </a> <br>
        <a href="entrarGrupo.php"> <button class="butao">Entrar em um Projeto</button></a> <br>
        
        
    
    
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

$query_grupo ="SELECT id_grupo, nome_grupo, desc_grupo FROM grupo WHERE usuario_id = $_SESSION[id_usuario] ORDER BY id_grupo DESC";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->execute();

while($row_grupo = $result_grupo->fetch(PDO::FETCH_ASSOC)) {
    extract($row_grupo);
  //  var_dump($row_grupo);
    echo '<div class="grupos">' ."Grupo:" . $row_grupo['nome_grupo'] .  
    " <a href='grupo.php?id_grupo=$id_grupo'>Visualizar</a>" .'</div>' . 
    "<a href='apagar_grupo.php?id_grupo=$id_grupo'>[Apagar]</a>";
   

}


?>
   </footer>

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>