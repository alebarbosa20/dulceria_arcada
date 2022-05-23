<?php
    session_start();
    if(isset($_SESSION)){
        session_destroy();
    }

    $mensaje = 'ninguno';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $use = $_POST['usuario'];
        $pas = $_POST['contrasenia'];

        
        require_once("..//conexion.php");

        $consulta=("SELECT usuario, password, privilegio FROM usuarios WHERE usuario ='$use' AND aes_decrypt(unhex(password),'dulceria1')='$pas' ");
        $query=mysqli_query($conexion,$consulta) or die("Error al realizar la consulta");

        if($columna=mysqli_fetch_array($query)){
            $priv=$columna['privilegio'];
        }

        if(mysqli_num_rows($query)>0){
            session_start();

            $_SESSION['user']=$use;
            $_SESSION['pass']=$pas;

            if($priv=="admin"){
                $_SESSION['priv']="admin";
            }else if($priv=="estandar"){
                $_SESSION['priv']="estandar";
            }

            $mensaje = 'correcto';

        } else {

            $mensaje = 'incorrecto';
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Dulcería Arcada | Login</title>

    <link rel="icon" href="..//img/logo.png" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="..//css/login.css">
    <link rel="stylesheet" href="..//css/normalize.css">
    <link rel="stylesheet" href="..//css/fonts.css">

</head>

<body>
    <div class="contenedor">
        <div class="contenedor-login">
            <div class="titulo">
                <a href="..//index.html"><img class="logo" src="..//img/logo.png" alt=""></a>
                <h1 class="login-titulo">Login</h1>
            </div>
            <div class="formulario">
                <form class="form" action="#" method="post">
                    <div class="usuario">
                        <div class="usuario-lbl">
                            <label for="usuario">Usuario: </label>
                        </div>
                        <div>
                            <input type="text" name="usuario" placeholder="Usuario" required>
                        </div>
                    </div>
                    <div class="contraseña">
                        <div class="contraseña-lbl">
                            <label for="contrasenia">Contraseña: </label>
                        </div>
                        <div>
                            <input type="password" name="contrasenia" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="btn">
                        <button class="btn-ingresar" type="submit" name="Login"> Ingresar </button>
                    </div>
                </form>
            </div>
            <p class="cuenta"><a class= "icon-home" href="..//index.html">   Regresar a Inicio</a></p>
        </div>
    </div>
</body>

<?php 
    if($mensaje=='correcto'){
?>
    <script>
        function alerta(){
            swal({
                title: "Sesión Iniciada Correctamente",
                text: "Da click en el botón para continuar",
                icon: "success",
            })
            .then(function() {
                window.location = "inicio_admin.php";
            });
        }
        alerta();
    </script>
<?php
    } else if($mensaje=='incorrecto'){
?>
    <script>
        function alerta(){
            swal({
                title: "Usuario o Contraseña Incorrectos",
                text: "Favor de verificar",
                icon: "error",
                button: "Ok",
            });
        }
        alerta();
    </script>
<?php
    }
?>

</html>