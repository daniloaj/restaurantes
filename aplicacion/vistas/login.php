<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="shortcut icon" href="<?php echo URL?>publico/images/logo d.PNG">
  <link rel="stylesheet" href="<?php echo URL?>publico/css/bootstrap.min.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
  <?php include_once "aplicacion/vistas/partes/css.php" ?>
  <title>D's restaurant</title>
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>
<body class="text-center body" style="background-image: url(https://images5.alphacoders.com/650/650970.jpg); background-size: 100% ">
    <main class="form-signin">
      <form action="login" id="formlogin" method="post">
        <img style="border-radius: 30px" src="<?php echo URL?>publico/images/logo d.PNG" alt="" width="150px">
        <h1 style="color: white">D's restaurant</h1><hr>

        <div class="form-floating">
          <input name="usuario" type="text" class="form-control" id="floatingInput" placeholder="Usuario">
          <label for="floatingInput">Usuario</label>
        </div>
        <br>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Contraseña</label>
    </div>

    <div class="alert alert-danger d-none mt-3" role="alert" id="mensaje">
      Mensaje
    </div>
    <br>

    <button class="w-100 btn-lg btn-light" type="submit">Iniciar Sesion</button>
  </form>
</main>
    <script src="<?php echo URL?>publico/customjs/api.js"></script>
    <script src="<?php echo URL?>publico/customjs/login.js"></script>
  </body>
</html>