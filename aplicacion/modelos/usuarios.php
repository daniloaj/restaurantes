<?php
include_once "aplicacion/modelos/db.class.php";
class usuarios extends BaseDeDatos {

    public function __construct() {
        parent::conectar();
    }  
public function getAllusuarios() {
        return $this->executeQuery("SELECT * FROM usuarios order by id_user");
    }
    public function saveusuarios($data) {
        return $this->executeInsert("insert into usuarios set usuario='{$data["usuarios"]}', password=sha1('{$data["password"]}'), tipo='{$data["tipo"]}'");
    }

    public function getusuariosByName($usuarios) {
        return $this->executeQuery("SELECT * FROM usuarios where usuario='{$usuarios}'");
    }

    public function getOneusuario($id_user) {
        return $this->executeQuery("SELECT * FROM usuarios where id_user='{$id_user}'");
    }

    public function updateusuarios($data) {
        return $this->executeInsert("update usuarios set usuario='{$data["usuarios"]}',password=if('{$data["password"]}'=usuarios.password,usuarios.password,sha1('{$data["password"]}')),tipo='{$data["tipo"]}' where id_user='{$data["id_user"]}'");
    }

    public function deleteusuario($id_user) {
        return $this->executeInsert("delete from usuarios where id_user='$id_user'");
    }
}
