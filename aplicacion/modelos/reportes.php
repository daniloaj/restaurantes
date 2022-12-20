<?php
include_once "aplicacion/modelos/db.class.php";
class reportes extends BaseDeDatos {

    public function __construct() {
        parent::conectar();
    } 

    public function getReportes($data) {
        $condicion="";
        if ($data["desde"]!="") {
            $condicion.="and fecha_ingreso>='{$data["desde"]}'";
        }
        if ($data["hasta"]!="") {
            $condicion.=" and fecha_ingreso<='{$data["hasta"]}'";
        }
        if ($data["restaurante"]!="0") {
            $condicion.=" and nombre_restaurante='{$data["restaurante"]}'";
        }
        if ($data["producto"]!="0") {
            $condicion.=" and nombre='{$data["producto"]}'";
        }
        return $this->executeQuery("SELECT DISTINCT restaurantes.nombre_restaurante,restaurantes.fecha_ingreso, productos.nombre, (SELECT IFNULL((SELECT GROUP_CONCAT(ingredientes.nombre_ingrediente) FROM ingredientes WHERE ingredientes.idproducto=productos.idproducto),'N/A')) AS ingredientes, round( (SELECT IFNULL((SELECT sum( ingredientes.costo_adicional)+productos.precio FROM ingredientes WHERE ingredientes.idproducto=productos.idproducto),productos.precio)),2)  as total from restaurantes, productos where productos.idrestaurante=restaurantes.idrestaurante and 1=1 $condicion order by restaurantes.nombre_restaurante");
    }
}