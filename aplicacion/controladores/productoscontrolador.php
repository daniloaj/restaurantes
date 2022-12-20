<?php
include_once "aplicacion/modelos/productos.php";
class productosControlador extends controlador {
    private $productos;
    public function __construct($parametro) {
        $this->productos=new productos();
        parent::__construct("productos",$parametro,true);
    }

    public function getAll() {
        $records=$this->productos->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        $img="";
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto1"]["tmp_name"])) {
                if (($_FILES["foto1"]["type"]=="image/png") 
                || ($_FILES["foto1"]["type"]=="image/jpeg")) {
                    copy($_FILES["foto1"]["tmp_name"], 
                    __DIR__."/../../publico/lugares/".$_FILES["foto1"]["name"]) 
                    or die("No se pudo copiar el archivo");
                    $img=URL."publico/lugares/".$_FILES["foto1"]["name"];
                }
            }
        }
        $img2="";
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto2"]["tmp_name"])) {
                if (($_FILES["foto2"]["type"]=="image/png") 
                || ($_FILES["foto2"]["type"]=="image/jpeg")) {
                    copy($_FILES["foto2"]["tmp_name"], 
                    __DIR__."/../../publico/lugares/".$_FILES["foto2"]["name"]) 
                    or die("No se pudo copiar el archivo");
                    $img2=URL."publico/lugares/".$_FILES["foto2"]["name"];
                }
            }
        }
        $img3="";
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto3"]["tmp_name"])) {
                if (($_FILES["foto3"]["type"]=="image/png") 
                || ($_FILES["foto3"]["type"]=="image/jpeg")) {
                    copy($_FILES["foto3"]["tmp_name"], 
                    __DIR__."/../../publico/lugares/".$_FILES["foto3"]["name"]) 
                    or die("No se pudo copiar el archivo");
                    $img3=URL."publico/lugares/".$_FILES["foto3"]["name"];
                }
            }
        }
        
        if ($_POST["idproducto"]=="0") {
            $datosproductos=$this->productos->getproductosByName($_POST["nombre"]);
                $records=$this->productos->save($_POST,$img,$img2,$img3);
                $info=array('success'=>true,'msg'=>"Registro guardado con exito");
        } else {
            $records=$this->productos->update($_POST,$img,$img2,$img3);
            $info=array('success'=>true,'msg'=>"Registro actualizado con exito");
        }
        echo json_encode($info);
    }

    public function getOneproductos() {
        $records=$this->productos->getOneproductos($_GET["idproducto"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El registro no existe');
        }
        echo json_encode($info);
    }


    public function deleteproductos() {
        $records=$this->productos->deleteproductos($_GET["idproducto"]);
        $info=array('success'=>true,'msg'=>"Registro eliminado con exito");
        echo json_encode($info);
    }
}