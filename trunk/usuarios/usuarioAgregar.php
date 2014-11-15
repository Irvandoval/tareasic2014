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
    <form action="usuariosRegistra.php" method="post" id="agregarEmpleado">
    <br> <br> <br> 
    <fieldset> 
	<legend>Agregar Usuario</legend>
	<table cellspacing="5" class='tabla'>
	  <tr>
          <td class='modo3'><label for="nombre">Nombre</label></td>  <td class='modo2'> <input type="text" name="nombre"></td>
      </tr>
	  <tr>
	      <td class='modo3'><label for="apellido">Apellido</label>  <td class='modo2'><input type="text" name="apellido">
	  </tr>
	  
	  <tr>
          <td class='modo3'><label for="usuario">Usuario</label></td>  <td class='modo2'> <input type="text" name="usuario"></td>
      </tr>
	  
	  <tr>
	      <td class='modo3'><label for="nivel">Nivel</label></td>
	      <td class='modo2'>
		     <select name="nivel">
	          <option value="0">Seleccione el Cargo</option>      
	               <option value="1"> Administrador </option>
				   <option value="2"> Contador </option>
	        </select>
		</td>
      </tr>
	
	  <tr>
          <td class='modo3'><label for="password">Password</label></td>  <td class='modo2'> <input type="password" name="password"></td>
      </tr>
	  <tr >	
	    <td colspan="2">
		<input type="submit"  class="boton negro formaBoton" value="Procesa Datos"/>
		<input  type="hidden" name="envio"  value="si" />
		</td>
	  </tr> 
	  <tr> </tr>
	</table>
    </fieldset> 
    </form>
    </div>
	
    <div id="derecha">
    <br> <br> <br> 
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