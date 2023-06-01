<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Criar Grupo</title>
</head>
<style>
    .inputtype{
        position: relative;
    }
    .inputNome{
        position: relative;
        background: none;
    border: none;
    border-bottom: 1px solid white;
    outine: none;
    color: black;
    font-size: 15px;
    width: 90%;
    letter-spacing: 2px;
}
.labelinput{
    position:absolute;
    top: 0px;
    left:0px;
    pointer-events: none;
    transition: .5s;
}
.inputNome:focus ~ .labelinput,
.inputNome:valid ~ .labelinput{
    top: -20px;
    font-size: 13px;
}
.submit-button{
width: 96%;
border: none;
padding: 15px;
color: black;
font-size: 15px;
cursor: pointer;
border-radius: 10px;
}
.submit-button:hover{
    background-color: #528B8B;
}
.login{
  position: absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%, -50%);
    blackground-color: rgba(0, 0, 0, 0.8);
    padding: 15px;
    border-radius: 15px;
    width: 20%;
}
legend{
    border: 1px solid #D9D9D9;
    padding: 10px;
    text-align: center;
    background-color: #D9D9D9;
    color: black;
}
    </style>
<body>
<header>
        <nav class="nav-bar">
            <div class="logo">
                <h1><ion-icon name="cafe-outline"></ion-icon>S.R.A</h1>
            </div>
            <div class="nav-list">
                <ul>
                    <li class="nav-item"><a href="menu.html" class="nav-link">Início</a></li>
                    <li class="nav-item"><a href="principal.php" class="nav-link">Menu</a></li>
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
    <div class="login">
    <form action="novo_grupo.php" method="POST" id="form_CGrupo" >
      <br><br>
      <br><br>
      
    <legend><b>Criar Grupo</b></legend>
    <br><br>
        <div class="inputtype">          
            <input type="text" name="nome_grupo" class="inputNome" required> 
            <label class="labelinput">Nome do grupo</label>
        </div>
<br><br><br>
            <div class="inputtype">
            <input type="text" name="desc_grupo" class="inputNome" required>  
            <label class="labelinput">Descrição do grupo</label>
            </div>
<br>
        <div>
            <button type="submit" class="submit-button">Criar</button>

        </div>
        
    </form>
</div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>