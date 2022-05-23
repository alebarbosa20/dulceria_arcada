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
		
    $consulta="DELETE FROM usuarios WHERE idusuarios='$id'";
    
    $resultado=mysqli_query($conexion, $consulta);

	if ($resultado) 
	{
		$mensaje='correcto';
    }else{
        $mensaje='incorrecto';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    
</body>

<?php
    if($mensaje=='correcto'){ ?>
    <script>
        function alerta(){
            swal({
                title: "Registro Eliminado Correctamente",
                text: "Da click en el botón para continuar",
                icon: "success",
            }).then(function() {
                window.location = "usuarios_admin.php";
            });
        }
        alerta();
    </script>
<?php } else if($mensaje=='incorrecto'){ ?>
    <script>
        function alerta(){
            swal({
                title: "Registro NO Eliminado",
                text: "Favor de verificar",
                icon: "error",
                button: "Ok",
            }).then(function() {
                window.location = "usuarios_admin.php";
            });
        }
        alerta();
    </script>
<?php  } ?>
</html>