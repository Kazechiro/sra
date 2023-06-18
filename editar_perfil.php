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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
</head>
<body>
    <h2>EDITAR TAREFA</h2>
    <form action="" method="post" id="todo-form">
        <br>
        <label for="nome">Nome:</label>
        <input name="nome" type="text" id="todo-input" value="<?php echo $_SESSION['nome']; ?>" required/><br>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="todo-input" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required/><br>
        <br>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>