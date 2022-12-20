<?php
include_once "aplicacion/modelos/usuarios.php";
class usuariosControlador extends controlador {
    private $usuarios;
    public function __construct($parametro) {
        $this->usuarios=new usuarios();
        parent::__construct("usuarios",$parametro,true);
    }
public function deleteusuario() {
        $records=$this->usuarios->deleteusuario($_GET["id_user"]);
        $info=array('success'=>true,'msg'=>"Registro eliminado con exito");
        echo json_encode($info);
    }

    public function getOneusuario() {
        $records=$this->usuarios->getOneusuario($_GET["id_user"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El registro no existe');
        }
        echo json_encode($info);
    }

    public function saveusuarios() {
        if ($_POST["id_user"]=="0") {
            $datosUser=$this->usuarios->getusuariosByName($_POST["usuario"]);
            if (count($datosUser)>0) {
                $info=array('success'=>false,'msg'=>"El usuario ya existe");
            } else {
                $records=$this->usuarios->saveusuarios($_POST);
                $info=array('success'=>true,'msg'=>"Usuario guardado con exito");
            }
        } else {
            $records=$this->usuarios->updateusuarios($_POST);
            $info=array('success'=>true,'msg'=>"Usuario actualizado con exito");
        }
        echo json_encode($info);
    }

    public function getAllusuarios() {
        $records=$this->usuarios->getAllusuarios();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
}