<?php 
include('conexao.php');
require('protect.php');
$id_tarefa = $_GET['id_tarefa'];
$id_grupo = $_GET['id_grupo'];
$nome_grupo = $_GET['nome_grupo'];

$query_tarefa = "SELECT nome_tarefa, desc_tarefa, status_tarefa FROM tarefa WHERE id_tarefa = :id_tarefa";
$stmt_tarefa = $conn->prepare($query_tarefa);
$stmt_tarefa->bindParam(':id_tarefa', $id_tarefa);
$stmt_tarefa->execute();
$row_tarefa = $stmt_tarefa->fetch(PDO::FETCH_ASSOC);

// Recupere os detalhes da tarefa
$nome_tarefa = $row_tarefa['nome_tarefa'];
$desc_tarefa = $row_tarefa['desc_tarefa'];
$status_tarefa = $row_tarefa['status_tarefa'];


$query_colaboradores = "SELECT c.id_usuario, c.nome FROM usuario AS c
                       INNER JOIN colaborador_grupo AS cg ON c.id_usuario = cg.usuario_id
                       WHERE cg.grupo_id = $id_grupo";
$result_colaboradores = mysqli_query($conexao, $query_colaboradores);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Editar Tarefa</title>
</head>
<style>
  .boxedit{
    position: relative;
    margin-top: 10px;
        padding: 10px;
        margin: auto;
        width: 400px;
        height: 400px;
        height: 400px;
        
  }
  </style>
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
    <br><br><br><br><br><br><br>
    <div class="boxedit">
    <center>
      <h1>EDITAR TAREFA</h1>
  <form action="" method="post" id="todo-form">
    <br>
<label for="nome">Nome:</label>
<input name="nome_tarefa" type="text" id="todo-input" placeholder="O que você vai fazer?" value="<?php echo $nome_tarefa; ?>" required/><br>
<br>
<label for="desc_tarefa">Descrição:</label><br>
<textarea id="todo-input" name="desc_tarefa" placeholder="Descreva brevemente seu Projeto" rows=10 cols=35 maxlength="250" required><?php echo $desc_tarefa; ?></textarea><br>
<br>
<label for="status_tarefa">Status da Tarefa:</label><br>
<select name="status_tarefa" required><br>
    <!-- Opções do status da tarefa -->
    <br><?php
    $query_status = "SELECT id_status, nome_status FROM tarefa_status";
    $result_status = mysqli_query($conexao, $query_status);
    while ($row_status = mysqli_fetch_assoc($result_status)) {
        $selected = ($row_status['id_status'] == $status_tarefa) ? 'selected' : '';
        echo "<option value='" . $row_status['id_status'] . "' $selected>" . $row_status['nome_status'] . "</option>";
    }
    ?>
<br>

</select><br>
<br><span>Responsável:</span>
 <br>
 <select name="colaborador_id" required>
          <option value="">Selecione um colaborador</option>
          <?php
          while ($row_colaborador = mysqli_fetch_assoc($result_colaboradores)) {
            echo "<option value='" . $row_colaborador['id_usuario'] . "'>" . $row_colaborador['nome'] . "</option>";
          }
          ?>
        </select>

<br><input type="submit" value="Salvar" class="botao" />
</form>
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Recupere os valores atualizados do formulário
  $nome_tarefa_atualizado = $_POST['nome_tarefa'];
  $desc_tarefa_atualizado = $_POST['desc_tarefa'];
  $status_tarefa_atualizado = $_POST['status_tarefa'];
  $colaborador_id_atualizado = $_POST['colaborador_id'];
  // Execute uma consulta SQL para atualizar os detalhes da tarefa
  $query_atualizar = "UPDATE tarefa SET nome_tarefa = :nome_tarefa, desc_tarefa = :desc_tarefa, status_tarefa = :status_tarefa, colaborador_id = :colaborador_id
   WHERE id_tarefa = :id_tarefa";
  $stmt_atualizar = $conn->prepare($query_atualizar);
  $stmt_atualizar->bindParam(':nome_tarefa', $nome_tarefa_atualizado);
  $stmt_atualizar->bindParam(':desc_tarefa', $desc_tarefa_atualizado);
  $stmt_atualizar->bindParam(':status_tarefa', $status_tarefa_atualizado);
  $stmt_atualizar->bindParam(':id_tarefa', $id_tarefa);
  $stmt_atualizar->bindParam(':colaborador_id', $colaborador_id_atualizado);
  if ($stmt_atualizar->execute()) {
      // Redirecione o usuário para a página principal ou qualquer outra página desejada
      header("Location: tarefas.php?id_grupo=$id_grupo&nome_grupo=$nome_grupo&tarefa_status=$nome_status");
      echo "edited";
      exit();
  } else {
      // Lidere com erros de atualização, se necessário
  }
}







?>
</div>
</center>
 <script src="./js/script.js"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>