<?php
session_start();
ob_start();
include('conexao.php');

$id_tarefa = $_GET['id_tarefa'];
$id_grupo = $_GET['id_grupo'];

if(empty($id_tarefa)) {
  $_SESSION['msg'] ="<p>Erro: tarefa não encontrada</p>";
  header("Location: principal.php");
  exit();
} 

$query_tarefa = "SELECT id_tarefa from tarefa WHERE id_tarefa=$id_tarefa LIMIT 1";
$result_tarefa = $conn->prepare($query_tarefa);
$result_tarefa->execute();

if(($result_tarefa) and ($result_tarefa->rowCount() != 0)) {
  $query_delete = "DELETE FROM tarefa WHERE id_tarefa = $id_tarefa";
 $result_delete = $conn->prepare($query_delete);
 $result_delete->execute();

 header('Location:principal.php');


} else {
  $_SESSION['msg'] ="<p>Erro: tarefa não encontrada</p>";
  header("Location: principal.php");
  exit();
}
  ?>