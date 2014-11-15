<?php
include('../Conexion/conexion.php');
include('impuestos.php');
include('empleadosFunciones.php');
Conexion::conectar();

if(isset($_POST["envio"]) and $_POST["envio"] == "si")
{   
	agregarUsuario();
    exit;
}
elseif(isset($_POST["elimina"]) and $_POST["elimina"] == "si")
{ 
    eliminaEmpleado();
    exit;
}
elseif(isset($_GET['buscarEmpleado']) && isset($_GET['id']) && isset($_GET['codigo']) && isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['salario']) && isset($_GET['hora']) && isset($_GET['sexo']) )
{ 
	actualizaEmpleado();
} 


?>  