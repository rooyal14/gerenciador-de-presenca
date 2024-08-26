<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once("dbConn.php");
    require_once("models/usuario.php");

    // Verificar se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Receber dados do formulário
        $id = $_POST['id'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $usuario = Usuario::login($id, $senha);
        switch ($usuario -> idFuncao) {
            case 1:
                header("Location: http://localhost/gerenciador-de-presenca/admin"); 
                exit();
                break;
            case 2:
                echo 'Tela professor';
                break;
            case 3:
                echo 'Tela aluno';
                break;
            default:
                echo 'Função inválida';
        }
    

    } else {
        // Exibir o formulário de cadastro
        ?>
        <div class="login" style="margin: 40px;padding: 10px; border: 1px solid black; width: 260px;">
            <h2>Login</h2>
            <form method="POST" action="login.php">
                <label for="id">Id:</label>
                <input type="text" name="id" required><br>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required><br>
                <input type="submit" value="Login">
            </form>
        </div>
        
        <?php
    }
    ?>
    
</body>
</html>