<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Login</title>  
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
                header("Location: http://localhost/gerenciador-de-presenca/pages/admin"); 
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
        <div class="tela-login">
            <h1>Login</h1>
            <form method="POST" action="index.php">
                <input class='text-input' type="text" placeholder='Matricula' name="id">
                <br><br>
                <input class='text-input' type="password" placeholder='Senha' name="senha">
                <br><br>
                <input class='btn-input' type="submit" value="Login">
            </form>
        </div>
        
        <?php
    }
    ?>
    
</body>
</html>