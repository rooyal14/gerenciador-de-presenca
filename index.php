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
        $nome = $_POST['nome'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $funcao = $_POST['funcao'] ?? '';

        $usuario = new Usuario($senha, $nome, $funcao);
        Usuario::createUsuario($usuario);

    } else {
        // Exibir o formulário de cadastro
        ?>
        <div class="crud-usuarios" style="margin: 40px;padding: 10px; border: 1px solid black; width: 260px;">
            <h2>Usuarios</h2>
            <form method="POST" action="index.php">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required><br>
                <label for="nome">Senha:</label>
                <input type="password" name="senha" required><br>
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
        </div>
        
        <?php
    }
    ?>
    
</body>
</html>