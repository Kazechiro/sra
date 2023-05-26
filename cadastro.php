<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>cadastro</title>
    <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap');
    </style>
    <!-- <title> Cadastro </title> -->
</head>
<body class="body-cadastro">
    <header>
        <nav class="nav-bar"> <!-- faz aparecer a barra no topo -->
            <div class="logo"> <!-- coloca o nome junto com a logo-->
                <h1>
                    <ion-icon name="cafe-outline"></ion-icon>
                    S.R.A
                </h1>
            </div>
            <div class="nav-list"> <!-- cria itens de navegacao -->
                <ul>
                    <li class="nav-item">
                        <a href="menu.html" class="nav-link">
                            Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Projetos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="menu.html" class="nav-link">
                            Sobre
                        </a>
                    </li>
                </ul>
            </div>
            <div class="login-button"> <!-- botao verde entrar -->
                <button>
                    <a href="index.php">
                        Entrar
                    </a>
                </button>
            </div>
            <div class="mobile-menu-icon">
                <button onclick="menuShow()">
                    <img class="icon" src="assets/img/menu_white_36dp.svg" alt="">
                </button>
            </div>
        </nav>
    </header>
    <script src="js/script.js"></script>
    <!-- <center> -->
    <!-- <h1>Cadastro</h1> -->
    <div id="cadastro">
        <form action="cadastrar.php" id="form_cadastro" method="POST">
            <!-- 
            <--Cadastrar matricula->
            <label for="nome">Digite seu nome:</label><br>
            <input type="text" name="nome" placeholder="nome" required><br>
            <--Cadastrar nome->
            <label for="login">Digite seu email:</label><br>
            <input type="text" name="email" placeholder="email" required><br> 
            <--Cadastrar senha->
            <label for="senha">Digite sua senha:</label><br>
            <input type="password" name="senha" placeholder="senha" required><br>

            <input type="submit" name="enviar" value="Cadastrar"><br>

            <span>já tem uma conta? <a href="index.php">logar</a></span> -->
            <h1>
                Cadastre sua conta
            </h1>
            <div class="input-container">
                <input type="text" name="Digite seu nome" class="inputCadastro" required>
                <label class="labelCadastro">
                    Nome
                </label>
            </div>
            <div class="input-container">
                <input type="text" name="Digite seu email" class="inputCadastro" required>
                <label class="labelCadastro">
                    Email
                </label>
            </div>
            <div class="input-container">
                <input type="password" name="Digite sua senha" class="inputCadastro" required>
                <label class="labelCadastro">
                    Senha
                </label>
            </div>
            <div>
                <button type="submit" class="submit-button" value="Cadastrar">
                    Cadastrar
                </button>
            </div>
            <div class="cadastro">
                Já tem uma conta? 
                <a href=index.php>
                    Logar
                </a>
            </div>
        </form>
    </div>
    <!-- </center> -->
</body>
<!-- codigo para mostrar logo do projeto na barra (placeholder) -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
