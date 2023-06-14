<?php
// Conectar ao banco de dados
include('conexao.php');
require('protect.php');
echo "ESTAMOS TRABALHANDO NISSO. <a href='principal.php'>Menu</a>";

?>

<!--
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/styles.css">
    <title>Sistema de Relatórios</title>
</head>
<body>
<header>
        <nav class="nav-bar">
            <div class="logo">
                <h1>
                    <ion-icon name="cafe-outline">

                    </ion-icon>
                    S.R.A
                </h1>
            </div>
            <div class="nav-list">
                <ul>
                    <li class="nav-item">
                        <a href="menu.html" class="nav-link">
                            Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="principal.php" class="nav-link">
                            Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Sobre
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="mobile-menu-icon">
                <button onclick="menuShow()">
                    <img class="icon" src="assets/img/menu_white_36dp.svg" alt="">
                </button>
            </div>
        </nav>
        <div class="mobile-menu">
            <ul>
                <li class="nav-item">
                    <a href="menu.html" class="nav-link">
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a href="principal.php" class="nav-link">
                        Grupos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Sobre
                    </a>
                </li>
            </ul>
            
        </div>
    </header>
    <center>
        <br><br>
        
    <br><br><br><br>
    <h1>Relatório</h1>
    <form action="novoRelatorio.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao" boder=none rows=10 cols=50 maxlength="250" required></textarea><br><br>

        <input type="submit" value="Salvar">
    </form>

    <h2>Relatórios existentes:</h2>
    <?php
        
      /*

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
        */
    ?>
<script src="./js/script.js"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>

-->