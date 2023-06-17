<?php
session_start();
include('conexao.php');
 // vai vir o protect.php


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <center> <h1>Perfil de <?php echo $_SESSION['nome'] ?></h1>
  <?php
  $sql_usuario = "SELECT * FROM USUARIO WHERE id_usuario = $_SESSION[id_usuario]";
  $sql_query = $conn->prepare($sql_usuario);
  $sql_query ->execute();

  while ($row_usuario = $sql_query->fetch(PDO::FETCH_ASSOC)) {
    echo "<li style='list-style: none'>";
    echo "Nome: " . $row_usuario['nome'] . "<br>";
    echo "Email: " . $row_usuario['email'] . "<br>";
    echo "</li>";
  }
  
  
  ?>
  </center>
</body>
</html>