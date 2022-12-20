<?php
define('URL','/restaurantes/');
require_once "aplicacion/controladores/errorcontrolador.php";
require_once "aplicacion/controladores/controlador.php";
$url=$_GET["action"] ?? null;
$url=rtrim($url,'/');
$url=explode("/",$url);
if (empty($url[0])) {
    $archivoControlador='aplicacion/controladores/login';
    $url[0]="login";
} else {
    $archivoControlador="aplicacion/controladores/{$url[0]}";
}
$archivoControlador.="controlador.php";
if (file_exists($archivoControlador)) {
    require_once $archivoControlador;
    $url[0].="controlador";
    $parametro=$url[1] ?? "";
    $controlador = new $url[0]($parametro);
} else {
    $controlador = new ErrorControlador();
}