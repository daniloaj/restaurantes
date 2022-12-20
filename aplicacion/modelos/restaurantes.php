<?php
include_once "aplicacion/modelos/db.class.php";
class restaurantes extends BaseDeDatos {

    public function __construct() {
        parent::conectar();
    }

    public function getAll() {
        return $this->executeQuery("SELECT * from restaurantes order by idrestaurante");
    }
    public function getAllrestaurantes() {
        return $this->executeQuery("SELECT * from restaurantes group by nombre_restaurante");
    }

    public function save($data, $img) {
        return $this->executeInsert("insert into restaurantes set nombre_restaurante='{$data["nombre_restaurante"]}',direccion='{$data["direccion"]}', foto='{$img}', telefono='{$data["telefono"]}',contacto='{$data["contacto"]}',fecha_ingreso='{$data["fecha_ingreso"]}', latitud='{$data["latitud"]}',longitud='{$data["longitud"]}'");
    }

    public function getrestaurantesByName($nombre_restaurante) {
        return $this->executeQuery("Select * from restaurantes where nombre_restaurante='{$nombre_restaurante}'");
    }

    public function getOnerestaurantes($idrestaurante) {
        return $this->executeQuery("SELECT * from restaurantes where idrestaurante='{$idrestaurante}'");
    }

    public function update($data,$img) {
        return $this->executeInsert("update restaurantes set nombre_restaurante='{$data["nombre_restaurante"]}',direccion='{$data["direccion"]}', foto=if('{$img}'='',foto,'{$img}'), telefono='{$data["telefono"]}',contacto='{$data["contacto"]}',fecha_ingreso='{$data["fecha_ingreso"]}', latitud='{$data["latitud"]}',longitud='{$data["longitud"]}' where idrestaurante='{$data["idrestaurante"]}'");
    }

    public function deleterestaurantes($idrestaurante) {
        return $this->executeInsert("delete from restaurantes where idrestaurante='$idrestaurante'");
    }
}