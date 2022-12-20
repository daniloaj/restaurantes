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


    <div class="container">
        <section id="menu">
            <?php include_once "aplicacion/vistas/partes/sidebar.php";?>
        </section>
        <section id="contenido">

        <div id="contentList" class="mt-3">
                <h1  class="center">Tabla de ingredientes</h1>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input placeholder="Busca tu ingrediente aqui" type="search" class="form-control" aria-describedby="basic-addon2" id="txtSearch">
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
                            Agregar ingredientes
                        </button>
                    </div>
                </div>
                <div id="contentTable">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <th>Id <i class="bi bi-arrow-down-up" onclick="sortTable(0, 'int')"></i></th>
                            <th>ingrediente <i onclick="sortTable(1, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Producto <i onclick="sortTable(2, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Coste del ingrediente <i onclick="sortTable(3, 'str')" class="bi bi-arrow-down-up"></i></th>
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
                            <td>
                                <button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination float-end">
                            <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div id="contentForm" class="d-none mt-3">
                <h1 class="center">
                    ingredientes
                </h1>
                <hr>
                <form id="formingrediente" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="nombre_ingrediente" class="col-sm-2 col-form-label">Nombre ingrediente:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre_ingrediente" name="nombre_ingrediente" required>
                        <input type="hidden" name="idingrediente" id="idingrediente" value="0">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="producto" class="col-sm-2 col-form-label">Producto:</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="producto" id="producto">
                            <option value="No especificado">Productos</option>
                            <?php
                            // Verificamos la conexión con el servidor y la base de datos
                              $mysqli = new mysqli('localhost', 'danilo', 'asd', 'restaurantes');
                              $query = $mysqli -> query ("SELECT idproducto, nombre FROM productos ");
                              while ($valores = mysqli_fetch_array($query)) {
                              echo '<option value="'.$valores[idproducto].'">'.$valores[nombre].'</option>';
                              }
                            ?>                        
                          </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="costo" class="col-sm-2 col-form-label">Costo:</label>
                        <div class="col-sm-10">
                        <input type="float" class="form-control" id="costo" name="costo" required>
                        </div>
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
    <script src="<?php echo URL?>publico/customjs/ingrediente.js">
    </script>
</body>
</html>