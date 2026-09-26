<?php


class DaoProductos {

    private $cn;

    public function __construct() {
        $this->cn = (new conexionbd())->conectar();
    }

    /* ====================================
       LISTAR PRODUCTOS (ADMIN)
       ==================================== */
    public function listarProductos() {
        $sql = "SELECT p.*, c.descripcion AS categoria
                FROM productos p
                INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                ORDER BY p.nombre";

        return $this->cn->query($sql)->fetchAll();
    }

    /* ====================================
       LISTAR PRODUCTOS ACTIVOS (TIENDA)
       ==================================== */
    public function listarProductosActivos() {
        $sql = "SELECT p.*, c.descripcion AS categoria
                FROM productos p
                INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                WHERE p.activo = 1
                ORDER BY p.nombre";

        return $this->cn->query($sql)->fetchAll();
    }

    /* ====================================
       OBTENER PRODUCTO
       ==================================== */
    public function obtenerProducto($idProducto) {
        $sql = "SELECT * FROM productos WHERE idProducto = ?";
        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$idProducto]);
        return $stmt->fetch();
    }

    public function obtenerProductosXtematica(){

    $sql = "SELECT * FROM productos p
    INNER JOIN tematicasProductos tp ON tp.idTematica = p.idTematica";

    $stmt = $this->cn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();

    }
    /* ====================================
       INSERTAR PRODUCTO
       ==================================== */
    public function insertarProducto($data) {
        $sql = "INSERT INTO productos (idCategoria, idTematica, nombre, descripcion, stock, img, activo)
                VALUES (?,?,?,?,?,?,?)";

        $stmt = $this->cn->prepare($sql);

        return $stmt->execute([
            $data['idCategoria'],
            $data['idTematica'],
            $data['nombre'],
            $data['descripcion'],
            $data['stock'],
            $data['img'],
            $data['activo'] ?? 1
        ]);
    }

    /* ====================================
       ACTUALIZAR PRODUCTO
       ==================================== */
    public function actualizarProducto($data) {
        $sql = "UPDATE productos SET
                    idCategoria = ?,
                    idTematica = ?,
                    nombre = ?,
                    descripcion = ?,
                    stock = ?,
                    img = ?,
                    activo = ?
                WHERE idProducto = ?";

        $stmt = $this->cn->prepare($sql);

        return $stmt->execute([
            $data['idCategoria'],
            $data['idTematica'],
            $data['nombre'],
            $data['descripcion'],
            $data['stock'],
            $data['img'],
            $data['activo'],
            $data['idProducto']
        ]);
    }

    /* ====================================
       ACTIVAR / DESACTIVAR PRODUCTO
       ==================================== */
    public function cambiarEstadoProducto($idProducto, $activo) {
        $sql = "UPDATE productos SET activo = ? WHERE idProducto = ?";
        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([$activo, $idProducto]);
    }

    /* ====================================
       DESCONTAR STOCK
       ==================================== */
    public function descontarStock($idProducto, $cantidad) {
        $sql = "UPDATE productos
                SET stock = stock - ?
                WHERE idProducto = ? AND stock >= ?";

        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([$cantidad, $idProducto, $cantidad]);
    }

    /* ====================================
       ELIMINAR PRODUCTO
       ==================================== */
    public function eliminarProducto($idProducto) {
        $sql = "DELETE FROM productos WHERE idProducto = ?";
        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([$idProducto]);
    }

    /* ====================================
       VALIDAR STOCK
       ==================================== */
    public function validarStock($idProducto, $cantidad) {
        $sql = "SELECT stock FROM productos WHERE idProducto = ?";
        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$idProducto]);
        $producto = $stmt->fetch();

        return $producto && $producto['stock'] >= $cantidad;
    }
}
