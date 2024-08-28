<?php
class Usuario {
    public $id;
    public $senha;
    public $nome;
    public $idFuncao;
    public $email;
    public $telefone;
    public $dataIngresso;
    public $dataNascimento;

    // Constructor
    public function __construct($nome, $idFuncao, $email, $telefone, $dataIngresso, $dataNascimento, $senha = null, $id = null) {
        $this->id = $id;
        $this->senha = $senha;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->dataIngresso = $dataIngresso;
        $this->dataNascimento = $dataNascimento;
        $this->idFuncao = $idFuncao;
    }
    
    // Create
    static function createUsuario($user) {
        $senha = password_hash($user->senha ?? '', PASSWORD_DEFAULT);
        $nome = $user->nome;
        $funcao = $user->idFuncao;
        $email = $user->email;
        $telefone = $user->telefone;
        $dataIngresso = $user->dataIngresso;
        $dataNascimento = $user->dataNascimento;

        $sql = "INSERT INTO `Usuario` (`senha`, `nome`, `idFuncao`, `email`, `telefone`, `dataIngresso`, `dataNascimento`) VALUES 
        ('$senha', '$nome', '$funcao', '$email', '$telefone', '$dataIngresso', '$dataNascimento');";
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
        $sql = "SELECT Usuario.id, Usuario.nome, Usuario.senha, Usuario.email, Usuario.telefone, Usuario.dataIngresso, Usuario.dataNascimento, Funcao.nome AS nomeFuncao
            FROM Usuario
            INNER JOIN Funcao ON Usuario.idFuncao = Funcao.id;";
        return DbController::query($sql);
    }

    // Update
    static function updateUsuario($id, $senha, $nome, $idFuncao, $email, $telefone, $dataIngresso, $dataNascimento) {
        $senha = password_hash($user->senha ?? '', PASSWORD_DEFAULT);
        $sql = "UPDATE `Usuario` SET 
                `senha` = '$senha', 
                `nome` = '$nome', 
                `idFuncao` = '$idFuncao',
                `email` = '$email',
                `telefone` = '$telefone',
                `dataIngresso` = '$dataIngresso',
                `dataNascimento` = '$dataNascimento'
                WHERE `id` = $id;";
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
            ? new Usuario(
                $row->nome, 
                $row->idFuncao, 
                $row->email, 
                $row->telefone, 
                $row->dataIngresso, 
                $row->dataNascimento, 
                $row->senha, 
                $row->id
            ) 
            : null;
    }

    static function getAllProfessores(){
        $sql = "SELECT * FROM `Usuario` where idFuncao = 2;";
        return DbController::query($sql);
    }


}

?>
