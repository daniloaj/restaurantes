<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="publico/images/microscopio.png">
    <link rel="stylesheet" href="<?php echo URL?>publico/css/bootstrap.min.css">
    <?php include_once "aplicacion/vistas/partes/css.php" ?>
    <title>D's restaurant</title>
</head>
<body style="background-image: url(https://images5.alphacoders.com/650/650970.jpg); background-size: 100%">
    

        <section>
            <?php include_once "aplicacion/vistas/partes/sidebar.php"?>
        </section>

    <div id="usuario-normal" class="container">
        <div class="row">
            <div class="cuadrito ">
                <h2>
                    Restaurantes:
                    <?php
                        $mysqli = new mysqli('localhost', 'danilo', 'asd', 'restaurantes');
                        $query = $mysqli -> query ("SELECT count(nombre_restaurante) as 'restaurantes' FROM restaurantes ");
                        $valores = mysqli_fetch_array($query);
                        echo $valores['restaurantes'];
                    ?>
                </h2><hr>
                <p>
                    Aquí puedes ir a la administración de los restaurantes y localizarlos. 
                </p>
                <a href="<?php echo URL?>restaurantes">
                    <button class="btn btn-outline-light"> Ver restaurantes</button>
                </a>

            </div>
            <div class="cuadrito">
                <h2>
                    Productos:
                    <?php
                        $mysqli = new mysqli('localhost', 'danilo', 'asd', 'restaurantes');
                        $query = $mysqli -> query ("SELECT count(nombre) as 'productos' FROM productos ");
                        $valores = mysqli_fetch_array($query);
                        echo $valores['productos'];
                    ?>
                </h2><hr>
                <p>
                    Aquí puedes ir a la administración de los productos y asignarle ingredientes. 
                </p>
                <a href="<?php echo URL?>productos">
                    <button class="btn btn-outline-light"> Ver productos</button>
                </a>
            </div>
        </div>
            <div id="usuarios" class="cuadrito">
                <h2>
                    Usuarios:
                    <?php
                        $mysqli = new mysqli('localhost', 'danilo', 'asd', 'restaurantes');
                        $query = $mysqli -> query ("SELECT count(usuario) as 'usuarios' FROM usuarios ");
                        $valores = mysqli_fetch_array($query);
                        echo $valores['usuarios'];
                    ?>
                </h2><hr>
                <p>
                    Aquí puedes ir a la administración de los usuarios y asignarle el tipo de usuario. 
                </p>
                <a href="<?php echo URL?>usuarios">
                    <button class="btn btn-outline-light"> Ver usuarios</button>
                </a>
            </div>
            <?php
            if ($_SESSION["tipo"]=='Usuario') {
                echo 
                '<script>
                    document.querySelector("#usuario-normal").classList.add("d-none");
                </script>';
            }
            if ($_SESSION["tipo"]=='Administrador') {
                echo 
                '<script>
                    document.querySelector("#usuarios").classList.add("d-none");
                </script>';
            }
        ?>
        </div>
    <?php include_once "aplicacion/vistas/partes/javascript.php" ?>
</body>
</html>