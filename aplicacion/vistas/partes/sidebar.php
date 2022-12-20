<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);
    
    @import url(https://fonts.googleapis.com/css?family=Titillium+Web:300);
    
    .fa {
    position: relative;
    display: table-cell;
    width: 80px;
    height: 36px;
    text-align: center;
    vertical-align: middle;
    font-size:40px;
    }

    hr{
        color: white
    }
    .imagen-logo{
        width: 215px;
        height: 75px;
    }
    .main-menu:hover,nav.main-menu.expanded {
    width:220px;
    overflow:visible;
    }

    .main-menu {
    background-color: rgba(0,0,0,0.75);
    border-right:1px solid #e5e5e5;
    position:fixed;
    top:0;
    bottom:0;
    height:100%;
    left:0;
    width:75px;
    overflow:hidden;
    -webkit-transition:width .05s linear;
    transition:width .05s linear;
    -webkit-transform:translateZ(0) scale(1,1);
    z-index:1000;
    }

    .main-menu>ul {
    margin:10px 0;
    }

    .main-menu li {
    position:relative;
    display:block;
    width:250px;
    }

    .main-menu li>a {
    position:relative;
    display:table;
    border-collapse:collapse;
    border-spacing:0;
    color:white;
    font-family: arial;
    font-size: 22px;
    text-decoration:none;
    -webkit-transform:translateZ(0) scale(1,1);
    -webkit-transition:all .1s linear;
    transition:all .1s linear;
    
    }

    .main-menu .nav-icon {
    position:relative;
    display:table-cell;
    width:8px;
    height:3px;
    text-align:center;
    vertical-align:middle;
    font-size:50px;
    }

    .main-menu .nav-text {
    position:relative;
    display:table-cell;
    vertical-align:middle;
    width:2px;
    font-family: 'Titillium Web', sans-serif;
    }

    .main-menu>ul.logout {
    position:absolute;
    left:0;
    bottom:0;
    }

    .no-touch .scrollable.hover {
    overflow-y:hidden;
    }

    .no-touch .scrollable.hover:hover {
    overflow-y:auto;
    overflow:visible;
    }

    a:hover,a:focus {
    text-decoration:none;
    }

    nav ul,nav li {
    margin-top:50px;
    padding:0;
    }

</style>
<nav class="main-menu">
    <ul>
        <li style="margin-top: -5px">
            <a href="<?php echo URL?>tablero">
                <img class="imagen-logo" src="publico/images/logo.PNG" alt=""> 
            </a>
        </li>
          <hr>

        <li>
            <a href="<?php echo URL?>tablero">
                <i class="fa bi bi-house"></i>
                <span class="nav-text">
                    Dashboard
                </span>
            </a>
        </li>
        <section id="usuario">
        <li class="has-subnav">
            <a href="<?php echo URL?>restaurantes">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-houses fa" viewBox="0 0 16 16">
                <path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708L5.793 1Zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207l-4.5-4.5Z"/>
                </svg>
                <span class="nav-text">
                    Restaurantes
                </span>
            </a>
            
        </li>
        <li class="has-subnav">
            <a href="<?php echo URL?>productos">
                <i class="fa bi bi-bag"></i>
                <span class="nav-text">
                    Productos
                </span>
            </a>
        </li>

        <li id="usuarios-bloqueados" class="has-subnav">
            <a href="<?php echo URL?>usuarios">
               <i class="fa bi bi-person"></i>
                <span class="nav-text">
                    Usuarios
                </span>
            </a>
            </li>
        </section>

        <li class="has-subnav">
            <a href="<?php echo URL?>reportes">
                <i class="fa bi-card-checklist"></i>
                <span class="nav-text">
                    Reportes
                </span>
            </a>
        </li>
        
        <?php
            if ($_SESSION["tipo"]=='Usuario') {
                echo 
                '<script>
                    document.querySelector("#usuario").classList.add("d-none");
                </script>';
            }
            if ($_SESSION["tipo"]=='Administrador') {
                echo 
                '<script>
                    document.querySelector("#usuarios-bloqueados").classList.add("d-none");
                </script>';
            }
        ?>
    </ul>

    <ul class="logout">
        <li>
           <a  href="<?php echo URL;?>login/cerrar">
                 <i class="fa bi bi-box-arrow-in-left"></i>
                <span class="nav-text">
                    Salir
                </span>
            </a>
        </li>  
    </ul>
</nav>
