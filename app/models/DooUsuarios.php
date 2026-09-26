<?php

require_once __DIR__ . '/../config/conexionbd.php';

class DaoUsuarios
 {

    private $pdo;

    public function __construct() {
        $db = new conexionbd();
        $this->pdo = $db->conectar();
    }

    /**
     * Registrar un nuevo usuario
     * @param string $nombre
     * @param string $email
     * @param string $password
     * @param string $rol ('ADMIN' o 'CLIENTE')
     * @return bool|string Retorna true si se insertó correctamente o mensaje de error
     */
    public function registrar($nombre, $email, $password, $rol) {
        try {
            // Validar rol
            $rol = strtoupper($rol);
            if (!in_array($rol, ['ADMIN', 'CLIENTE'])) {
                return "Rol inválido. Debe ser ADMIN o CLIENTE.";
            }

            // Verificar si el email ya existe
            $stmt = $this->pdo->prepare("SELECT idusuario FROM usuarios WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->fetch()) {
                return "El correo ya está registrado.";
            }

            // Hashear la contraseña
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insertar usuario
            $stmt = $this->pdo->prepare("
                INSERT INTO usuarios (nombre, email, password, rol)
                VALUES (:nombre, :email, :password, :rol)
            ");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
            $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);

            return $stmt->execute(); // true si se insertó correctamente

        } catch (PDOException $e) {
            return "Error al registrar usuario: " . $e->getMessage();
        }
    }



 public function obtenerUsuarios() {
        try {
            $stmt = $this->pdo->prepare("SELECT idusuario, nombre, email, rol, fecharegistro FROM usuarios ORDER BY idusuario ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna un array asociativo
        } catch (PDOException $e) {
            return []; // Retorna un array vacío en caso de error
        }
    }


    public function obtenerUsuarioPorEmail($email)
{
    $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna el usuario o false si no existe
}




    public function __destruct() {
        $this->pdo = null;
    }
}

?>
