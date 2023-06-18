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
    <title>Perfil</title>
    <style>
        /* Estilos do modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Estilos para os campos de input editáveis */
        .editable {
            border: 1px solid #ccc;
            padding: 5px;
        }
    </style>
    <script>
        function toggleEdit() {
            var nameField = document.getElementById("nameField");
            var emailField = document.getElementById("emailField");
            var editButton = document.getElementById("editButton");

            if (nameField.contentEditable === "false") {
                // Habilitar edição dos campos de texto e alterar texto do botão
                nameField.contentEditable = "true";
                emailField.contentEditable = "true";
                nameField.focus();
                nameField.classList.add("editable");
                emailField.classList.add("editable");
                editButton.innerHTML = "Cancelar";

                // Exibir o botão "Salvar"
                document.getElementById("saveButton").style.display = "block";
            } else {
                // Desabilitar edição dos campos de texto e alterar texto do botão
                nameField.contentEditable = "false";
                emailField.contentEditable = "false";
                nameField.classList.remove("editable");
                emailField.classList.remove("editable");
                editButton.innerHTML = "Editar";

                // Ocultar o botão "Salvar"
                document.getElementById("saveButton").style.display = "none";
            }
        }
    </script>
</head>
<body>
    <center>
        <h1>Perfil de <?php echo $_SESSION['nome'] ?></h1>

        <?php
        // Restante do código para exibir as informações do perfil

        // Obter os dados do usuário atual do banco de dados
        $sql_usuario = "SELECT * FROM USUARIO WHERE id_usuario = :id_usuario";
        $sql_query = $conn->prepare($sql_usuario);
        $sql_query->bindParam(':id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
        $sql_query->execute();

        while ($row_usuario = $sql_query->fetch(PDO::FETCH_ASSOC)) {
            echo "<li style='list-style: none'>";
            echo "Nome: <span id='nameField'>" . $row_usuario['nome'] . "</span><br>";
            echo "Email: <span id='emailField'>" . $row_usuario['email'] . "</span><br>";
            echo "<button id='editButton' type='button' class='botao' onclick='toggleEdit()'>Editar</button><br>";
            echo "<button id='saveButton' type='submit' class='botao' style='display: none;'>Salvar</button><br>";
            echo "</li>";
        }
        ?>

        <!-- Modal de edição do perfil -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Editar Perfil</h2>

                <!-- Campos de input para editar o perfil -->
                <form action="perfil.php" method="post">
                    Nome: <input type="text" name="nome" id="editName"><br><br>
                    Email: <input type="email" name="email" id="editEmail"><br><br>
                    <input type="submit" value="Salvar">
                </form>
            </div>
        </div>

        <script>
            // Função para abrir o modal
            function openModal() {
                document.getElementById("modal").style.display = "block";
            }

            // Função para fechar o modal
            function closeModal() {
                document.getElementById("modal").style.display = "none";
            }
        </script>
    </center>
</body>
</html>
