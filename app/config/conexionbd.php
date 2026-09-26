<?php

class conexionbd {

    private $host = "localhost";
    private $db   = "GestionTienda";
    private $user = "root";
    private $pass = "";

    private $pdo;

    public function conectar() {

        if ($this->pdo === null) {

            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";

                $opt = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                // 👉 Línea solicitada incluida correctamente
                $this->pdo = new PDO($dsn, $this->user, $this->pass, $opt);
                 
            } catch (PDOException $e) {
                die('Error de conexión BD: ' . $e->getMessage());
            }
        }

        

        return $this->pdo;
    }

    public function cerrar() {
        $this->pdo = null;
    }
}
