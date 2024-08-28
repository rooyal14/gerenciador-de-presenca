<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Materias</title>
</head>
<body>
<?php
require_once("../../dbConn.php");
require_once("../../models/usuario.php");
require_once("../../models/materia.php");
?>
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
    
</body>
</html>