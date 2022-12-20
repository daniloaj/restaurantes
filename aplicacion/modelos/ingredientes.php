<?php
include_once "aplicacion/modelos/db.class.php";
class ingredientes extends BaseDeDatos {

    public function __construct() {
        parent::conectar();
    }

    public function getAll() {
        return $this->executeQuery("SELECT ingredientes.idingrediente, nombre_ingrediente, (select nombre from productos where ingredientes.idproducto= productos.idproducto) as idproducto, costo_adicional from ingredientes");
    } 

    public function save($data) {
        return $this->executeInsert("insert into ingredientes set idproducto='{$data["producto"]}',nombre_ingrediente='{$data["nombre_ingrediente"]}',costo_adicional='{$data["costo"]}'");
    }

    public function getingredientesByName($nombre_ingrediente) {
        return $this->executeQuery("Select * from ingredientes where nombre_ingrediente='{$nombre_ingrediente}'");
    }

    public function getOneingredientes($idingrediente) {
        return $this->executeQuery("SELECT * from ingredientes where idingrediente='{$idingrediente}'");
    }

    public function update($data) {
        return $this->executeInsert("update ingredientes set idproducto='{$data["producto"]}',nombre_ingrediente='{$data["nombre_ingrediente"]}',costo_adicional='{$data["costo"]}' where idingrediente='{$data["idingrediente"]}'");
    }

    public function deleteingredientes($idingrediente) {
        return $this->executeInsert("delete from ingredientes where idingrediente='$idingrediente'");
    }
}