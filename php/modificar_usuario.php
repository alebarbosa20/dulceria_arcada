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

    $consulta="SELECT idusuarios, nombre, correo, usuario, password, privilegio FROM usuarios WHERE idusuarios='$id'";
    $query=mysqli_query($conexion,$consulta);  

?>

<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Dulcería Arcada | Modificar Usuario</title>

          <link rel="icon" href="..//img/logo.png" type="image/png">

          <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
      
          <link rel="stylesheet" href="..//css/fonts.css">
          <link rel="stylesheet" href="..//css/modificar_registro.css">
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
                                <li><a class="btn-menu-empleados" href="empleados_admin.php">Empleados</a></li>
                                <?php if ($_SESSION['priv']=="admin"){ ?>
                                    <li><a class="btn-menu-usuarios select" href="usuarios_admin.php">Usuarios</a></li>
                                <?php } ?>
                                <li><a class="btn-menu-cerrarsesion" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
            
          <div class="contenedor">
            <div class="cont">
              <h1>Modificar Usuario</h1>
              <div class="form">
                <form class="formulario" method="post" action="modificar2_usuario.php">
                <?php while ($fila=mysqli_fetch_array($query)){ ?>
                    <table>
                        <tr class="codigo">
                            <td><label for="id">ID de Usuario:</label></td>
                            <td><input type="text" name="id" value="<?php echo $fila['idusuarios'] ?>" disabled></td>
                        </tr>
                        <tr class="nombre">
                            <td><label>Nombre:</label></td>
                            <td><input type="text" placeholder="Nombre" name="nombre" value="<?php echo $fila['nombre'] ?>" required></td>
                        </tr>
                        <tr class="apellidos">
                            <td><label>Correo:</label></td>
                            <td><input type="text" placeholder="Correo" name="correo" value="<?php echo $fila['correo'] ?>" required></td>
                        </tr>
                        <tr class="telefono">
                            <td><label>Usuario:</label></td>
                            <td><input type="text" placeholder="Usuario" name="usuario" value="<?php echo $fila['usuario'] ?>" required></td>
                        </tr>
                        <tr class="cargo">
                            <td><label>Contraseña:</label></td>
                            <td><input type="password" placeholder="Contraseña" name="pass" value="<?php echo $fila['password'] ?>" required></td>
                        </tr>
                        <tr class="direc">
                            <td><label>Privilegio:</label></td>
                            <td>
                                <select name="privi" value="<?php echo $fila['privilegio'] ?>" required>
                                    <?php 
                                    if ($fila['privilegio']=="admin") { ?>
                                        <option value="" disabled > Elija un privilegio </option>
                                        <option value="admin" selected>Administrador</option>
                                        <option value="estandar">Estándar</option>
                                    <?php
                                    } else if ($fila['privilegio']=="estandar") { ?>
                                        <option value="" disabled > Elija un privilegio </option>
                                        <option value="admin">Administrador</option>
                                        <option value="estandar"selected>Estándar</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="botones">
                                <input type="hidden" name="id" value="<?php echo $fila['idusuarios'] ?>" required>
                                <input class="botones enviar" type="submit" name="enviar" value="Modificar" id="enviar">
                            </td>
                        </tr>
                        <tr>
                            <td class="regresar" colspan="2">
                                <a href='usuarios_admin.php' class="regresar icon-arrow-left">Regresar</a>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="tab" value="tab-empl">
                <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>