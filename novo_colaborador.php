<?php
session_start();
// Conexão com o banco de dados
include('conexao.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoEntrada = $_POST['codigo_entrada'];
    $grupoId = intval($codigoEntrada); // Converter o código de entrada para inteiro

    // Consultar a tabela 'grupo' para verificar se o grupo com o ID fornecido existe
    $sql = "SELECT id_grupo FROM grupo WHERE id_grupo = $grupoId";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) > 0) {
        // O grupo existe, você pode permitir que o usuário entre no grupo ou execute outras ações necessárias
        // Por exemplo, adicionar o usuário como um colaborador do grupo
        $usuarioId = $_SESSION['id_usuario']; // ID do usuário (substitua pelo valor correto)

        // Verificar se o usuário já é colaborador do grupo
        $sql = "SELECT * FROM colaborador_grupo WHERE usuario_id = $usuarioId AND grupo_id = $grupoId";
        $result = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "Você já é um colaborador deste grupo.";
        } else {
            // Adicionar o usuário como colaborador do grupo
            $sql = "INSERT INTO colaborador_grupo (usuario_id, grupo_id) VALUES ($usuarioId, $grupoId)";
            if (mysqli_query($conexao, $sql)) {
                echo "Você foi adicionado como colaborador do grupo com sucesso!";
            } else {
                echo "Erro ao adicionar como colaborador do grupo.";
                var_dump($sql);
            }
        }
    } else {
        // Grupo não encontrado, exibir mensagem de erro
        echo "ID do grupo inválido. Por favor, tente novamente.";
    }
}
?>