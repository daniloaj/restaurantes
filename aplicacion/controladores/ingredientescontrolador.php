<?php
include_once "aplicacion/modelos/ingredientes.php";
class ingredientesControlador extends controlador {
    private $ingredientes;
    public function __construct($parametro) {
        $this->ingredientes=new ingredientes();
        parent::__construct("ingredientes",$parametro,true);
    }

    public function getAll() {
        $records=$this->ingredientes->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        if ($_POST["idingrediente"]=="0") {
            $datosingredientes=$this->ingredientes->getingredientesByName($_POST["nombre_ingrediente"]);
                $records=$this->ingredientes->save($_POST);
                $info=array('success'=>true,'msg'=>"Registro guardado con exito");
        } else {
            $records=$this->ingredientes->update($_POST);
            $info=array('success'=>true,'msg'=>"Registro actualizado con exito");
        }
        echo json_encode($info);
    }

    public function getOneingredientes() {
        $records=$this->ingredientes->getOneingredientes($_GET["idingrediente"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El registro no existe');
        }
        echo json_encode($info);
    }


    public function deleteingredientes() {
        $records=$this->ingredientes->deleteingredientes($_GET["idingrediente"]);
        $info=array('success'=>true,'msg'=>"Registro eliminado con exito");
        echo json_encode($info);
    }
}