<?php
if(!isset($_SESSION)) {
  session_start();
}
include('conexao.php');

$nome_grupo = isset($_POST['nome_grupo'])? $_POST['nome_grupo'] : '';
$desc_grupo = isset($_POST['desc_grupo'])? $_POST['desc_grupo'] : ''; 



  $incluir = "INSERT INTO grupo(nome_grupo, desc_grupo, usuario_id,grupo_id) 
  VALUES ('$nome_grupo', '$desc_grupo','$_SESSION[id_usuario]','$_SESSION[id_grupo]')";
  $query_incluir = mysqli_query($conexao, $incluir);
  
  header("location: principal.php");
     

  
var_dump($query_incluir)



?>