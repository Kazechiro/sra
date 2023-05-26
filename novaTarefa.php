<?php
include('conexao.php');

$tarefa_nome = isset($_POST['nome'])? $_POST['nome'] : '';
$desc_tarefa = isset($_POST['desc'])? $_POST['desc'] : '';


 
$verificar_tarefa ="SELECT nome_tarefa FROM tarefa WHERE nome_tarefa  = '$tarefa_nome"; 
$query_verificar = mysqli_query($conexao, $verificar_tarefa);
$dado = mysqli_fetch_row($query_verificar);

if ($dado[0] != $tarefa_nome) { 

$incluir = "INSERT INTO tarefa(nome_tarefa, desc_tarefa, concluida) 
VALUES ('$tarefa_nome', '$desc_tarefa', 0)";
$query_incluir = mysqli_query($conexao, $incluir);

header("location: tarefas.php");
} else {
  echo "Tarefa já cadastrada";
}


?>

