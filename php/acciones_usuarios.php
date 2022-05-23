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
        $consulta="SELECT idusuarios, nombre, usuario, privilegio FROM usuarios";
        $query=mysqli_query($conexion,$consulta);  
?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dulcería Arcada | Consultar Usuarios </title>
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
                <div class="tabla-cont">
                    <h3 class="titulo"> Usuarios Registrados</h3>

                    <table class="tabla">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Privilegio</th>
                        <th></th>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['idusuarios'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['usuario'] ?></td>
                            <td><?php echo $columna['privilegio'] ?></td>
                            <td><a class="consultar icon-search" href = consultar_usuario.php?id=<?php echo $columna['idusuarios'] ?>> Consultar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <hr>
                    <?php if ($_SESSION['priv']=="admin"){ ?>
                    <a class="reporte" href="reportes_usuarios.php" target="_blank">Generar reporte</a>
                    <?php } ?>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de usuarios registrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='usuarios_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php }else if ($ope=='a') { ?>
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Dulcería Arcada | Agregar Usuarios</title>

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
              <h1>Registro Nuevo Usuario</h1>
              <div class="form">
                <form class="formulario" method="post" action="insertar_usuario.php">
                    <table>
                        <tr class="nombre">
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" placeholder="Nombre" name="nombre" required></td>
                        </tr>
                        <tr class="apellidos">
                            <td><label for="correo">Correo Electrónico:</label></td>
                            <td><input type="email" placeholder="Correo Electrónico" name="correo" required></td>
                        </tr>
                        <tr class="telefono">
                            <td><label for="user">Usuario:</label></td>
                            <td><input type="text" placeholder="Usuario" name="user" required></td>
                        </tr>
                        <tr class="cargo">
                            <td><label for="pass">Contraseña:</label></td>
                            <td><input type="password" placeholder="Contraseña" name="pass" required></td>
                        </tr>
                        <tr class="direc">
                            <td><label for="privi">Privilegio:</label></td>
                            <td>
                                <select name="privi" required>
                                    <option value="" disabled selected> Elija un privilegio </option>
                                    <option value="admin">Administrador</option>
                                    <option value="estandar">Estándar</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="botones">
                                <input class="botones enviar" type="submit" name="enviar" value="Enviar" id="enviar">
                                <input class="botones borrar" type="reset" name="borrar" value="Borrar">
                            </td>
                        </tr>
                        <tr>
                            <td class="regresar" colspan="2">
                                <a href='usuarios_admin.php' class="regresar icon-arrow-left">Regresar</a>
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
            $consulta=("SELECT idusuarios, nombre, usuario, privilegio FROM usuarios");
            $query=mysqli_query($conexion,$consulta);  
    ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dulcería Arcada | Eliminar Usuarios </title>

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
                <div class="tabla-cont">
                    <h3 class="titulo"> Eliminar Usuario</h3>
                    <p>Selecciona el registro que deseas eliminar</p>
                    <table class="tabla">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th></th>
                        </tr>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['idusuarios'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['usuario'] ?></td>
                            <td><?php echo $columna['privilegio'] ?></td>
                            <td><a class="borrar icon-delete" href = eliminar_usuario.php?id=<?php echo $columna['idusuarios'] ?>>Eliminar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de usuarios encontrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='usuarios_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php }else if ($ope=='m') { 
            $consulta=("SELECT idusuarios, nombre, usuario, privilegio FROM usuarios");
            $query=mysqli_query($conexion,$consulta);    
    ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dulcería Arcada | Actualizar Usuarios </title>

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
                                <li><a class="btn-menu-empleados" href="empleados_admin.php">Empleados</a></li>
                                <?php if ($_SESSION['priv']=="admin"){ ?>
                                    <li><a class="btn-menu-usuarios  select" href="usuarios_admin.php">Usuarios</a></li>
                                <?php } ?>
                                <li><a class="btn-menu-cerrarsesion" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
            
            <div class="contenedor">
                <div class="tabla-cont">
                    <h3 class="titulo"> Actualizar Usuario</h3>
                    <p>Selecciona el registro que deseas actualizar</p>
                    <table class="tabla">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Privilegio</th>
                        </tr>
                        <?php
                            while ($columna=mysqli_fetch_array($query)) { 
                        ?>
                        <tr>
                            <td><?php echo $columna['idusuarios'] ?></td>
                            <td><?php echo $columna['nombre'] ?></td>
                            <td><?php echo $columna['usuario'] ?></td>
                            <td><?php echo $columna['privilegio'] ?></td>
                            <td><a class="modificar icon-edit" href = modificar_usuario.php?id=<?php echo $columna['idusuarios'] ?>>Modificar</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php $numregistros=mysqli_num_rows($query); ?>
                    <h3 class="registros"> La cantidad de usuarios encontrados es: <?php echo $numregistros ?></h3>
                    <div class="regresar">
                        <a href='usuarios_admin.php' class="regresar icon-arrow-left">Regresar</a>
                    </div>
                </div>
            </div>
        </body>
    <?php } ?>
