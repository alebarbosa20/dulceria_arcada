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

    $consulta="SELECT id, nombre, descripcion, categoria, precio, existencia  FROM productos WHERE id='$id'";
    $query=mysqli_query($conexion,$consulta);  

?>

<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Dulcería Arcada | Modificar Productos</title>

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
                                <li><a class="btn-menu-productos select" href="productos_admin.php">Productos</a></li>
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
            
          <div class="contenedor">
            <div class="cont">
              <h1>Modificar Producto</h1>
              <div class="form">
                <form class="formulario" method="post" action="modificar2_producto.php">
                <?php while ($fila=mysqli_fetch_array($query)){ ?>
                    <table>
                        <tr class="codigo">
                            <td><label for="codigo">Código de Producto:</label></td>
                            <td><input type="text" placeholder="Código de Producto" name="codigo" value="<?php echo $fila['id'] ?>" disabled></td>
                        </tr>
                        <tr class="nombre">
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" placeholder="Nombre" name="nombre" value="<?php echo $fila['nombre'] ?>" required></td>
                        </tr>
                        <tr class="descrip">
                            <td><label for="descrip">Descripción del Producto:</label></td>
                            <td><textarea placeholder="Descripción" name="descrip" class="descrip-txta" required><?php echo $fila['descripcion'] ?></textarea></td>
                        </tr>
                        <tr class="categ">
                            <td><label for="categ">Categoría:</label></td>
                            <td>
                                <select name="categ" required>
                                    <option value="" disabled> Elija una categoría </option>
                                    <?php if ($fila['categoria']=="chocolates") { ?>
                                        <option value="chocolates" selected>Chocolates</option>
                                        <option value="bombones">Bombones</option>
                                        <option value="paletas">Paletas</option>
                                        <option value="acidos">Ácidos</option>
                                        <option value="chicles">Chicles</option>
                                        <option value="gomitas">Gomitas</option>
                                        <option value="botanas">Botanas</option>
                                    <?php } else if ($fila['categoria']=="bombones"){ ?>
                                        <option value="chocolates">Chocolates</option>
                                        <option value="bombones" selected>Bombones</option>
                                        <option value="paletas">Paletas</option>
                                        <option value="acidos">Ácidos</option>
                                        <option value="chicles">Chicles</option>
                                        <option value="gomitas">Gomitas</option>
                                        <option value="botanas">Botanas</option>
                                    <?php } else if ($fila['categoria']=="paletas"){ ?>
                                        <option value="chocolates">Chocolates</option>
                                        <option value="bombones">Bombones</option>
                                        <option value="paletas" selected>Paletas</option>
                                        <option value="acidos">Ácidos</option>
                                        <option value="chicles">Chicles</option>
                                        <option value="gomitas">Gomitas</option>
                                        <option value="botanas">Botanas</option>
                                    <?php } else if ($fila['categoria']=="acidos"){ ?>
                                        <option value="chocolates">Chocolates</option>
                                        <option value="bombones">Bombones</option>
                                        <option value="paletas">Paletas</option>
                                        <option value="acidos" selected>Ácidos</option>
                                        <option value="chicles">Chicles</option>
                                        <option value="gomitas">Gomitas</option>
                                        <option value="botanas">Botanas</option>
                                    <?php } else if ($fila['categoria']=="chicles"){ ?>
                                        <option value="chocolates">Chocolates</option>
                                        <option value="bombones">Bombones</option>
                                        <option value="paletas">Paletas</option>
                                        <option value="acidos">Ácidos</option>
                                        <option value="chicles" selected>Chicles</option>
                                        <option value="gomitas">Gomitas</option>
                                        <option value="botanas">Botanas</option>
                                    <?php } else if ($fila['categoria']=="gomitas"){ ?>
                                        <option value="chocolates">Chocolates</option>
                                        <option value="bombones">Bombones</option>
                                        <option value="paletas">Paletas</option>
                                        <option value="acidos">Ácidos</option>
                                        <option value="chicles">Chicles</option>
                                        <option value="gomitas" selected>Gomitas</option>
                                        <option value="botanas">Botanas</option>
                                    <?php } else if ($fila['categoria']=="botanas"){ ?>
                                        <option value="chocolates">Chocolates</option>
                                        <option value="bombones">Bombones</option>
                                        <option value="paletas">Paletas</option>
                                        <option value="acidos">Ácidos</option>
                                        <option value="chicles">Chicles</option>
                                        <option value="gomitas">Gomitas</option>
                                        <option value="botanas" selected>Botanas</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="prec">
                            <td><label for="prec">Precio:</label></td>
                            <td><input type="text" name="prec" placeholder="$0.00" value="<?php echo $fila['precio'] ?>" required></td>
                        </tr>
                        <tr class="exis">
                            <td><label for="exis">Existencia:</label></td>
                            <td><input placeholder="1" type="number" name="exis" min="1" max="100000" value="<?php echo $fila['existencia'] ?>" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="botones">
                                <input type="hidden" name="id" value="<?php echo $fila['id'] ?>" required>
                                <input class="botones enviar" type="submit" name="enviar" value="Modificar" id="enviar">
                            </td>
                        </tr>
                        <tr>
                            <td class="regresar" colspan="2">
                                <a href='productos_admin.php' class="regresar icon-arrow-left">Regresar</a>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="tab" value="tab-prod">
                <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>