<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="index.css">

    <title>Adm Home page</title>
</head>
<body>
    <?php
    require_once("../../dbConn.php");
    require_once("../../models/usuario.php");
    require_once("../../models/materia.php");
    // Verificar se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch($_POST['_method']){
            case 'POST':
                switch ($_POST['entity']) {
                    case 'Usuario':
                        // Receber dados do formulário
                        $nome = $_POST['nome'] ?? '';
                        $senha = $_POST['senha'] ?? '';
                        $funcao = $_POST['funcao'] ?? '';
                        $usuario = new Usuario($nome, $funcao, $senha);
                        Usuario::createUsuario($usuario);
                        break;
                    case 'Materia':
                        $nome = $_POST['nome'] ?? '';
                        $idProfessor = $_POST['idProfessor'] ?? '';
                        $materia = new Materia($nome, $idProfessor);
                        Materia::createMateria($materia);
                        break;
                    
                }
                break;
                
            case 'DELETE':
                switch ($_POST['entity']) {
                    case 'Usuario':
                        $id = $_POST['id'];
                        Usuario::deleteUsuario($id);
                        break;
                    case 'Materia':
                        $id = $_POST['id'];
                        Materia::deleteMateria($id);
                        break;
                }
            // TODO
            case 'PUT':
                $id = $_POST['id'];
                echo $id;
                echo 'PUT';
        }
        
        header("Location: http://localhost/gerenciador-de-presenca/pages/admin"); 
    } else {
        // Exibir o formulário de cadastro
        ?>
        <header class="header">
          <nav class="nav container">
             <div class="nav__data">
                <a href="#" class="nav__logo">
                   <i class="ri-planet-line"></i> Gerenciador de Aulas
                </a>                
             </div> 
          </nav>
       </header>
        <div class="crud-usuarios" style="margin: 40px;padding: 10px; border: 1px solid black; width: 920px;">
            <form method="POST" action="index.php" class='form-usuario'>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required><br>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" required><br>

                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="entity" value="Usuario">

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
                $usuarios = Usuario::showAllUsuarios();
                while ($row = $usuarios -> fetch_object()) {
                    ?>
                    <tr>
                        <td><?= $row -> id?></td>
                        <td><?= $row -> nome?></td>
                        <td><?= $row -> senha?></td>
                        <td><?= $row -> nomeFuncao?></td>
                        <td>
                            <form action="index.php" method="POST" class='form-btn-edit'>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="I">
                            </form>
                            <form action="index.php" method="POST" class='form-btn-delete'>
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
        <br>
        <div class="crud-materias" style="margin: 40px;padding: 10px; border: 1px solid black; width: 800px;">
        <form method="POST" action="index.php" class='form-materias'>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required><br>

                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="entity" value="Materia">

                <label for="idProfessor">Professor:</label>
                <select name="idProfessor">
                    <?php
                    $professores = Usuario::getAllProfessores();
                    while ($row = $professores -> fetch_object()) {
                        ?>
                        <option value="<?= $row -> id ?>"><?= $row -> nome?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Cadastrar">
            </form>
            <h2>Materias</h2>
            <button onclick='popupAdicionarMateria()'>Adicionar +</button>
            <table>
                <thead>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Professor</td>
                </thead>
                <tbody>
                <?php
                $materias = Materia::showAllMaterias();
                while ($row = $materias -> fetch_object()) {
                    ?>
                    <tr>
                        <td><?= $row -> id?></td>
                        <td><?= $row -> nome?></td>
                        <td><?= $row -> nomeProfessor?></td>
                        <td>
                            <form action="index.php" method="POST" class='form-btn-edit'>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="entity" value="Materia">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="I">
                            </form>
                            <form action="index.php" method="POST" class='form-btn-delete'>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="entity" value="Materia">
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