<?php
session_start();
include('conexao.php');
$id_grupo = $_GET['id_grupo'];


$query_grupo = "SELECT id_grupo from grupo WHERE id_grupo=$id_grupo LIMIT 1";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->execute();

if(($result_grupo) and ($result_grupo->rowCount() != 0)) {
  $query_delete = "DELETE FROM grupo WHERE id_grupo = $id_grupo";
 $result_delete = $conn->prepare($query_delete);
 $result_delete->execute();

 header('Location:principal.php');


} else {
  $_SESSION['msg'] ="<p>Erro: grupo não encontrado</p>";
  header("Location: principal.php");
  exit();
}


?>