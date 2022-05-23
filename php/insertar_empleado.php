<?php
    session_start();
    if(!isset ($_SESSION['user'])){
        header("location:..//index.php");
    }

	include_once '..//conexion.php';

    $mensaje ='ninguno';

	$nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['tel'];
    $cargo = $_POST['cargo'];
    $direccion = $_POST['direc'];
    $nacimiento = $_POST['nac'];

	$consulta="INSERT INTO empleados (nombre, apellidos, telefono, ocupacion, direccion, fecha_nac) values ('$nombre', '$apellidos', '$telefono', '$cargo', '$direccion', '$nacimiento')";

	$resultado=mysqli_query($conexion, $consulta);

	if($resultado){
        $mensaje='correcto';
    }else{
        $mensaje='incorrecto';
    }
?>

<!DOCTYPE html>
<html lang="es">
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
                title: "Registro Insertado Correctamente",
                text: "Da click en el botón para continuar",
                icon: "success",
            }).then(function() {
                window.location = "empleados_admin.php";
            });
        }
        alerta();
    </script>
<?php } else if($mensaje=='incorrecto'){ ?>
    <script>
        function alerta(){
            swal({
                title: "Registro NO Insertado",
                text: "Favor de verificar",
                icon: "error",
                button: "Ok",
            }).then(function() {
                window.location = "empleados_admin.php";
            });
        }
        alerta();
    </script>
<?php } ?>

</html>