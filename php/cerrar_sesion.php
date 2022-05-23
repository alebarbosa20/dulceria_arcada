<?php

    SESSION_START();

    $_SESSION['user'] = "";
    $_SESSION['pass'] = "";

    $mensaje= 'ninguno';

    if ($_SESSION['user'] == "" && $_SESSION['pass'] == ""){
        $mensaje='correcto';
    } else { 
        $mensaje = 'incorrecto';
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Administración | Cerrar Sesión</title>

    <link rel="icon" href="..//img/logo.png" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="..//css/inicio_admin.css">
    <link rel="stylesheet" href="..//css/fonts.css">
    <link rel="stylesheet" href="..//css/normalize.css">
</head>

<body>
    <header>
        <div class="header-admin">
            <a href="inicio_admin.php"><img class="logotipo" src="..//img/logo.png" alt=""></a>
            <p class="titulo-header">Dulcería Arcada Administración</p>
        </div>
        <div class="menu">
            <div>
                <input type="checkbox" id="btn-menu">
                <label for="btn-menu"><img class="img-menu" src="..//img/menu.png" alt="btn-menu"></label>
                <nav class="menu-op">
                    <ul class="lista">
                        <li><a class="btn-menu-admin" href="inicio_admin.php">Inicio</a></li>
                        <li><a class="btn-menu-productos" href="productos.php">Productos</a></li>
                        <li><a class="btn-menu-empleados" href="empleados.php">Empleados</a></li>
                        <li><a class="btn-menu-usuarios" href="usuarios.php">Usuarios</a></li>
                        <li><a class="btn-menu-cerrarsesion select" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
</body>
<?php 
    if($mensaje=='correcto'){
?>
<script>
    function alerta() {
        swal({
            title: "¿Está Seguro De Cerrar Sesión?",
            icon: "warning",
            buttons: true, 
        }).then((logout) => {
            if (logout) {
                swal({
                    title: "Cierre de Sesión Exitoso",
                    icon: "success",
                    button: "Ok",
                }).then(function () {
                    window.location = "login.php";
                });
            } else {
                swal({
                    title: "No Ha Cerrado Sesión",
                    icon: "error",
                    button: "Ok",
                }).then(function () {
                    window.location = "inicio_admin.php";
                });
            }
        });
    }
    alerta();
</script>
<?php
    } else if($mensaje=='incorrecto'){
?>
<script>
    function alerta() {
        swal({
            title: "Cierre de Sesión Incorrecto",
            icon: "error",
            button: "Ok",
        }).then(function () {
            window.location = "inicio_admin.php";
        });
    }
    alerta();
</script>
<?php
    }
?>

</html>