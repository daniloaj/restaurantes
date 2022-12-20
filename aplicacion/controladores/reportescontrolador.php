<?php
//llamamos las funciones de reportes en los modelos y de autoload en vendor
include_once "aplicacion/modelos/reportes.php";
include_once "vendor/autoload.php";
class reportescontrolador extends controlador {
    private $reporte;
    //Metodo constructor
    public function __construct($parametro) {
        $this->reporte=new reportes();
        parent::__construct("reportes",$parametro,true);
    }
    //creamos el reporte en pdf
        public function getReporte() {
            $registros=$this->reporte->getReportes($_GET);
           
            //creamos el encabezado
            $htmlheader="<img src='publico/images/logo.PNG' width='150px'>";
            $htmlheader.="<h3>Reporte general</h3>";
            $html="<table style='text-align: center;' width='100%' border=1><thead><tr>";
           
            //creamos los campos que se mostrarán
            $html.="<th>N°</th>";
            $html.="<th>Restaurantes</th>";
            $html.="<th>Fecha de ingreso</th>";
            $html.="<th>Productos</th>";
            $html.="<th>Ingredientes</th>";
            $html.="<th>Precio</th>";
            $html.="</tr></thead><tbody>";
           
            //se llaman los datos de la bd que aparecerán en la tabla
            foreach ($registros as $key => $value) {
                $html.="<tr>";
                $html.="<td>".($key+1)."</td>";
                $html.="<td>{$value["nombre_restaurante"]}</td>";
                $html.="<td>{$value["fecha_ingreso"]}</td>";
                $html.="<td>{$value["nombre"]}</td>";
                $html.="<td>{$value["ingredientes"]}</td>";
                $html.="<td>"."$"."{$value["total"]}</td>";
                $html.="</tr>";
            }
            $html.="</tbody></table>";
            $html.="<br>";
            //configuración del formato pdf
            $mpdfConfig=array(
                'mode'=>'utf-8',
                'format'=>'Letter',
                'default_font_size'=>0,
                'default_font'=>'',
                'margin_left'=>10,
                'margin_right'=>10,
                'margin_top'=>40,
                'margin_header'=>10,
                'margin_footer'=>20,
                'orientation'=>'P',
            );
            $mpdf= new \Mpdf\Mpdf($mpdfConfig);
            $mpdf->SetHTMLHeader($htmlheader);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
    }