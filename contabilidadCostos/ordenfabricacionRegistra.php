<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
</head>  

<body>
<div id="wrapper">
   <div id="pagina">

   <header>    
   </header>

<?php

include('ordenfabricacionfunciones.php');
Conexion::conectar();
	include ('../menu.php'); 
	menu2();


if(isset($_GET['buscarProducto']) )
{ 
	insertarProducto();
	exit;
} 
elseif(isset($_GET['buscarOrden']) )
{ 
    cerrarOrden();  
    
   
 		
}
elseif(isset($_GET['buscarOrdenTerminada']) )
{ 
    verOrdenTerminada();		
}
elseif(isset($_GET['buscarOrdenProceso']) )
{ 
    verOrdenProceso();		
}

 
?>

<footer>
  </footer>
  </div>
</div>
 
</body>

</html>  

<?php

}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../index.php';
          </script>";
    }
?>

