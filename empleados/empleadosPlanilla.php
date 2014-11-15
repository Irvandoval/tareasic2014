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

    <form method="get" id="empleadoPlanilla">
    <fieldset> 
    <legend>Planilla de Empleado</legend>
    <table>
	<tr>
	<td>
    <?php
      buscarEmpleado();
    ?> 
    </td>
	<td>
    <input type="submit"  value="Ver Planilla" class="boton purpura formaBoton"/> 
    </td>
	</tr>
	</table> 
	<br><br>
    <?php
      mostrarPlanilla();
    ?>
    </fieldset> 
    </form>
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
