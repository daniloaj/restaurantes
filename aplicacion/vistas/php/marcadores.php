<?php

  // Archivo de Conexión a la Base de Datos 
  include('aplicacion/vistas/php/conexion.php');

  // Listamos las direcciones con todos sus datos (lat, lng, dirección, etc.)
  $result = mysqli_query($con, "SELECT * FROM restaurantes");

  // Seleccionamos los datos para crear los marcadores en el Mapa de Google serian direccion, lat y lng 
  while ($row = mysqli_fetch_array($result)) {
      echo '["' . $row['nombre_restaurante'] . ', ' . $row['direccion'] . '", ' . $row['latitud'] . ', ' . $row['longitud'] . '],';
  }
?>
