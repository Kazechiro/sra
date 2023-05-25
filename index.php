<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $conexao->real_escape_string($_POST['email']);
        $senha = $conexao->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: principal.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap');
</style>
    <title>Login</title>
</head>
<body class="body-login">
<header>
        <nav class="nav-bar">
            <div class="logo">
                <h1><ion-icon name="cafe-outline"></ion-icon>S.R.A</h1>
            </div>
            <div class="nav-list">
                <ul>
                    <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Projetos</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"> Sobre</a></li>
                </ul>
            </div>
            <div class="login-button">
                <button><a href="index.php">Entrar</a></button>
            </div>

            <div class="mobile-menu-icon">
                <button onclick="menuShow()"><img class="icon" src="assets/img/menu_white_36dp.svg" alt=""></button>
            </div>
        </nav>
        <div class="mobile-menu">
            <ul>
                <li class="nav-item"><a href="#" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Projetos</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Sobre</a></li>
            </ul>

            <div class="login-button">
                <button><a href="#">Entrar</a></button>
            </div>
        </div>
    </header>
    <script src="js/script.js"></script>
   
    <div id="login">
    <form action="" method="POST" id="form_login">
    <h1>Acesse sua conta</h1>
        <div class="input-container">          
            <input type="text" name="email" class="inputLogin">
            <label class="labelLogin">E-mail</label>
        </div>

            <div class="input-container">
            <input type="password" name="senha" class="inputLogin">
            <label class="labelLogin">Senha</label>
            </div>

        <div>
            <button type="submit" class="submit-button">Entrar</button>

        </div>
     <div class="cadastro">
            não possui uma conta?<a href="cadastro.php">inscreva-se</a>
     </div>
    </form>
    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>