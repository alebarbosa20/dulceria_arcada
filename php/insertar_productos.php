<?php
    session_start();
    if(!isset ($_SESSION['user'])){
        header("location:..//index.php");
    }

	include_once '..//conexion.php';
    $tab=$_POST['tab'];

    $mensaje ='ninguno';

    if ($tab=='tab-prod') {

        $prec = trim($_POST['prec']);
            if(!is_numeric($prec)){
                $error = "Solo ingresa números";
            }      
                               
            if(isset($error)) { ?>
                <script>
                    function alerta(){
                        swal({
                            title: "Valor no válido",
                            text: "Insertar solamente números en el campo Precio",
                            icon: "error",
                            button: "Ok",
                        })
                    }
                    alerta();
                </script>
        <?php } 

        $opcion='Productos';

		$id = $_POST['codigo'];
		$nombre = $_POST['nombre'];
        $descripcion = $_POST['descrip'];
        $categoria = $_POST['categ'];
        $precio = $_POST['prec'];
        $existencia = $_POST['exis'];

		$consulta="INSERT INTO productos values ('$id', '$nombre', '$descripcion', '$categoria', '$precio', '$existencia')";

    }
    
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
    <title>Insertar <?php echo $opcion ?></title>

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
                window.location = "productos_admin.php";
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
                window.location = "productos_admin.php";
            });
        }
        alerta();
    </script>
<?php } ?>

</html>