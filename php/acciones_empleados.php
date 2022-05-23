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
        $consulta="SELECT id, nombre, apellidos FROM empleados";
        $query=mysqli_query($conexion,$consulta);  
?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dulcería Arcada | Consultar Empleados </title>

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
                <div class="tabla-cont">
                    <h3 class="titulo"> Empleados Registrados</h3>

                    <table class="tabla">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th></th>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['id'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['apellidos'] ?></td>
                            <td><a class="consultar icon-search" href = consultar_empleado.php?id=<?php echo $columna['id'] ?>> Consultar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <hr>
                    <?php if ($_SESSION['priv']=="admin"){ ?>
                    <a class="reporte" href="reportes_empleados.php" target="_blank">Generar reporte</a>
                    <?php } ?>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de empleados registrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='empleados_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php }else if ($ope=='a') { ?>
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Dulcería Arcada | Agregar Empleados</title>

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
              <h1>Registro Nuevo Empleado</h1>
              <div class="form">
                <form class="formulario" method="post" action="insertar_empleado.php">
                    <table>
                        <tr class="nombre">
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" placeholder="Nombre" name="nombre" required></td>
                        </tr>
                        <tr class="apellidos">
                            <td><label for="descrip">Apellidos:</label></td>
                            <td><input type="text" placeholder="Apellidos" name="apellidos" required></td>
                        </tr>
                        <tr class="telefono">
                            <td><label for="tel">Teléfono:</label></td>
                            <td><input type="text" placeholder="Teléfono" name="tel" required></td>
                        </tr>
                        <tr class="cargo">
                            <td><label for="cargo">Cargo dentro de la empresa:</label></td>
                            <td><input type="text" placeholder="Cargo" name="cargo" required></td>
                        </tr>
                        <tr class="direc">
                            <td><label for="direc">Dirección:</label></td>
                            <td><textarea placeholder="Dirección" name="direc" class="descrip-txta" required></textarea></td>
                        </tr>
                        <tr class="nac">
                            <td><label for="nac">Fecha de Nacimiento:</label></td>
                            <td><input type="date" name="nac" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="botones">
                                <input class="botones enviar" type="submit" name="enviar" value="Enviar" id="enviar">
                                <input class="botones borrar" type="reset" name="borrar" value="Borrar">
                            </td>
                        </tr>
                        <tr>
                            <td class="regresar" colspan="2">
                                <a href='empleados_admin.php' class="regresar icon-arrow-left">Regresar</a>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="tab" value="tab-empl">
                </form>
              </div>
            </div>
          </div>
        </body>
   <?php }else if ($ope=='b') { 
            $consulta=("SELECT id, nombre, apellidos FROM empleados");
            $query=mysqli_query($conexion,$consulta);  
    ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dulcería Arcada | Eliminar Empleados </title>

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
                <div class="tabla-cont">
                    <h3 class="titulo"> Eliminar Empleado</h3>
                    <p>Selecciona el registro que deseas eliminar</p>
                    <table class="tabla">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th></th>
                        </tr>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['id'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['apellidos'] ?></td>
                            <td><a class="borrar icon-delete" href = eliminar_empleado.php?id=<?php echo $columna['id'] ?>>Eliminar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de empleados encontrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='empleados_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php } else if ($ope=='m') { 
            $consulta=("SELECT id, nombre, apellidos FROM empleados");
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
                <div class="tabla-cont">
                    <h3 class="titulo"> Actualizar Empleado</h3>
                    <p>Selecciona el registro que deseas actualizar</p>
                    <table class="tabla">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th></th>
                        </tr>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['id'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['apellidos'] ?></td>
                            <td><a class="modificar icon-edit" href = modificar_empleado.php?id=<?php echo $columna['id'] ?>>Modificar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de empleados encontrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='empleados_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php } ?>
