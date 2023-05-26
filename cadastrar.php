<?php
include('conexao.php');
//INCLUIR
$nome = isset($_POST['nome'])? $_POST['nome'] : '';
$email = isset($_POST['email'])? $_POST['email'] : ''; 
$senha = isset($_POST['senha'])? $_POST['senha'] : '';

$verificar_email ="SELECT email FROM usuario WHERE email  = '$email'"; //Percorre todo a coluna matricula e ver se a matricula que o usuário informou já existe
$query_verificar = mysqli_query($conexao, $verificar_email);
$dados = mysqli_fetch_row($query_verificar);


if ($dados[0] != $email) { 

$incluir = "INSERT INTO usuario(nome, email, senha) 
VALUES ('$nome', '$email', '$senha')";
$query_incluir = mysqli_query($conexao, $incluir);

header("location: cadastro.php");
   
} else {
    echo "email já cadastrado";
}

?>
