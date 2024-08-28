<?php
class Materia {
    public $id;
    public $nome;
    public $idProfessor;
    public $cargaHoraria;
    public $periodo;
    public $idDiaSemana;
    public $idCurso;
    public $idTurno;

    // Constructor
    public function __construct($nome, $idProfessor = null, $cargaHoraria = null, $periodo = null, $idDiaSemana = null, $idCurso = null, $idTurno = null, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->idProfessor = $idProfessor;
        $this->cargaHoraria = $cargaHoraria;
        $this->periodo = $periodo;
        $this->idDiaSemana = $idDiaSemana;
        $this->idCurso = $idCurso;
        $this->idTurno = $idTurno;
    }
    
    // Create
    static function createMateria($materia) {
        $nome = $materia->nome;
        $idProfessor = $materia->idProfessor;
        $cargaHoraria = $materia->cargaHoraria;
        $periodo = $materia->periodo;
        $idDiaSemana = $materia->idDiaSemana;
        $idCurso = $materia->idCurso;
        $idTurno = $materia->idTurno;

        $sql = "INSERT INTO `Materia` (`nome`, `idProfessor`, `cargaHoraria`, `periodo`, `idDiaSemana`, `idCurso`, `idTurno`) VALUES 
        ('$nome', '$idProfessor', '$cargaHoraria', '$periodo', '$idDiaSemana', '$idCurso', '$idTurno');";
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
    static function updateMateria($materia) {
        $id = $materia->id;
        $nome = $materia->nome;
        $idProfessor = $materia->idProfessor;
        $cargaHoraria = $materia->cargaHoraria;
        $periodo = $materia->periodo;
        $idDiaSemana = $materia->idDiaSemana;
        $idCurso = $materia->idCurso;
        $idTurno = $materia->idTurno;

        $sql = "UPDATE `Materia` SET 
                `nome` = '$nome', 
                `idProfessor` = '$idProfessor',
                `cargaHoraria` = '$cargaHoraria',
                `periodo` = '$periodo',
                `idDiaSemana` = '$idDiaSemana',
                `idCurso` = '$idCurso',
                `idTurno` = '$idTurno'
                WHERE `id` = $id;";
        return DbController::query($sql);
    }

    // Delete
    static function deleteMateria($id) {
        $sql = "DELETE FROM `Materia` WHERE `id` = $id;";
        DbController::query($sql);
        $sql = "UPDATE `Materia` SET 
                `idProfessor` = NULL
                WHERE `id` = $id;";
        return DbController::query($sql);
    }

    // Format human readable
    static function showAllMaterias() {
        $sql = "SELECT Materia.id, Materia.nome, Usuario.nome AS nomeProfessor, Materia.cargaHoraria, Materia.periodo, DiaSemana.nome AS nomeDiaSemana, Curso.nome AS nomeCurso, Turno.nome AS nomeTurno
            FROM Materia
            INNER JOIN Usuario ON Materia.idProfessor = Usuario.id
            INNER JOIN DiaSemana ON Materia.idDiaSemana = DiaSemana.id
            INNER JOIN Curso ON Materia.idCurso = Curso.id
            INNER JOIN Turno ON Materia.idTurno = Turno.id;";
        return DbController::query($sql);
    }
}

?>
