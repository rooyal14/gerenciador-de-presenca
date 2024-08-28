<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="admin.css">

    <title>Adm Home page</title>
</head>
<body>
    <?php
    session_start();
    require_once("../../dbConn.php");
    require_once("../../models/usuario.php");
    require_once("../../models/materia.php");
    // Verificar se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo 'metodo';
        // echo $_POST['_method'];
        // echo 'entid';
        // echo $_POST['entity'];
        // echo 'id';
        // echo $_POST['id'];
        switch($_POST['_method']){
            case 'POST':
                switch ($_POST['entity']) {
                    case 'Usuario':
                        // Receber dados do formulário
                        $nome = $_POST['nome'] ?? '';
                        $senha = $_POST['senha'] ?? '';
                        $funcao = $_POST['funcao'] ?? '';
                        $email = $_POST['email'] ?? '';
                        $telefone = $_POST['telefone'] ?? '';
                        $dataIngresso = $_POST['dataIngresso'] ?? '';
                        $dataNascimento = $_POST['dataNascimento'] ?? '';
                        $usuario = new Usuario($nome, $funcao, $email, $telefone, $dataIngresso, $dataNascimento, $senha);
                        Usuario::createUsuario($usuario);
                        break;
                    case 'Materia':
                        $nome = $_POST['nome'] ?? '';
                        $idProfessor = $_POST['idProfessor'] ?? '';
                        $cargaHoraria = $_POST['cargaHoraria'] ?? '';
                        $periodo = $_POST['periodo'] ?? '';
                        $idDiaSemana = $_POST['idDiaSemana'] ?? '';
                        $idCurso = $_POST['idCurso'] ?? '';
                        $idTurno = $_POST['idTurno'] ?? '';

                        $materia = new Materia($nome, $idProfessor, $cargaHoraria, $periodo, $idDiaSemana, $idCurso, $idTurno);
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
                echo 'nada';
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
        <div class="crud-usuarios" style="margin: 40px;padding: 10px; width: 920px;">
            <h2>Cadastro de Usuários</h2>
            <form method="POST" action="index.php" class='form-usuario'>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required><br>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" required><br>

                <label for="telefone">Telefone:</label>
                <input type="tel" name="telefone" required><br>

                <label for="dataIngresso">Data de Ingresso:</label>
                <input type="date" name="dataIngresso" required><br>

                <label for="dataNascimento">Data de Nascimento:</label>
                <input type="date" name="dataNascimento" required><br>

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
            <br>
            <h2>Usuarios</h2>
            <!-- <button onclick='popupAdicionarUsuario()'>Adicionar +</button> -->
            <table class="table table-striped table">
                <thead>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Função</td>
                    <td>Email</td>
                    <td>Telefone</td>
                    <td>Data Ingresso</td>
                    <td>Data Nascimento</td>
                    <td style="width: 20%;">Ações</td>
                </thead>
                <tbody>
                <?php
                $usuarios = Usuario::showAllUsuarios();
                while ($row = $usuarios -> fetch_object()) {
                    ?>
                    <tr>
                        <td><?= $row -> id?></td>
                        <td><?= $row -> nome?></td>
                        <td><?= $row -> nomeFuncao?></td>
                        <td><?= $row -> email?></td>
                        <td><?= $row -> telefone?></td>
                        <td><?= $row -> dataIngresso?></td>
                        <td><?= $row -> dataNascimento?></td>
                        <td>
                            <form action="index.php" method="POST" class='form-btn-edit'>
                                <input type="hidden" name="_method" value="PUT"> 
                                <input type="hidden" name="entity" value="Usuario">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="I" class="btn btn-warning">
                            </form>
                            <form action="index.php" method="POST" class='form-btn-delete'>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="entity" value="Usuario">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="X" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                    
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
        <br>
        
        <div class="crud-materias" style="margin: 40px;padding: 10px; width: 800px;">
        <h2>Cadastro de Materias</h2>
        <form method="POST" action="index.php" class='form-materias'>
                <label for="nome">Nome:</label>
                <input type="text" name="nome"required><br>

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
                </select><br>
                <label for="cargaHoraria">Carga Horária:</label>
                <input type="number" step="0.1" name="cargaHoraria" required><br>

                <label for="periodo">Período:</label>
                <input type="number" name="periodo" required><br>

                <label for="idDiaSemana">Dia da Semana:</label>
                <select name="idDiaSemana">
                    <?php
                    $diasSemana = DbController::query("SELECT * FROM DiaSemana");
                    while ($row = $diasSemana -> fetch_object()) {
                        ?>
                        <option value="<?= $row -> id ?>"><?= $row -> nome?></option>
                    <?php } ?>
                </select><br>

                <label for="idCurso">Curso:</label>
                <select name="idCurso">
                    <?php
                    $cursos = DbController::query("SELECT * FROM Curso");
                    while ($row = $cursos -> fetch_object()) {
                        ?>
                        <option value="<?= $row -> id ?>"><?= $row -> nome?></option>
                    <?php } ?>
                </select><br>

                <label for="idTurno">Turno:</label>
                <select name="idTurno">
                    <?php
                    $turnos = DbController::query("SELECT * FROM Turno");
                    while ($row = $turnos -> fetch_object()) {
                        ?>
                        <option value="<?= $row -> id ?>"><?= $row -> nome?></option>
                    <?php } ?>
                </select><br>
                <input type="submit" value="Cadastrar">
            </form>
            <br>
            <h2>Materias</h2>
            <!-- <button onclick='popupAdicionarMateria()'>Adicionar +</button> -->
            <table class="table table-striped table">
                <thead>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Professor</td>
                    <td>Carga Horária</td>
                    <td>Período</td>
                    <td>Dia</td>
                    <td>Curso</td>
                    <td>Turno</td>
                    <td style="width: 20%;">Ações</td>

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
                        <td><?= $row -> cargaHoraria?></td>
                        <td><?= $row -> periodo?></td>
                        <td><?= $row -> nomeDiaSemana?></td>
                        <td><?= $row -> nomeCurso?></td>
                        <td><?= $row -> nomeTurno?></td>
                        <td>
                            <form action="index.php" method="POST" class='form-btn-edit'>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="entity" value="Materia">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="I" class="btn btn-warning">
                            </form>
                            <form action="index.php" method="POST" class='form-btn-delete'>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="entity" value="Materia">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="X" class="btn btn-danger">
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