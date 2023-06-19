<?php
include('conexao.php');
require('protect.php');

$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        .aprovado {
            border: 2px solid green;
        }
    </style>
    <title>Sistema de Relatórios</title>
</head>
<body>
<header>
    <nav class="nav-bar">
        <div class="logo">
            <h1>
                <ion-icon name="cafe-outline"></ion-icon>
                S.R.A
            </h1>
        </div>
        <div class="nav-list">
            <ul>
                <li class="nav-item">
                    <a href="menu.php" class="nav-link">
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo isset($_SESSION['id_usuario']) ? 'principal.php' : 'cadastro.php'; ?>"
                       class="nav-link">
                        Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo isset($_SESSION['id_usuario']) ? 'perfil.php' : 'cadastro.php'; ?>"
                       class="nav-link">
                        Perfil
                    </a>
                </li>
            </ul>
        </div>
        <div class="login-button">
            <?php if (isset($_SESSION['id_usuario'])) : ?>
                <button onclick="window.location.href='logout.php';">
                    Sair
                </button>
            <?php else : ?>
                <button onclick="window.location.href='index.php';">
                    Entrar
                </button>
            <?php endif; ?>
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
                <a href="menu.php" class="nav-link">
                    Início
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo isset($_SESSION['id_usuario']) ? 'principal.php' : 'cadastro.php'; ?>"
                   class="nav-link">
                    Menu
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo isset($_SESSION['id_usuario']) ? 'perfil.php' : 'cadastro.php'; ?>"
                   class="nav-link">
                    Perfil
                </a>
            </li>
        </ul>
        <div class="login-button">
            <?php if (isset($_SESSION['id_usuario'])) : ?>
                <button onclick="window.location.href='logout.php';">
                    Sair
                </button>
            <?php else : ?>
                <button onclick="window.location.href='index.php';">
                    Entrar
                </button>
            <?php endif; ?>
        </div>
    </div>
</header>
<center>
    <br><br>
    <br><br><br><br>
    <h1>Relatório</h1>
    <form action="novoRelatorio.php?id_grupo=<?php echo $id_grupo ?>&nome_grupo=<?php echo $nome_grupo ?>"
          method="POST">
        <?php
        if (isset($_SESSION['msg_relatorio_excluido'])) {
            echo $_SESSION['msg_relatorio_excluido'];
            unset($_SESSION['msg_relatorio_excluido']);
        }
        ?>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao" boder=none rows=10 cols=50 maxlength="250" required></textarea><br><br>

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
        while ($row = $resultado->fetch_assoc()) {
            $relatorioId = $row['id_relatorio'];
            $classeAprovado = $row['aprovado'] ? 'aprovado' : '';

            echo "<div class='relatorio $classeAprovado' data-id='$relatorioId'>";
            echo "<h3>" . $row["titulo"] . "</h3>";
            echo "<p>" . $row["descricao"] . "</p>";
            echo "<div class='botoes'>";
            echo "<a href='editar_relatorio.php?id_relatorio=$relatorioId&id_grupo=$id_grupo&nome_grupo=$nome_grupo'>Editar</a>";
            echo "<a href='apagar_relatorio.php?id_relatorio=$relatorioId&id_grupo=$id_grupo&nome_grupo=$nome_grupo' onclick='return confirm(\"Tem certeza que deseja excluir o relatório?\")'>Excluir</a>";
            echo "<button class='aprovar-button'>Aprovar</button>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Nenhum relatório encontrado.";
    }

    // Fechar conexão
    $conexao->close();
    ?>
    <script>
        const relatorios = document.querySelectorAll('.relatorio');

        relatorios.forEach(relatorio => {
            relatorio.addEventListener('click', () => {
                relatorio.classList.toggle('aprovado');
            });
        });
    </script>
</center>
<script src="./js/script.js"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
