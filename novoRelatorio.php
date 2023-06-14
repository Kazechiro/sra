<?php

  include('conexao.php');
    $id_grupo = $_GET['id_grupo'];
    $id_grupo = $_GET['nome_grupo'];


    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coletar dados do formulário
        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];
        $data = date("Y-m-d");
        $hora = date("H:i:s");
    }
        // Conectar ao banco de dados
      

        // Verificar conexão
        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }

        // Inserir relatório no banco de dados
        $sql = "INSERT INTO relatorio (titulo, descricao, data_relatorio, hora) VALUES ('$titulo', '$descricao', '$data', '$hora')";
        if ($conexao->query($sql) === TRUE) {
            echo "Relatório salvo com sucesso.";
            header("Location: criarRelatorio.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo");
        } else {
            echo "Erro ao salvar o relatório: " . $conexao->error;
            header("Location: criarRelatorio.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo");
        }
            
        
        ?>