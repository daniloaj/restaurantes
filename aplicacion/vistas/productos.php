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
                <h1  class="center">Tabla de productos</h1>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input placeholder="Busca tu producto aqui" type="search" class="form-control" aria-describedby="basic-addon2" id="txtSearch">
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
                    <div class="col-md-6">
                        <a href="<?php echo URL?>ingredientes">
                        <button  class="btn btn-success float-end" id="btningredientes">
                            <i class="bi bi-plus-square-fill"></i>
                            Administrar Ingredientes
                        </button>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button  class="btn btn-success float-end" id="btnAgregar">
                            <i class="bi bi-plus-square-fill"></i>
                            Agregar Productos
                        </button>
                    </div>
                </div>
                <div id="contentTable">
                    <table style="text-align: center" class="table table-hover" id="myTable">
                        <thead>
                            <th>Id <i class="bi bi-arrow-down-up" onclick="sortTable(0, 'int')"></i></th>
                            <th>Producto <i onclick="sortTable(1, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Descripción <i onclick="sortTable(2, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Ingredientes <i onclick="sortTable(3, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Restaurante <i onclick="sortTable(4, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Precio <i onclick="sortTable(5, 'str')" class="bi bi-arrow-down-up"></i></th>
                            <th>Precio mas ingredientes <i onclick="sortTable(6, 'str')" class="bi bi-arrow-down-up"></i></th>
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
                    Productos
                </h1>
                <hr>
                <form id="formproducto" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                        <input type="hidden" name="idproducto" id="idproducto" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="precio" class="col-sm-2 col-form-label">Precio:</label>
                        <div class="col-sm-10">
                        <input type="float" class="form-control" id="precio" name="precio" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="restaurante" class="col-sm-2 col-form-label">Restaurante:</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="restaurante" id="restaurante">
                            <option value="No especificado">Restaurantes</option>
                            <?php
                            // Verificamos la conexión con el servidor y la base de datos
                              $mysqli = new mysqli('localhost', 'danilo', 'asd', 'restaurantes');
                              $query = $mysqli -> query ("SELECT idrestaurante, nombre_restaurante FROM restaurantes ");
                              while ($valores = mysqli_fetch_array($query)) {
                              echo '<option value="'.$valores[idrestaurante].'">'.$valores[nombre_restaurante].'</option>';
                              }
                            ?>                        
                          </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="foto1" class="col-sm-2 col-form-label">Foto 1:</label>
                        <div class="col-sm-10">
                            <div class="img-thumbnail" id="divFoto1" style="width:200px; height:200px;">

                            </div>
                            <span>
                                Haga click para selecionar la foto
                            </span>
                            <input type="file" name="foto1" id="foto1" class="d-none">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="foto2" class="col-sm-2 col-form-label">Foto 2:</label>
                        <div class="col-sm-10">
                            <div class="img-thumbnail" id="divFoto2" style="width:200px; height:200px;">

                            </div>
                            <span>
                                Haga click para selecionar la foto
                            </span>
                            <input type="file" name="foto2" id="foto2" class="d-none">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="foto3" class="col-sm-2 col-form-label">Foto 3:</label>
                        <div class="col-sm-10">
                            <div class="img-thumbnail" id="divFoto3" style="width:200px; height:200px;">

                            </div>
                            <span>
                                Haga click para selecionar la foto
                            </span>
                            <input type="file" name="foto3" id="foto3" class="d-none">
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
    <script src="<?php echo URL?>publico/customjs/producto.js">
    </script>
</body>
</html>