<?php
    session_start();

	if(!isset ($_SESSION['user'])){
    header("location:login.php");
    } else {
		$us=$_SESSION['user'];
		$priv=$_SESSION['priv'];
    }
  
    require_once("..//conexion.php");

    $id=$_GET['id'];

    $consulta="SELECT id, nombre, apellidos, telefono, ocupacion, direccion, fecha_nac  FROM empleados WHERE id='$id'";
    $query=mysqli_query($conexion,$consulta);  

?>

<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Dulcería Arcada | Consultar Empleados</title>

          <link rel="icon" href="..//img/logo.png" type="image/png">

          <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
      
          <link rel="stylesheet" href="..//css/fonts.css">
          <link rel="stylesheet" href="..//css/consultar_prod.css">
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
            
          <div class="contenedor">
            <div class="cont">
              <h1>Consultar Empleado</h1>
              <div class="form">
                <form class="formulario" method="post" action="#">
                <?php while ($fila =mysqli_fetch_array($query)){ ?>
                    <table>
                        <tr class="codigo">
                            <td><label for="codigo">ID de Empleado:</label></td>
                            <td><label><?php echo $fila['id'] ?></label></td>
                        </tr>
                        <tr class="nombre">
                            <td><label>Nombre:</label></td>
                            <td><label><?php echo $fila['nombre'] ?></label></td>
                        </tr>
                        <tr class="descrip">
                            <td><label>Apellidos:</label></td>
                            <td><label><?php echo $fila['apellidos'] ?></label></td>
                        </tr>
                        <tr class="categ">
                            <td><label>Teléfono:</label></td>
                            <td><label><?php echo $fila['telefono'] ?></label></td>
                        </tr>
                        <tr class="prec">
                            <td><label>Cargo dentro de la empresa:</label></td>
                            <td><label><?php echo $fila['ocupacion'] ?></label></td>
                        </tr>
                        <tr class="direc">
                            <td><label>Dirección:</label></td>
                            <td><label><?php echo $fila['direccion'] ?></label></td>
                        </tr>
                        <tr class="fecha_nac">
                            <td><label>Fecha de Nacimiento:</label></td>
                            <td><label><?php echo $fila['fecha_nac'] ?></label></td>
                        </tr>
                        <tr>
                            <td class="regresar" colspan="2">
                                <a href='empleados_admin.php' class="regresar icon-arrow-left">Regresar</a>
                            </td>
                        </>
                    </table>
                <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>