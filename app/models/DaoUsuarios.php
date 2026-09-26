<?php



class DaoUsuarios {

    private $pdo;

    public function __construct() {
        $db = new conexionbd();
        $this->pdo = $db->conectar();
    }

    /* =========================
       REGISTRAR USUARIO
    ========================== */
    public function insertUsuario($email, $password, $idRol) {
        try {
            

            if ($this->emailExiste($email)) {
                return "El correo ya está registrado";
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare(
                "INSERT INTO usuarios (nombre, email, password, idRol)
                 VALUES (:nombre, :email, :password, :idRol)"
            );

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':idRol', $idRol);

            return $stmt->execute();

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /* =========================
       LOGIN / AUTENTICACIÓN
    ========================== */
    public function login($email, $password) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM usuarios WHERE email = :email"
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            unset($usuario['password']); // seguridad
            return $usuario;
        }

        return false;
    }

    /* =========================
       OBTENER TODOS LOS USUARIOS
    ========================== */
    public function selectUsuarios() {
        $stmt = $this->pdo->prepare(
            "SELECT idUsuario, nombre, email, idRol, fechaRegistro
             FROM usuarios
             ORDER BY idUsuario ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
       OBTENER USUARIO POR ID
    ========================== */
    public function selectUsuario($idUsuario) {
        $stmt = $this->pdo->prepare(
            "SELECT idUsuario, nombre, email, idRol, fechaRegistro
             FROM usuarios
             WHERE idUsuario = :id"
        );
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =========================
       OBTENER USUARIO POR EMAIL
    ========================== */
    public function selectUsuarioPorEmail($email) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM usuarios WHERE email = :email"
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =========================
       ACTUALIZAR USUARIO
    ========================== */
   
    public function updateUsuario(int $id, array $data): bool
    {
        $campos = [];
        $params = [':id' => $id];

        if (isset($data['correo'])) {
            $campos[] = 'email = :email';
            $params[':email'] = $data['correo'];
        }

        if (isset($data['id_tipo'])) {
            $campos[] = 'idRol = :idRol';
            $params[':idRol'] = $data['id_tipo'];
        }

        if (isset($data['contrasena'])) {
            $campos[] = 'password = :password';
            $params[':password'] = $data['contrasena'];
        }

        if (isset($data['nombres'])) {
            $campos[] = 'nombre = :nombre';
            $params[':nombre'] = $data['nombres'];
        }
 
        
        if (empty($campos)) {
            return false;
        }

        $sql = "
            UPDATE usuarios
            SET " . implode(', ', $campos) . "
            WHERE idUsuario = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /* =========================
       CAMBIAR CONTRASEÑA
    ========================== */
    public function updatePassword($idUsuario, $passwordHash) {
        

        $stmt = $this->pdo->prepare(
            "UPDATE usuarios SET password = :password WHERE idUsuario = :id"
        );
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /* =========================
       ELIMINAR USUARIO
    ========================== */
    public function deleteUsuario($idUsuario) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM usuarios WHERE idUsuario = :id"
        );
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /* =========================
       VERIFICAR EMAIL EXISTENTE
    ========================== */
    public function emailExiste($email) {
        $stmt = $this->pdo->prepare(
            "SELECT idUsuario FROM usuarios WHERE email = :email"
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

    /**
 * Obtener usuarios por rol
 * @param string $rol ('ADMIN' o 'CLIENTE')
 * @return array
 */
public function selectUsuariosPorRol($idRol) {
    try {
        

        $stmt = $this->pdo->prepare(
            "SELECT idUsuario, nombre, email, idRol, fechaRegistro
             FROM usuarios
             WHERE idRol = :idRol
             ORDER BY nombre ASC"
        );

        $stmt->bindParam(':idRol', $idRol, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return [];
    }
}

public function selectTiposUsuario(){

$sql = "SELECT * FROM roles";

$stmt = $this->pdo->prepare($sql);
$stmt->execute();
return $stmt->fetchAll();

}


    public function __destruct() {
        $this->pdo = null;
    }
}
?>
