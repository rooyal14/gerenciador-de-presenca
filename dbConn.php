<?php
    class DbController {
        static function query($sql) {
            // Inicializa conexão
            $conn = new mysqli('localhost', 'root', '', 'faculdade_db');
    
            // Verificar a conexão
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // Realiza query
            $result = $conn->query($sql);

            // Fechar a conexão
            $conn->close();

            return $result;
        }

        
    }
    

?>