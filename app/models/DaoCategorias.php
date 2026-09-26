<?php

class DaoCategorias {

    private $cn;

    public function __construct() {
        $this->cn = (new conexionbd())->conectar();
    }

    /* ====================================
       LISTAR CATEGORÍAS
       ==================================== */
    public function listarCategorias() {

        $sql = "SELECT
                    idCategoria,
                    descripcion
                FROM categorias
                ORDER BY descripcion";

        $stmt = $this->cn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ====================================
       OBTENER CATEGORÍA
       ==================================== */
    public function obtenerCategoria($idCategoria) {

        $sql = "SELECT
                    idCategoria,
                    descripcion
                FROM categorias
                WHERE idCategoria = ?";

        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$idCategoria]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ====================================
       INSERTAR CATEGORÍA
       ==================================== */
    public function insertarCategoria($descripcion) {

        $sql = "INSERT INTO categorias (descripcion)
                VALUES (?)";

        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([$descripcion]);
    }

    /* ====================================
       ACTUALIZAR CATEGORÍA
       ==================================== */
    public function actualizarCategoria($idCategoria, $descripcion) {

        $sql = "UPDATE categorias
                SET descripcion = ?
                WHERE idCategoria = ?";

        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([$descripcion, $idCategoria]);
    }

    /* ====================================
       ELIMINAR CATEGORÍA
       ==================================== */
    public function eliminarCategoria($idCategoria) {

        $sql = "DELETE FROM categorias
                WHERE idCategoria = ?";

        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([$idCategoria]);
    }
}
