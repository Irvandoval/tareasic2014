<?php

require_once("../Conexion/Login.php");
Conexion::conectar();
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
     
<form name="kardex" method="post" action="InventarioKardex.php">
<?php
include('../menu.php');
   
include('InventarioFunciones.php');
menu2();
     echo " <div id='tc'>";
buscaProducto();
?>

<input type="submit" class='boton' value="Ver Kardex P.T">
</div>
</form>
<form name="kardex" method="post" action="InventarioKardexMP.php">
    <div id="algo" >
    <input type="submit" class='boton' value="Ver Kardex M.P">
    </div>
</form>

  </div>
</div>
 
</body>


<?php

}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../index.php';
          </script>";
    }
	
?>
