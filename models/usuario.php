<?php
class Usuario {
    public $id;
    public $senha;
    public $nome;
    public $idFuncao;

    // Constructor
    public function __construct($nome, $idFuncao, $senha = null, $id = null) {
        $this->id = $id;
        $this->senha = $senha;
        $this->nome = $nome;
        $this->idFuncao = $idFuncao;
    }
    
    // Create
    static function createUsuario($user) {
        $senha = password_hash($user->senha ?? '', PASSWORD_DEFAULT);
        $nome = $user->nome;
        $funcao = $user->idFuncao;
        $sql = "INSERT INTO `Usuario` (`senha`, `nome`, `idFuncao`) VALUES 
        ('$senha', '$nome', '$funcao');";
        return DbController::query($sql);
    }
    
    // Read (Retrieve a user by ID)
    static function getUsuarioById($id) {
        $sql = "SELECT * FROM `Usuario` WHERE `id` = $id;";
        return DbController::query($sql);
    }

    // Read (Retrieve all users)
    static function getAllUsuarios() {
        $sql = "SELECT * FROM `Usuario`;";
        return DbController::query($sql);
    }

    // Format human readible
    static function showAllUsuarios() {
        $sql = "SELECT Usuario.id, Usuario.nome, Usuario.senha, Funcao.nome AS nomeFuncao
            FROM Usuario
            INNER JOIN Funcao ON Usuario.idFuncao = Funcao.id;";
        return DbController::query($sql);
    }

    // Update
    static function updateUsuario($id, $senha, $nome, $idFuncao) {
        $senha = password_hash($user->senha ?? '', PASSWORD_DEFAULT);
        $sql = "UPDATE `Usuario` SET 
                `senha` = '$senha', 
                `nome` = '$nome', 
                `idFuncao` = '$idFuncao' 
                WHERE `idUsuario` = $id;";
        return DbController::query($sql);
    }

    // Delete
    static function deleteUsuario($id) {
        $sql = "DELETE FROM `Usuario` WHERE `id` = $id;";
        return DbController::query($sql);
    }

    // Login
    static function login($id, $senha) {
        $sql = "SELECT * FROM `Usuario` WHERE `id` = '$id';";
        $query = DbController::query($sql);
        $row = $query -> fetch_object();
        return password_verify($senha, $row -> senha) 
            ? new Usuario($row -> nome, $row -> idFuncao) 
            : null;
    }

    static function getAllProfessores(){
        $sql = "SELECT * FROM `Usuario` where idFuncao = 2;";
        return DbController::query($sql);
    }


}

?>
