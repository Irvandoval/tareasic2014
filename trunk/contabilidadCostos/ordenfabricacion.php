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

<body>

<div id="wrapper">
  <div id="pagina">

  <header> 
     
  </header> 
  <?php
    include('../menu.php');
	include('ordenfabricacionfunciones.php');
	menu2();
  ?> 
  <div id="izquierda"> 
  <form method="get" id="agregarOrden">
  <fieldset> 
     <legend>Nueva Orden</legend>
     <?php 
	    Conexion::conectar();
        producto();
     ?>
	 <input type="submit" class="boton purpura formaBoton" onclick = "this.form.action = 'ordenfabricacionRegistra.php'"   value="Nueva Orden" name="orden" /> 
  </fieldset>
  </form>  
  
    <form method="get" id="cerrarOrden">
	<fieldset> 
       <legend>Cerrar Orden</legend>
         <?php
	        buscarOrden();
         ?> 
		 <input type="submit" class="boton purpura formaBoton" onclick = "this.form.action = 'ordenfabricacionRegistra.php'"   value="Cerrar Orden" name="orden" /> 
   
    </fieldset>
   </form> 
  

  
  </div> 
  
  <div id="derecha">
  
      <form method="get" id="buscarOrden">
     <fieldset> 
       <legend>Ver Orden en Proceso</legend>
       <?php 
	      Conexion::conectar();
          buscarOrdenProceso();
       ?>
	   <input type="submit" class="boton purpura formaBoton" onclick = "this.form.action = 'ordenfabricacionRegistra.php'"   value="Mostrar" name="orden" /> 
     </fieldset>  
   </form>  
  
  
    <form method="get" id="buscarOrden">
     <fieldset> 
       <legend>Ver Orden Terminada</legend>
       <?php 
	      Conexion::conectar();
          buscarOrdenTerminada();
       ?>
	   <input type="submit" class="boton purpura formaBoton" onclick = "this.form.action = 'ordenfabricacionRegistra.php'"   value="Mostrar" name="orden" /> 
     </fieldset>  
   </form> 

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

