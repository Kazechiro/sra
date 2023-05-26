<?php
include('conexao.php');

$tarefa_nome = isset($_POST['nome'])? $_POST['nome'] : '';
$desc_tarefa = isset($_POST['desc'])? $_POST['desc'] : '';



$incluir = "INSERT INTO tarefa(nome_tarefa, desc_tarefa, concluida) 
VALUES ('$tarefa_nome', '$desc_tarefa', 0)";
$query_incluir = mysqli_query($conexao, $incluir);

header("location: tarefas.php");



?>

