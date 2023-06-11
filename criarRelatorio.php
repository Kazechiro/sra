<?php
// Conectar ao banco de dados
include('conexao.php');
require('protect.php');

?>


<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Relatórios</title>
</head>
<body>
    <h1>Relatório</h1>
    <form action="novoRelatorio.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao" required></textarea><br><br>

        <input type="submit" value="Salvar">
    </form>

    <h2>Relatórios existentes:</h2>
    <?php
        
      

        // Verificar conexão
        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }

        // Consultar relatórios existentes
        $sql = "SELECT * FROM relatorio";
        $resultado = $conexao->query($sql);

        // Exibir relatórios
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<h3>" . $row["titulo"] . "</h3>";
                echo "<p>" . $row["descricao"] . "</p>";
                echo "<hr>";
            }
        } else {
            echo "Nenhum relatório encontrado.";
        }

        // Fechar conexão
        $conexao->close();
    ?>
</body>
</html>