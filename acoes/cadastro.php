<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <center>
    <h1>Cadastro</h1>
    <div id="cadastro.php">
    <form action="cadastrar.php" id = "form_cad" method="post">
        <!--Cadastrar matricul-->
        <label for="nome">Digite seu nome:</label><br>
        <input type="text" name="nome" placeholder="nome" required><br>

        <!--Cadastrar nome-->
        <label for="login">Digite seu email:</label><br>
        <input type="text" name="email" placeholder="email" required><br> 

        <!--Cadastrar senha-->
        <label for="senha">Digite sua senha:</label><br>
        <input type="password" name="senha" placeholder="senha" required><br>

        <input type="submit" name="enviar" value="Cadastrar">
       

    </form>
    </div>
    </center>
</body>
</html>