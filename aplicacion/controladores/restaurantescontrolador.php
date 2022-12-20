<?php
include_once "aplicacion/modelos/restaurantes.php";
class restaurantesControlador extends controlador {
    private $restaurantes;
    public function __construct($parametro) {
        $this->restaurantes=new restaurantes();
        parent::__construct("restaurantes",$parametro,true);
    }

    public function getAll() {
        $records=$this->restaurantes->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
    public function getAllrestaurantes() {
        $records=$this->restaurantes->getAllrestaurantes();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        $img="";
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                if (($_FILES["foto"]["type"]=="image/png") 
                || ($_FILES["foto"]["type"]=="image/jpeg")) {
                    copy($_FILES["foto"]["tmp_name"], 
                    __DIR__."/../../publico/lugares/".$_FILES["foto"]["name"]) 
                    or die("No se pudo copiar el archivo");
                    $img=URL."publico/lugares/".$_FILES["foto"]["name"];
                }
            }
        }
        if ($_POST["idrestaurante"]=="0") {
            $datosrestaurantes=$this->restaurantes->getrestaurantesByName($_POST["nombre_restaurante"]);
            if (count($datosrestaurantes)>0) {
                $info=array('success'=>false,'msg'=>"El registro ya existe");
            } else {
                $records=$this->restaurantes->save($_POST,$img);
                $info=array('success'=>true,'msg'=>"Registro guardado con exito");
            }
        } else {
            $records=$this->restaurantes->update($_POST,$img);
            $info=array('success'=>true,'msg'=>"Registro guardado con exito");
        }
        echo json_encode($info);
    }

    public function getOnerestaurantes() {
        $records=$this->restaurantes->getOnerestaurantes($_GET["idrestaurante"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El registro no existe');
        }
        echo json_encode($info);
    }

    public function coordenadas() {
        $records=$this->restaurantes->coordenadas($_GET["idrestaurante"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El registro no existe');
        }
        echo json_encode($info);
    }


    public function deleterestaurantes() {
        $records=$this->restaurantes->deleterestaurantes($_GET["idrestaurante"]);
        $info=array('success'=>true,'msg'=>"Registro eliminado con exito");
        echo json_encode($info);
    }
}