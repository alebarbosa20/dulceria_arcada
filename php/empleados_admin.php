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
    <title>Dulcería Arcada | Empleados</title>

    <link rel="icon" href="..//img/logo.png" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="..//css/fonts.css">
    <link rel="stylesheet" href="..//css/inicio_admin.css">
    <link rel="stylesheet" href="..//css/acciones.css">
    
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
                        <li><a class="btn-menu-admin" href="inicio_admin.php">Inicio</a></li>
                        <li><a class="btn-menu-productos" href="productos_admin.php">Productos</a></li>
                        <li><a class="btn-menu-empleados select" href="empleados_admin.php">Empleados</a></li>
                        <?php if ($_SESSION['priv']=="admin"){ ?>
                        <li><a class="btn-menu-usuarios" href="usuarios_admin.php">Usuarios</a></li>
                        <?php } ?>
                        <li><a class="btn-menu-cerrarsesion" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="formulario">
        <form action="acciones_empleados.php" method="post">
            <h3 class="elija">Elija la Opción que desee realizar:</h3>
            <div class="opciones">
                <?php if ($_SESSION['priv']=="admin"){ ?>
                <div class="opciones acciones">
                <input type="radio" name="opcion" id="alta" value="a" required>
                <label for="alta" id="lbl-alta"><img src="..//img/agregar_empleados.png" alt="">Agregar Empleado</label>
                </div>

                <div class="opciones acciones">
                <input type="radio" name="opcion" id="baja" value="b" required>
                <label for="baja" id="lbl-baja"><img src="..//img/eliminar_empleados.png" alt="">Eliminar Empleado</label>
                </div>

                <div class="opciones acciones">
                <input type="radio" name="opcion" id="modificar" value="m" required>
                <label for="modificar" id="lbl-modificar"><img src="..//img/modificar_empleados.png" alt="">Modificar Empleado</label>
                </div>
                <?php } ?>

                <div class="opciones acciones">
                <input type="radio" name="opcion" id="consulta" value="c" required>
                <label for="consulta" id="lbl-consulta"><img src="..//img/consultar_empleados.png" alt="">Consultar Empleados</label>
                </div>
            </div>
            <div class="botones">
                <input class="botones enviar" type="submit" name="enviar" value="Aceptar" id="enviar">
                <input class="botones borrar" type="reset" name="borrar" value="Borrar">
            </div>
            <div class="regresar">
                <a href='inicio_admin.php' class="regresar icon-arrow-left">Regresar</a>
            </div>
        </form>
    </div>
</body>

</html>