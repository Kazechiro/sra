<?php
session_start();
include('conexao.php');
require('protect.php');
// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $id_usuario = $_SESSION['id_usuario'];

    // Atualiza as informações do perfil no banco de dados
    $sql = "UPDATE usuario SET nome = :nome, email = :email WHERE id_usuario = :id_usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id_usuario', $id_usuario);

    if ($stmt->execute()) {
       
        header("Location: perfil.php");
        exit();
    } else {
        
        echo "Ocorreu um erro ao atualizar as informações do perfil.";
    }
}
?>
