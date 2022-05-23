<?php
    session_start();
    if (!isset($_SESSION['user'])) {
		header("location: login.php");
	} else {
        $_SESSION['user'];
        $_SESSION['pass'];
        $_SESSION['priv'];
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dulcería Arcada | Administración </title>

    <link rel="icon" href="..//img/logo.png" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="..//css/fonts.css">
    <link rel="stylesheet" href="..//css/inicio_admin.css">

</head>

<body>
    <header>
        <div class="header-admin">
            <img class="logotipo" href="inicio_admin.php" src="..//img/logo.png" alt="">
            <a href="inicio_admin.php" class="titulo-header">Dulcería Arcada Administración</a>
        </div>
        <div class="menu">
            <div> 
                <input type="checkbox" id="btn-menu">
                <label for="btn-menu"><img class="img-menu" src="..//img/menu.png" alt="btn-menu"></label>

                <nav class="menu-op">
                    <ul class="lista">
                        <li><a class="btn-menu-admin select" href="inicio_admin.php">Inicio</a></li>
                        <li><a class="btn-menu-productos" href="productos_admin.php">Productos</a></li>
                        <li><a class="btn-menu-empleados" href="empleados_admin.php">Empleados</a></li>
                        <?php if ($_SESSION['priv']=="admin"){ ?>
                            <li><a class="btn-menu-usuarios" href="usuarios_admin.php">Usuarios</a></li>
                        <?php } ?>
                        <li><a class="btn-menu-cerrarsesion" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <div>
        <p class="bienvenido"> Bienvenid@ <?php echo $_SESSION['user']; ?></p>
    </div>
    <div class="opciones">
        <div class="op-admin">
            <div class="opcion-productos">
                <a class="btn-admin-productos" href="productos_admin.php">Productos</a>
                <br><a href="productos_admin.php"><img class="icono-productos"  src="..//img/productos_admin.png" alt=""></a>
            </div>
            <div class="opcion-empleados">
                <a class="btn-admin-empleados" href="empleados_admin.php">Empleados</a>
                <br><a href="empleados_admin.php"><img class="icono-empleados" src="..//img/empleados_admin.png" alt=""></a>
            </div>
            <?php if ($_SESSION['priv']=="admin"){ ?>
                <div class="opcion-usuarios">
                    <a class="btn-admin-usuarios" href="usuarios_admin.php">Usuarios </a>
                    <br><a href="usuarios_admin.php"><img class="icono-usuarios"src="..//img/usuarios_admin.png" alt=""></a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>