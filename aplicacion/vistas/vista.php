<?php
class Vista {
    public function render($vista){
        require_once "aplicacion/vistas/$vista.php";
    }
}