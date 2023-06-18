<?php
session_start();
include('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login
    header("Location: index.php");
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idUsuario = $_SESSION['id_usuario'];

    // Atualiza os dados do perfil no banco de dados
    $sql_update = "UPDATE USUARIO SET nome = :nome, email = :email WHERE id_usuario = :id_usuario";
    $sql_query = $conn->prepare($sql_update);
    $sql_query->bindParam(':nome', $nome, PDO::PARAM_STR);
    $sql_query->bindParam(':email', $email, PDO::PARAM_STR);
    $sql_query->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $sql_query->execute();

    // Redireciona de volta para a página de perfil
    header("Location: perfil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Document</title>
</head>
<style>
  .GrupoTela {
    border: 1px solid #000;
    padding: 20px;
    width: 45%;
    background: white;
    box-shadow: 10px 20px grey;
    border-radius: 10px 20px 30px;
    margin: 35px auto;
    text-align: center;
  }
</style>
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
                <?php if(isset($_SESSION['id_usuario'])): ?>
                    <button>
                        <a href="logout.php">Sair</a>
                    </button>
                <?php else: ?>
                    <button>
                        <a href="index.php">Entrar</a>
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
      <div class="login-button">
        <button>
          <a href="logout.php">
            Logout
          </a>
        </button>
      </div>
    </div>
</header>
<body>
    <br><br><br><br>
  <center>
        
    <div class="GrupoTela">
      <h2>Perfil de <?php echo $_SESSION['nome'] ?></h2>

        <?php
        // Restante do código para exibir as informações do perfil

        // Obter os dados do usuário atual do banco de dados
        $sql_usuario = "SELECT * FROM USUARIO WHERE id_usuario = :id_usuario";
        $sql_query = $conn->prepare($sql_usuario);
        $sql_query->bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
        $sql_query->execute();

  while ($row_usuario = $sql_query->fetch(PDO::FETCH_ASSOC)) {
    echo "<li style='list-style: none'>";
    echo "Nome: " . $row_usuario['nome'] . "<br>";
    echo "Email: " . $row_usuario['email'] . "<br>";
    echo "</li>";
  }
  
  
  ?>
  </center>
</body>

</html>

