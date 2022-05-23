<?php
  session_start();
	if(!isset ($_SESSION['user'])){
    header("location:login.php");
  }
	else {
		$us=$_SESSION['user'];
		$priv=$_SESSION['priv'];
  }
  
  require_once("..//conexion.php");

  $ope=$_POST['opcion'];

    if (!$conexion){
        die("Fallo la conexion verifique".mysqli_connect_error());
    }else if ($ope=='c') {
        $consulta=("SELECT id, nombre, descripcion FROM productos");
        $query=mysqli_query($conexion,$consulta);   
?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dulcería Arcada | Consultar Productos </title>

            <link rel="icon" href="..//img/logo.png" type="image/png">

            <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="..//css/fonts.css">
            <link rel="stylesheet" href="..//css/inicio_admin.css">
            <link rel="stylesheet" href="..//css/consultar.css">
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
                <div class="tabla-cont">
                    <h3 class="titulo"> Productos Registrados</h3>

                    <table class="tabla">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th></th>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['id'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['descripcion'] ?></td>
                            <td><a class="consultar icon-search" href = consultar_producto.php?id=<?php echo $columna['id'] ?>> Consultar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <hr>
                    <?php if ($_SESSION['priv']=="admin"){ ?>
                    <a class="reporte" href="reportes_productos.php" target="_blank">Generar reporte</a>
                    <?php } ?>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de productos registrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='productos_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php }else if ($ope=='a') { ?>
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Dulcería Arcada | Agregar Productos</title>

          <link rel="icon" href="..//img/logo.png" type="image/png">

          <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
      
          <link rel="stylesheet" href="..//css/fonts.css">
          <link rel="stylesheet" href="..//css/insertar.css">
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
              <h1>Registro Nuevo Producto</h1>
              <div class="form">
                <form class="formulario" method="post" action="insertar_productos.php">
                    <table>
                        <tr class="codigo">
                            <td><label for="codigo">Código de Producto:</label></td>
                            <td><input type="text" placeholder="Código de Producto" name="codigo" required></td>
                        </tr>
                        <tr class="nombre">
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" placeholder="Nombre" name="nombre" required></td>
                        </tr>
                        <tr class="descrip">
                            <td><label for="descrip">Descripción del Producto:</label></td>
                            <td><textarea placeholder="Descripción" name="descrip" class="descrip-txta" required></textarea></td>
                        </tr>
                        <!-- <tr class="descrip-txta">
                            <td colspan="2"><textarea placeholder="Descripción" name="descrip" required></textarea></td>
                        </tr> -->
                        <tr class="categ">
                            <td><label for="categ">Categoría:</label></td>
                            <td>
                                <select name="categ" required>
                                    <option value="" disabled selected> Elija una categoría </option>
                                    <option value="chocolates">Chocolates</option>
                                    <option value="bombones">Bombones</option>
                                    <option value="paletas">Paletas</option>
                                    <option value="acidos">Ácidos</option>
                                    <option value="chicles">Chicles</option>
                                    <option value="gomitas">Gomitas</option>
                                    <option value="botanas">Botanas</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="prec">
                            <td><label for="prec">Precio:</label></td>
                            <td><input type="text" name="prec" placeholder="0.00" required></td>
                        </tr>
                        <tr class="exis">
                            <td><label for="exis">Existencia:</label></td>
                            <td><input placeholder="1" type="number" name="exis" min="1" max="100000" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="botones">
                                <input class="botones enviar" type="submit" name="enviar" value="Enviar" id="enviar">
                                <input class="botones borrar" type="reset" name="borrar" value="Borrar">
                            </td>
                        </tr>
                        <tr>
                            <td class="regresar" colspan="2">
                                <a href='productos_admin.php' class="regresar icon-arrow-left">Regresar</a>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="tab" value="tab-prod">
                </form>
              </div>
            </div>
          </div>
        </body>
   <?php }else if ($ope=='b') { 
            $consulta=("SELECT id, nombre, descripcion FROM productos");
            $query=mysqli_query($conexion,$consulta);  
    ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dulcería Arcada | Eliminar Productos </title>

            <link rel="icon" href="..//img/logo.png" type="image/png">

            <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="..//css/fonts.css">
            <link rel="stylesheet" href="..//css/inicio_admin.css">
            <link rel="stylesheet" href="..//css/eliminar.css">
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
                <div class="tabla-cont">
                    <h3 class="titulo"> Eliminar Producto</h3>
                    <p>Selecciona el registro que deseas eliminar</p>
                    <table class="tabla">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['id'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['descripcion'] ?></td>
                            <td><a class="borrar icon-delete" href = eliminar_producto.php?id=<?php echo $columna['id'] ?>>Eliminar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de productos encontrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='productos_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php }else if ($ope=='m') { 
            $consulta=("SELECT id, nombre, descripcion FROM productos");
            $query=mysqli_query($conexion,$consulta);  
    ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dulcería Arcada | Actualizar Productos </title>

            <link rel="icon" href="..//img/logo.png" type="image/png">

            <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="..//css/fonts.css">
            <link rel="stylesheet" href="..//css/inicio_admin.css">
            <link rel="stylesheet" href="..//css/modificar.css">
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
                <div class="tabla-cont">
                    <h3 class="titulo"> Actualizar Producto</h3>
                    <p>Selecciona el registro que deseas actualizar</p>
                    <table class="tabla">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['id'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['descripcion'] ?></td>
                            <td><a class="modificar icon-edit" href = modificar_producto.php?id=<?php echo $columna['id'] ?>>Modificar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de productos encontrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='productos_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php } ?>
