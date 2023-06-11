<?php
session_start();
// Conexão com o banco de dados
include('conexao.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoEntrada = $_POST['codigo_entrada'];
    $grupoId = intval($codigoEntrada); // Converter o código de entrada para inteiro

    // Consultar a tabela 'grupo' para verificar se o grupo com o ID fornecido existe
    $sql = "SELECT id_grupo FROM grupo WHERE id_grupo = $grupoId LIMIT 1";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        $usuarioId = $_SESSION['id_usuario']; 

        
        $sql = "SELECT * FROM colaborador_grupo WHERE usuario_id = $usuarioId AND grupo_id = $grupoId";
        $result = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="mensagem">' . "Você já é um colaborador deste grupo." . '</div>';
        } else {
            
            $sql = "INSERT INTO colaborador_grupo (usuario_id, grupo_id) VALUES ($usuarioId, $grupoId)";
            if (mysqli_query($conexao, $sql)) {
                echo '<div class="mensagem">' . "Você foi adicionado como colaborador do grupo com sucesso!" . '</div>';
                header('Location: principal.php');
            } else {
                echo '<div class="mensagem">' . "Erro ao adicionar como colaborador do grupo." . '</div>';
                var_dump($sql);
            }
        }
    } else {
       
        echo '<div class="mensagem">'. "ID do grupo inválido. Por favor, tente novamente" . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <style>
        .mensagem{
            border: 1px solid #000;
        padding: 20px;
        width: 65%;
        background: white;
        border-radius: 10px 20px 30px;
        position: relative;
        z-index: -1;
        padding-bottom: 100px;
        margin-bottom: 40px;
        bottom: -125px;
        }
        </style>
    <br>
    
<a href="entrarGrupo.php" class="nav-link">
                            VOLTAR
                        </a>
    </center>
</body>


</html>