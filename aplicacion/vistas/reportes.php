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
<body>
        
        <section id="menu">
            <?php include_once "aplicacion/vistas/partes/sidebar.php";?>
        </section>

            <div style="margin-left: 15%"><section id="contenido">

            <form class="row gy-2 gx-3 align-items-center mt-2 mb-5">

                <div class="col-auto d-flex">
                    <label style="margin-top: 5px" for="desde">Desde:</label>
                    <input type="date" id="desde" name="desde">
                </div>

                <div class="col-auto d-flex">
                    <label style="margin-top: 5px" for="hasta">Hasta:</label>
                    <input type="date" id="hasta" name="hasta">
                </div>

                <div class="col-auto d-flex">
                    <label style="margin-top: 5px" for="restaurante">Restaurantes:</label>
                    <select name="restaurante" id="restaurante" class="form-select">

                    </select>
                </div>

                <div class="col-auto d-flex">
                    <label style="margin-top: 5px" for="producto">Productos:</label>
                    <select name="producto" id="producto" class="form-select">

                    </select>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn btn-primary" id="btnViewReport">Ver Reporte</button>
                </div>
                </form>
            </div>
            <div style="margin-left: 5%">
                <iframe src="" frameborder="0" width="100%" height="600" id="framereporte"></iframe>
            </div>
            
    <?php include_once "aplicacion/vistas/partes/javascript.php";?>
    <script src="<?php echo URL?>publico/customjs/reportes.js">
    </script>
</body>
</html>