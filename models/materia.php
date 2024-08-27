<?php
class Materia {
    public $id;
    public $nome;
    public $idProfessor;

    // Constructor
    public function __construct($nome, $idProfessor = null, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->idProfessor = $idProfessor;
    }
    
    // Create
    static function createMateria($materia) {
        $nome = $materia->nome;
        $idProfessor = $materia->idProfessor;
        $sql = "INSERT INTO `Materia` (`nome`, `idProfessor`) VALUES 
        ('$nome', '$idProfessor');";
        return DbController::query($sql);
    }
    
    // Read (Retrieve a materia by ID)
    static function getMateriaById($id) {
        $sql = "SELECT * FROM `Materia` WHERE `id` = $id;";
        return DbController::query($sql);
    }

    // Read (Retrieve all materias)
    static function getAllMaterias() {
        $sql = "SELECT * FROM `Materia`;";
        return DbController::query($sql);
    }

    // Update
    static function updatemateria($materia) {
        $id = $materia -> id;
        $nome = $materia -> nome;
        $idProfessor = $materia -> idProfessor;
        $sql = "UPDATE `Materia` SET 
                `nome` = '$nome', 
                `idProfessor` = '$idProfessor' 
                WHERE `id` = $id;";
        return DbController::query($sql);
    }

    // Delete
    static function deleteMateria($id) {
        $sql = "DELETE FROM `Materia` WHERE `id` = $id;";
        return DbController::query($sql);
    }

    // Format human readible
    static function showAllMaterias() {
        $sql = "SELECT Materia.id, Materia.nome, Usuario.nome AS nomeProfessor
            FROM Materia
            INNER JOIN Usuario ON Materia.idProfessor = Usuario.id;";
        return DbController::query($sql);
    }


}

?>
