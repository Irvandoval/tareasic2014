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
<?php
require_once("../Conexion/Login.php");
include('ordenfabricacionfunciones.php');
Conexion::conectar();
?>
 
<body>
<div id="wrapper">
   <div id="pagina">

   <header>    
   </header>
    <?php
	include ('../menu.php'); 
	menu2();
    ?> 

   <fieldset> 
       <legend>Empleado</legend>
         <?php
		   if(isset($_GET['buscarOrdenTerminada']) )
           { 
	          verOrdenTerminada();	
			}
         ?> 
    </fieldset>
  
	
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