<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Document</title>
</head>
<body>
<header>
        <nav class="nav-bar">
            <div class="logo">
                <h1><ion-icon name="cafe-outline"></ion-icon>S.R.A</h1>
            </div>
            <div class="nav-list">
                <ul>
                    <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
                    <li class="nav-item"><a href="principal.php" class="nav-link">Grupos</a></li>
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
                <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="principal.php" class="nav-link">Grupos</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Sobre</a></li>
            </ul>

            <div class="login-button">
                <button><a href="index.php">Entrar</a></button>
            </div>
        </div>
    </header>
    <script src="js/script.js"></script>
    <div id="login">
    <form action="novo_grupo.php" method="POST" id="form_Grupo" style="padding-top: 100px;">
    <h1>criar grupo</h1>
        <div class="input-grupo">          
            <input type="text" name="nome_grupo" class="inputLogin">
            <label class="labelLogin">Nome do grupo</label>
        </div>

            <div class="input-grupo">
            <input type="text" name="desc_grupo" class="inputLogin">
            <label class="labelLogin">Descrição do grupo</label>
            </div>

        <div>
            <button type="submit" class="submit-button">Entrar</button>

        </div>

    </form>
</div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>