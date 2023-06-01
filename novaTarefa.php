<?php
if(!isset($_SESSION)) {
  session_start();
}

include('conexao.php');
$id_grupo = filter_input(INPUT_GET, 'id_grupo', FILTER_SANITIZE_NUMBER_INT);
$tarefa_nome = isset($_POST['nome'])? $_POST['nome'] : '';
$desc_tarefa = isset($_POST['desc'])? $_POST['desc'] : '';

$query_grupo ="SELECT id_grupo, nome_grupo, desc_grupo FROM grupo";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->execute();


$incluir = "INSERT INTO tarefa(nome_tarefa, desc_tarefa, concluida, usuario_id,id_grupo) 
VALUES ('$tarefa_nome', '$desc_tarefa', 0,'$_SESSION[id_usuario]','$id_grupo')";
$query_incluir = mysqli_query($conexao, $incluir);

if ($incluir) {

  while($row_grupo = $result_grupo->fetch(PDO::FETCH_ASSOC)) {
    extract($row_grupo);

    header("location: tarefas.php?id_grupo=$id_grupo");
}
} else {
  echo "não foi possivel incluir";
}



header("location: tarefas.php?id_grupo=$id_grupo");



?>

