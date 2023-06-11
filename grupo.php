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
<body id="body-principal">
<?php
if (!empty($id_grupo)) {
$query_grupo ="SELECT id_grupo, nome_grupo, desc_grupo FROM grupo WHERE id_grupo=:id_grupo";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->bindParam(':id_grupo',$id_grupo);
$result_grupo->execute();

} else {
  $_SESSION['msg'] ="<p>Erro: grupo não encontrado</p>";
  header("Location: principal.php"); }

if (($result_grupo) and ($result_grupo->rowCount()!= 0)) {
  $row_grupo = $result_grupo->fetch(PDO::FETCH_ASSOC);
  extract($row_grupo);
  

$query_tarefa ="SELECT id_tarefa, nome_tarefa, desc_tarefa FROM tarefa
WHERE grupo_id=:grupo_id ORDER BY id_tarefa DESC LIMIT 1";
$result_tarefa = $conn->prepare($query_tarefa);
$result_tarefa->bindParam('grupo_id', $id_grupo);
$result_tarefa->execute();
echo 'Código do Prjeto: ' . $row_grupo['id_grupo']."<br>";
echo "Nome do Projeto: " . $nome_grupo . "<br>";
if (($result_tarefa) and ($result_tarefa->rowCount() != 0)) {
  while($row_tarefa = $result_tarefa->fetch(PDO::FETCH_ASSOC)) {
    extract($row_tarefa);
  //  var_dump($row_tarefa);
    
  echo "Menu de tarefas" . "<a href='tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo'>Visualizar</a>";
   

} 

} else {
  echo "Menu de tarefas" ."<a href='tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo'>Visualizar</a>";
} 

} else { 
  $_SESSION['msg'] ="<p>Erro: grupo não encontrado</p>";
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