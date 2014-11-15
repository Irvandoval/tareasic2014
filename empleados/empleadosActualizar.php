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

    <div id="izquierda"> 

   <form method="get" id="modificaEmpleado">
   <fieldset> 
   <legend>Modifica Empleado</legend>
   <?php
     buscarEmpleado();
	 mostrarEmpleado();
   ?> 
   <br> 
   <input type="submit" class="boton purpura formaBoton" onclick = "this.form.action = 'empleadosActualizar.php'" value="Mostrar Empleado" /> 
   <input type="submit" class="boton purpura formaBoton" onclick = "this.form.action = 'empleadosRegistra.php'"   value="actualizar" name="actualizar" /> 
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