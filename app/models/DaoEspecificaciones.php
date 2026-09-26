<?php

class DaoEspecificaciones {

    private $db;

    public function __construct() {
        $this->db = (new conexionbd())->conectar();
    }

    /* =====================================================
       DIMENSIONES
       ===================================================== */
    public function listarDimensiones() {

        $sql = "SELECT
                    idDimension,
                    ancho,
                    largo,
                    tiempoExtra,
                    costoExtra
                FROM dimensiones";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       MODELOS
       ===================================================== */
    public function listarModelos() {

        $sql = "SELECT
                    idModelo,
                    descripcion,
                    tiempoExtra,
                    costoExtra
                FROM modelosProductos";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       TEMÁTICAS
       ===================================================== */
    public function listarTematicas() {

        $sql = "SELECT
                    idTematica,
                    descripcion
                FROM tematicasProductos";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       TIPOS DE IMPRESIÓN
       ===================================================== */
    public function listarTiposImpresion() {

        $sql = "SELECT
                    idTipoImpresion,
                    descripcion,
                    tiempoExtra,
                    costoExtra
                FROM tipoImpresionProductos";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       CANTIDAD DE PIEZAS
       ===================================================== */
    public function listarCantidadPiezas() {

        $sql = "SELECT
                    idCantidadPiezas,
                    cantidad,
                    tiempoPorPieza,
                    costoPorPieza
                FROM cantidadPiezasProductos";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       EDAD RECOMENDADA
       ===================================================== */
    public function listarEdadesRecomendadas() {

        $sql = "SELECT
                    erp.idEdadRecomendada,
                    erp.idCantidadPiezas,
                    erp.edadRecomendada,
                    cpp.cantidad
                FROM edadRecomendadProductos erp
                INNER JOIN cantidadPiezasProductos cpp
                    ON erp.idCantidadPiezas = cpp.idCantidadPiezas";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       CANTIDAD DE PIEZAS + EDAD RECOMENDADA
       ===================================================== */
    public function listarCantidadPiezasYEdades() {

        $sql = "SELECT
                    cpp.idCantidadPiezas,
                    cpp.cantidad,
                    cpp.tiempoPorPieza,
                    cpp.costoPorPieza,
                    erp.edadRecomendada
                FROM cantidadPiezasProductos cpp
                INNER JOIN edadRecomendadProductos erp
                    ON cpp.idCantidadPiezas = erp.idCantidadPiezas";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       OBTENER EDAD RECOMENDADA POR CANTIDAD
       ===================================================== */
    public function obtenerEdadPorCantidadPiezas($idCantidadPiezas) {

        $sql = "SELECT
                    edadRecomendada
                FROM edadRecomendadProductos
                WHERE idCantidadPiezas = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idCantidadPiezas]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       OBTENER DATOS PARA CÁLCULO DE PRODUCCIÓN
       ===================================================== */
    public function obtenerDatosProduccion($idProducto, $idDimension, $idModelo, $idTipoImpresion, $idCantidadPiezas) {

        $sql = "SELECT
                    p.tiempoBaseProduccion,
                    p.costoBaseProduccion,

                    d.tiempoExtra AS tiempoDimension,
                    d.costoExtra AS costoDimension,

                    m.tiempoExtra AS tiempoModelo,
                    m.costoExtra AS costoModelo,

                    ti.tiempoExtra AS tiempoImpresion,
                    ti.costoExtra AS costoImpresion,

                    cp.cantidad AS piezas,
                    cp.tiempoPorPieza,
                    cp.costoPorPieza

                FROM productos p
                INNER JOIN dimensiones d ON d.idDimension = ?
                INNER JOIN modelosProductos m ON m.idModelo = ?
                INNER JOIN tipoImpresionProductos ti ON ti.idTipoImpresion = ?
                INNER JOIN cantidadPiezasProductos cp ON cp.idCantidadPiezas = ?
                WHERE p.idProducto = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $idDimension,
            $idModelo,
            $idTipoImpresion,
            $idCantidadPiezas,
            $idProducto
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ===============================
   DIMENSIONES - CRUD
   =============================== */

public function insertarDimension($ancho, $largo, $tiempoExtra, $costoExtra) {

    $sql = "INSERT INTO dimensiones (ancho, largo, tiempoExtra, costoExtra)
            VALUES (?, ?, ?, ?)";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$ancho, $largo, $tiempoExtra, $costoExtra]);
}

public function actualizarDimension($idDimension, $ancho, $largo, $tiempoExtra, $costoExtra) {

    $sql = "UPDATE dimensiones
            SET ancho = ?, largo = ?, tiempoExtra = ?, costoExtra = ?
            WHERE idDimension = ?";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$ancho, $largo, $tiempoExtra, $costoExtra, $idDimension]);
}

public function eliminarDimension($idDimension) {

    $sql = "DELETE FROM dimensiones WHERE idDimension = ?";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$idDimension]);
}

/* ===============================
   MODELOS - CRUD
   =============================== */

public function insertarModelo($descripcion, $tiempoExtra, $costoExtra) {

    $sql = "INSERT INTO modelosProductos (descripcion, tiempoExtra, costoExtra)
            VALUES (?, ?, ?)";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$descripcion, $tiempoExtra, $costoExtra]);
}

public function actualizarModelo($idModelo, $descripcion, $tiempoExtra, $costoExtra) {

    $sql = "UPDATE modelosProductos
            SET descripcion = ?, tiempoExtra = ?, costoExtra = ?
            WHERE idModelo = ?";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$descripcion, $tiempoExtra, $costoExtra, $idModelo]);
}

public function eliminarModelo($idModelo) {

    $sql = "DELETE FROM modelosProductos WHERE idModelo = ?";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$idModelo]);
}


/* ===============================
   TIPOS DE IMPRESIÓN - CRUD
   =============================== */

public function insertarTipoImpresion($descripcion, $tiempoExtra, $costoExtra) {

    $sql = "INSERT INTO tipoImpresionProductos (descripcion, tiempoExtra, costoExtra)
            VALUES (?, ?, ?)";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$descripcion, $tiempoExtra, $costoExtra]);
}

public function actualizarTipoImpresion($idTipoImpresion, $descripcion, $tiempoExtra, $costoExtra) {

    $sql = "UPDATE tipoImpresionProductos
            SET descripcion = ?, tiempoExtra = ?, costoExtra = ?
            WHERE idTipoImpresion = ?";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$descripcion, $tiempoExtra, $costoExtra, $idTipoImpresion]);
}

public function eliminarTipoImpresion($idTipoImpresion) {

    $sql = "DELETE FROM tipoImpresionProductos WHERE idTipoImpresion = ?";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$idTipoImpresion]);
}


/* ===============================
   CANTIDAD DE PIEZAS + EDAD
   =============================== */

public function insertarCantidadPiezas($cantidad, $tiempoPorPieza, $costoPorPieza, $edadRecomendada) {

    try {
        $this->db->beginTransaction();

        // Insert cantidad de piezas
        $sql1 = "INSERT INTO cantidadPiezasProductos
                 (cantidad, tiempoPorPieza, costoPorPieza)
                 VALUES (?, ?, ?)";

        $stmt1 = $this->db->prepare($sql1);
        $stmt1->execute([$cantidad, $tiempoPorPieza, $costoPorPieza]);

        $idCantidadPiezas = $this->db->lastInsertId();

        // Insert edad recomendada
        $sql2 = "INSERT INTO edadRecomendadProductos
                 (idCantidadPiezas, edadRecomendada)
                 VALUES (?, ?)";

        $stmt2 = $this->db->prepare($sql2);
        $stmt2->execute([$idCantidadPiezas, $edadRecomendada]);

        $this->db->commit();
        return true;

    } catch (Exception $e) {
        $this->db->rollBack();
        return false;
    }
}


public function actualizarCantidadPiezas($idCantidadPiezas, $cantidad, $tiempoPorPieza, $costoPorPieza, $edadRecomendada) {

    try {
        $this->db->beginTransaction();

        $sql1 = "UPDATE cantidadPiezasProductos
                 SET cantidad = ?, tiempoPorPieza = ?, costoPorPieza = ?
                 WHERE idCantidadPiezas = ?";

        $stmt1 = $this->db->prepare($sql1);
        $stmt1->execute([$cantidad, $tiempoPorPieza, $costoPorPieza, $idCantidadPiezas]);

        $sql2 = "UPDATE edadRecomendadProductos
                 SET edadRecomendada = ?
                 WHERE idCantidadPiezas = ?";

        $stmt2 = $this->db->prepare($sql2);
        $stmt2->execute([$edadRecomendada, $idCantidadPiezas]);

        $this->db->commit();
        return true;

    } catch (Exception $e) {
        $this->db->rollBack();
        return false;
    }
}


public function eliminarCantidadPiezas($idCantidadPiezas) {

    try {
        $this->db->beginTransaction();

        $sql1 = "DELETE FROM edadRecomendadProductos
                 WHERE idCantidadPiezas = ?";

        $stmt1 = $this->db->prepare($sql1);
        $stmt1->execute([$idCantidadPiezas]);

        $sql2 = "DELETE FROM cantidadPiezasProductos
                 WHERE idCantidadPiezas = ?";

        $stmt2 = $this->db->prepare($sql2);
        $stmt2->execute([$idCantidadPiezas]);

        $this->db->commit();
        return true;

    } catch (Exception $e) {
        $this->db->rollBack();
        return false;
    }
}







}
