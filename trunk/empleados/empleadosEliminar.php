<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/boton.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
</head>


<?php
include('empleadosFunciones.php');
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
    <div id="izquierda">
  
   <form action="empleadosRegistra.php" method="post" id="eliminaEmpleado">
 
   <fieldset> 
   <legend>Eliminar Empleado</legend>
   <table> 
     <tr>
	 <td>
     <?php
       buscarEmpleado();
     ?>
     </td>
	
	 <td>
        <input type="submit" class="boton purpura formaBoton" value="Eliminar"/>
        <input  type="hidden" name="elimina"  value="si" /> 
	 </td>	
     </tr>	
   </table>	 
   </fieldset> 
   </form>
   </div>  

    <div id="derecha">
	<fieldset> 
       <legend>Empleado</legend>
         <?php
	       mostrar();
         ?> 
    </fieldset>
    </div>
   
   </fieldset>
  </div>
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
