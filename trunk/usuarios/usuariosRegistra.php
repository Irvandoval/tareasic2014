<?php
include('../Conexion/conexion.php');
include('usuariosFunciones.php');
Conexion::conectar();

if(isset($_POST["envio"]) and $_POST["envio"] == "si")
{   
	agregarUsuario();
    exit;
}
elseif(isset($_POST["elimina"]) and $_POST["elimina"] == "si")
{ 
    eliminaUsuario();
    exit;
}
elseif(isset($_GET['buscarUsuario']) && isset($_GET['id'])  && isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['usuario']) && isset($_GET['password']) && isset($_GET['nivel']) )
{ 
	actualizaUsuario();
}
elseif( isset( $_POST["cambiar"]) and $_POST["cambiar"] == "si"   ) 
{
    actualizaPeriodo();
    exit;
}
 


?>  