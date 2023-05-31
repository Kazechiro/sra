<?php
session_start();

ob_start();

include('conexao.php');


$id_grupo = filter_input(INPUT_GET, 'id_grupo', FILTER_SANITIZE_NUMBER_INT);
var_dump($id_grupo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Painel</title>
</head>
<body id="body-principal">
<?php
if (!empty($id_grupo)) {
$query_grupo ="SELECT id_grupo, nome_grupo, desc_grupo FROM grupo WHERE id_grupo=:id_grupo LIMIT 1";
$result_grupo = $conn->prepare($query_grupo);
$result_grupo->execute();
} else {
  $_SESSION['msg'] ="<p>Erro: grupo não encontrado</p>";
  header("Location: principal.php");
}


?>
  <script src="js/script.js"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
