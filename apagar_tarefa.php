<?php

include('conexao.php');


$query_listar = "SELECT id_tarefa,nome_tarefa,desc_tarefa,concluida FROM tarefa";
$listar = mysqli_query($conexao,$query_listar);
$dado = mysqli_fetch_all($listar);


$delete = "DELETE FROM tarefa WHERE id_tarefa = '$dado[0]'";
  $query = mysqli_query($conexao, $delete);
  
  header ('Location: tarefas.php');


  ?>