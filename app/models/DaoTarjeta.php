<?php
class DaoTarjeta {

    private $db;

    public function __construct() {
        $cn = new conexionbd();
        $this->db = $cn->conectar();
    }

    public function obtenerTarjeta($numero) {
        $sql = "SELECT * FROM tarjetas_prueba 
                WHERE numero_tarjeta = :numero AND activa = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['numero' => $numero]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function descontarSaldo($idTarjeta, $monto) {
        $sql = "UPDATE tarjetas_prueba 
                SET saldo = saldo - :monto 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'monto' => $monto,
            'id' => $idTarjeta
        ]);
    }
}
?>