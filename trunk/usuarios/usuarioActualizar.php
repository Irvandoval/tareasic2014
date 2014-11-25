<?php

require_once("../Conexion/Login.php");
if($_SESSION['nivel']=='1')
{
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
</head>
<?php
require_once("../Conexion/Login.php");
include('usuariosFunciones.php');
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
   <legend>Modifica Usuario</legend>
   <?php
     buscarUsuario();
	 mostrarUsuario();
   ?> 
   <br> 
   <input type="submit" class="boton purpura" onclick = "this.form.action = 'usuarioActualizar.php'" value="Mostrar Usuarios" /> 
   <input type="submit" class="boton purpura" onclick = "this.form.action = 'usuariosRegistra.php'"   value="Actualizar" name="actualiza" /> 
   </fieldset> 
   </form>   
    
    </div>

    <div id="derecha"> 
    <fieldset> 
    <legend>Usuarios</legend>  
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
            window.location = '../inicio.php';
          </script>";
    }
	
?>