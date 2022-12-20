<?php
include_once "aplicacion/modelos/db.class.php";
class productos extends BaseDeDatos {

    public function __construct() {
        parent::conectar();
    }

    public function getAll() {
        return $this->executeQuery("SELECT DISTINCT productos.idproducto, restaurantes.nombre_restaurante,productos.descripcion, productos.nombre, (SELECT IFNULL((SELECT GROUP_CONCAT(ingredientes.nombre_ingrediente) FROM ingredientes WHERE ingredientes.idproducto=productos.idproducto),'N/A')) AS ingredientes, round( (SELECT IFNULL((SELECT sum( ingredientes.costo_adicional)+productos.precio FROM ingredientes WHERE ingredientes.idproducto=productos.idproducto),productos.precio)),2)  as total, productos.precio from restaurantes inner join productos USING(idrestaurante) order by restaurantes.nombre_restaurante");
    } 

    public function save($data, $img,$img2,$img3) {
        return $this->executeInsert("insert into productos set idrestaurante='{$data["restaurante"]}',nombre='{$data["nombre"]}',descripcion='{$data["descripcion"]}', foto1='{$img}', foto2='{$img2}', foto3='{$img3}', precio='{$data["precio"]}'");
    }

    public function getproductosByName($nombre) {
        return $this->executeQuery("Select * from productos where nombre='{$nombre}'");
    }

    public function getOneproductos($idproducto) {
        return $this->executeQuery("SELECT * from productos where idproducto='{$idproducto}'");
    }

    public function update($data,$img,$img2,$img3) {
        return $this->executeInsert("update productos set idrestaurante='{$data["restaurante"]}',nombre='{$data["nombre"]}',descripcion='{$data["descripcion"]}', foto1=if('{$img}'=productos.foto1,productos.foto1,'{$img}'), foto2=if('{$img2}'=productos.foto2,productos.foto2,'{$img2}'), foto3=if('{$img3}'=productos.foto3,productos.foto3,'{$img3}'), precio='{$data["precio"]}' where idproducto='{$data["idproducto"]}'");
    }

    public function deleteproductos($idproducto) {
        return $this->executeInsert("delete from productos where idproducto='$idproducto'");
    }
}