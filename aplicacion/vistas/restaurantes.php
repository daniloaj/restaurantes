<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="publico/images/favicon.ico">
    <title>D's Restaurant</title>
    <?php include_once "aplicacion/vistas/partes/css.php";?>
</head>

<body class="pt-4">


    <div style="margin-left: 80px;margin-right: 15px;  margin-top: -30px">
        <section id="menu">
            <?php include_once "aplicacion/vistas/partes/sidebar.php";?>
        </section>
        <section id="contenido">

        <div id="contentList" class="mt-3">
                <h1 class="center">
                    Tabla de Restaurantes                    
                </h1>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input placeholder="Busca tu restaurante aqui" type="search" class="form-control" aria-describedby="basic-addon2" id="txtSearch">
                            <span class="input-group-text" id="basic-addon2">
                                <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com/xfftupfv.json"
                                    trigger="loop"
                                    style="width:25px;height:25px">
                                </lord-icon>
                            </span>
                        </div>
                        
                    </div>
                    <div class="col-md-8">
                        <button  class="btn btn-success float-end" id="btnAgregar">
                            <i class="bi bi-plus-square-fill"></i>
                            Agregar restaurantes
                        </button>
                    </div>
                </div>
                <div id="contentTable">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <th>Id <i class="bi bi-arrow-down-up" onclick="sortTable(0, 'int')"></i></th>
                            <th>Restaurante <i onclick="sortTable(1, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Dirección <i onclick="sortTable(2, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Tel <i onclick="sortTable(3, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Contacto  <i onclick="sortTable(4, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Fecha<i onclick="sortTable(5, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Lat<i onclick="sortTable(6, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Long<i onclick="sortTable(7, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            <td>1</td>
                            <td>Administrador</td>
                            <td>Administrador</td>
                            <td>admin</td>
                            <td>Administrador</td>
                            <td>admin</td>
                            <td>Administrador</td>
                            <td>admin</td>
                            <td>
                                <button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <nav aria-label="Page navigation example">
                        <ul style="margin-top: -40px"class="pagination float-end">
                            <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                        </ul>
                    </nav>
                </div>

                <div style=" height: 50vh;" id="mapa"></div> 

            </div>

            <div id="contentForm" class="d-none mt-3 container">
                <h1 class="center">
                    Agregar Restaurantes                    
                </h1>
                <hr>
                <form id="formrestaurante" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="nombre_restaurante" class="col-sm-1 col-form-label">Nombre:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre_restaurante" name="nombre_restaurante" required>
                        <input type="hidden" name="idrestaurante" id="idrestaurante" value="0">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="direccion" class="col-sm-1 col-form-label">Dirección:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="telefono" class="col-sm-1 col-form-label">Teléfono:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="contacto" class="col-sm-1 col-form-label">Contacto:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="contacto" name="contacto" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="foto" class="col-sm-1 col-form-label">Foto:</label>
                        <div class="col-sm-10">
                            <div class="img-thumbnail" id="divFoto" style="width:200px; height:200px;">

                            </div>
                            <span>
                                Haga click para selecionar la foto
                            </span>
                            <input type="file" name="foto" id="foto" class="d-none">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fecha_ingreso" class="col-sm-1 col-form-label">Fecha de ingreso:</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="latitud" class="col-sm-1 col-form-label">Latitud:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="latitud" name="latitud">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="longitud" class="col-sm-1 col-form-label">Longitud:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="longitud" name="longitud">
                        </div>
                    </div>
                    <h4>
                    Mueva el marcador rojo al lugar donde se encuentra su restaurante:
                    </h4>
                    <div id="map_canvas" style="height:350px">

                    </div>

                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd-fill"></i> Guardar</button>
                </form>
            </div>
        </section>
    </div>
    <script>
        function sortTable(n,type) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        
        table = document.getElementById("myTable");
        switching = true;
        dir = "asc";
        
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if ((type=="str" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) || (type=="int" && parseFloat(x.innerHTML) > parseFloat(y.innerHTML))) {
                shouldSwitch= true;
                break;
                }
            } else if (dir == "desc") {
                if ((type=="str" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) || (type=="int" && parseFloat(x.innerHTML) < parseFloat(y.innerHTML))) {
                shouldSwitch = true;
                break;
                }
            }
            }
            if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
            } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
            }
        }
        }
    </script>
    <?php include_once "aplicacion/vistas/partes/javascript.php";?>
    <script src="<?php echo URL?>publico/customjs/restaurant.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6c7Y0K8KWvA8IJg1ZDNDNlsJ1ixEDmNg"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6c7Y0K8KWvA8IJg1ZDNDNlsJ1ixEDmNg&callback=initMap"></script>

    <script type="text/javascript">
      function initMap() {
          var map;
          var bounds = new google.maps.LatLngBounds();
          var mapOptions = {
              mapTypeId: 'roadmap'
          };

          map = new google.maps.Map(document.querySelector("#mapa"), {
              mapOptions
          });

          map.setTilt(50);

          // Crear múltiples marcadores desde la Base de Datos 
          var marcadores = [
              <?php include('aplicacion/vistas/php/marcadores.php'); ?>
          ];

          // Creamos la ventana de información para cada Marcador
          var ventanaInfo = [
              <?php include('aplicacion/vistas/php/info_marcadores.php'); ?>
          ];

          // Creamos la ventana de información con los marcadores 
          var mostrarMarcadores = new google.maps.InfoWindow(),
              marcadores, i;

          // Colocamos los marcadores en el Mapa de Google 
          for (i = 0; i < marcadores.length; i++) {
              var position = new google.maps.LatLng(marcadores[i][1], marcadores[i][2]);
              bounds.extend(position);
              marker = new google.maps.Marker({
                  position: position,
                  map: map,
                  title: marcadores[i][0]
              });

              // Colocamos la ventana de información a cada Marcador del Mapa de Google 
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                      mostrarMarcadores.setContent(ventanaInfo[i][0]);
                      mostrarMarcadores.open(map, marker);
                  }
              })(marker, i));

              // Centramos el Mapa de Google para que todos los marcadores se puedan ver 
              map.fitBounds(bounds);
          }

          // Aplicamos el evento 'bounds_changed' que detecta cambios en la ventana del Mapa de Google, también le configramos un zoom de 14 
          var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
              this.setZoom(9);
              google.maps.event.removeListener(boundsListener);
          });

      }

      // Lanzamos la función 'initMap' para que muestre el Mapa con Los Marcadores y toda la configuración realizada 
      google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    
    <script>
        var vMarker;
        var map;

            map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 9,
                center: new google.maps.LatLng(14.022758, -89.326379),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(14.022758, -89.326379),
                draggable: true
            });
            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#latitud").val(evt.latLng.lat().toFixed(6));
                $("#longitud").val(evt.latLng.lng().toFixed(6));

                map.panTo(evt.latLng);
            });
            map.setCenter(vMarker.position);
            vMarker.setMap(map);

            function movePin() {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                "address": inputAddress
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    vMarker.setPosition(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                    map.panTo(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                    $("#latitud").val(results[0].geometry.location.lat());
                    $("#longitud").val(results[0].geometry.location.lng());
                }

            });
        }
        </script>
</body>
</html>