<?php
if(!isset($_SESSION)) {
    session_start();
}
include('protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
</head>
<body>
    <center>
    Bem vindo ao Painel, <?php echo $_SESSION['nome']; ?>.

    <p>
        <a href="criarGrupo.php">Criar um grupo</a> <br>
        <a href="entrarGrupo.php">Entrar em um grupo já criado</a>.<br>
        <a href="logout.php">Sair</a>
    </p>
    </center>
</body>
</html>