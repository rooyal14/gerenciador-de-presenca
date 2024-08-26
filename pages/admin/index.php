<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        table, th, td {
        margin: 10px;
        padding: 5px;
        border: 1px solid black;
        border-collapse: collapse;
        }

        .form {
            border: 1px solid black;
            width: 400px;
            height: 200px;
            padding: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -200px;
            margin-top: -100px;
            background-color: white;
            display: none;
            flex-flow: column wrap;
            justify-content: flex-start;

        }
    </style>
    <script>
        function popupAdicionarUsuario() {
            const form = document.getElementsByClassName('form')[0];
            form.style.display = "flex";
            
        }
    </script>
</head>
<body>
    <?php
    require_once("../../dbConn.php");
    require_once("../../models/usuario.php");
    // Verificar se o formulário foi submetido
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch($_POST['_method']){
            case 'POST':
                // Receber dados do formulário
                $nome = $_POST['nome'] ?? '';
                $senha = $_POST['senha'] ?? '';
                $funcao = $_POST['funcao'] ?? '';
                $usuario = new Usuario($nome, $funcao, $senha);
                Usuario::createUsuario($usuario);
                break;
            case 'DELETE':
                $id = $_POST['id'];
                echo Usuario::deleteUsuario($id);
                break;
            case 'PUT':
                $id = $_POST['id'];
                echo $id;
                echo 'PUT';
        }
        
        // header("Location: http://localhost/gerenciador-de-presenca"); 
        // exit();
    } else {
        // Exibir o formulário de cadastro
        ?>
        <form method="POST" action="index.php" class='form'>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required><br>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" required><br>

                <input type="hidden" name="_method" value="POST">

                <label for="funcao">Função:</label>
                <select name="funcao">
                    <?php
                    $funcoes = DbController::query("SELECT * FROM Funcao");
                    while ($row = $funcoes -> fetch_object()) {
                        ?>
                        <option value="<?= $row -> id ?>"><?= $row -> nome?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Cadastrar">
            </form>
        <div class="crud-usuarios" style="margin: 40px;padding: 10px; border: 1px solid black; width: 800px;">
            <h2>Usuarios</h2>
            <button onclick='popupAdicionarUsuario()'>Adicionar +</button>
            <table>
                <thead>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Senha</td>
                    <td>Funcao</td>
                    <td>Alterar</td>
                </thead>
                <tbody>
                <?php
                $usuarios = Usuario::getAllUsuarios();
                while ($row = $usuarios -> fetch_object()) {
                    ?>
                    <tr>
                        <td><?= $row -> id?></td>
                        <td><?= $row -> nome?></td>
                        <td><?= $row -> senha?></td>
                        <td><?= $row -> idFuncao?></td>
                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="I">
                            </form>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="X">
                            </form>
                        </td>
                    </tr>
                    
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    
    <?php
    }
    ?>
    
</body>

</html>