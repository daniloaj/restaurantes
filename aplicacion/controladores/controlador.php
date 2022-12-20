<?php
require_once "aplicacion/vistas/vista.php";
class controlador {
    public $vista;
    public function __construct($vista,$parametro,$validar=false){
        $this->vista=new Vista();
        if ($validar) {
            if (!isset($_SESSION)) {
                session_start();
            }
            if (!isset($_SESSION["id_user"])) {
                $this->vista->render("login");
                return;
            }
        }
        if (empty($parametro)) {
            $this->vista->render($vista);
            return;
        }
        if (method_exists($this,$parametro)) {
            $this->$parametro();
        } else {
            echo "Error";
        }
    }
}