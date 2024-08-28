<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="aluno.css">
    <title>Materias</title>
</head>
<body>
    <?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    session_start();
    $userId = $_SESSION['idUsuario'];

    require_once("../../dbConn.php");
    require_once("../../models/usuario.php");
    require_once("../../models/materia.php");
    // Usuario::cadastrarUsuarioEmMateria($userId, 2);
    // print_r(Usuario::obterMateriasCursadasPorUsuario($userId) -> fetch_object());
    // print_r(Usuario::obterMateriasNaoCursadasPorUsuario($userId) -> fetch_object());

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'] ?? '';

        switch($_POST['_method']){
            case 'SUB':
                Usuario::cadastrarUsuarioEmMateria($userId, $id);
                break;
            case 'UNSUB':
                Usuario::desinscreverAlunoDeMateria($userId, $id);
                break;
        }
        header("Location: http://localhost/gerenciador-de-presenca/pages/aluno");
    } else {
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

    <main>

    </main>
        <div class="main-container">
            <h2>Materias sendo Cursadas</h2>

            <table class="table table-secondary table-striped">
                <thead class="thead-dark">
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Professor</td>
                    <td>Carga Horária</td>
                    <td>Período</td>
                    <td>Dia</td>
                    <td>Curso</td>
                    <td>Turno</td>
                    <td></td>
                </thead>
                <tbody>
                <?php
                $materiasCursadas = Usuario::obterMateriasCursadasPorUsuario($userId);
                while ($row = $materiasCursadas -> fetch_object()) {
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
                            <form action="index.php" method="POST" class='form-btn-unsub'>
                                <input type="hidden" name="_method" value="UNSUB">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="X" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                    
                <?php } ?>
                    
                </tbody>
            </table>
            <br><br>
            <h2>Materias Disponiveis</h2>
            <table class="table table-secondary table-striped">
                <thead class="thead-dark">
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Professor</td>
                    <td>Carga Horária</td>
                    <td>Período</td>
                    <td>Dia</td>
                    <td>Curso</td>
                    <td>Turno</td>
                    <td></td>
                </thead>
                <tbody>
                <?php
                $materiasCursadas = Usuario::obterMateriasNaoCursadasPorUsuario($userId);
                while ($row = $materiasCursadas -> fetch_object()) {
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
                            <form action="index.php" method="POST" class='form-btn-unsub'>
                                <input type="hidden" name="_method" value="SUB">
                                <input type="hidden" name="id" value="<?= $row -> id?>">
                                <input type="submit" value="V" class="btn btn-success">
                            </form>
                        </td>
                    </tr>
                    
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </main>

    <?php } ?>
    
    
        
</body>
</html>