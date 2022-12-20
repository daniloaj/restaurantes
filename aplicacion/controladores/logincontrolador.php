<?php
include_once "aplicacion/modelos/login.php";
class LoginControlador extends controlador {
    private $user;

    public function __construct($parametro) {
        $this->user=new Login();
        parent::__construct("login",$parametro);
    }

    public function validar() {
        $user=$_POST["usuario"] ?? "";
        $pass=$_POST["password"] ?? "";
        $record=$this->user->validarLogin($user,$pass);
        if ($record) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION["id_user"]=$record["id_user"];
            $_SESSION["usuario"]=$record["usuario"];
            $_SESSION["password"]=$record["password"];
            $_SESSION["tipo"]=$record["tipo"];
            if (($record["tipo"]=='Administrador')||($record["tipo"]=='Usuario')||($record["tipo"]=='super usuario')) {
                $info=array("success"=>true,"msg"=>"Usuario valido","url"=>URL."tablero");     
            } else {
                $info=array("success"=>false,"msg"=>"Usuario o contraseña incorrecta");    
            }
            echo json_encode($info);
            }
        }

    public function cerrar() {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        $this->vista->render("login");
    }

}