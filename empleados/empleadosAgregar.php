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
    <form action="empleadosRegistra.php" method="post" id="agregarEmpleado">
    <fieldset> 
	<legend>Agregar Empleado</legend>
	<table cellspacing="5" class='tabla'>
	  <tr>
          <td class='modo3'><label for="nombre">Nombre</label></td>  <td class='modo2'> <input type="text" name="nombre"></td>
      </tr>
	  <tr>
	      <td class='modo3'><label for="apellido">Apellido</label>  <td class='modo2'><input type="text" name="apellido">
	  </tr>
	  <tr>
	      <td class='modo3'><label for="puesto">Puesto</label></td>
	      <td class='modo2'>
		     <select name="puesto">
	          <option value="0">Seleccione el Cargo</option>
			  <?php 
	             $query="select codigo, puesto from cargo";
                 $resultado=mysql_query($query) or die(mysql_error());
	             while($fila=mysql_fetch_array($resultado))
	             {
	                echo "<option value=".$fila['codigo']."> ".$fila['puesto']." </option>"; 
	             }
	          ?> 
	        </select>
		</td>
    </tr>
	<tr>
	    <td class='modo3'><label for="sexo">Sexo</label></td>
	    <td class='modo2'>
		    <select name="sexo">
			<option value="0">Seleccione el Sexo </option>
			<option value="M">Masculino</option> 
			<option value="F">Femenino</option>
			</select>
		</td>
    </tr>
	<tr>
	    <td class='modo3'><label for="salario">Salario</label></td>  <td class='modo2'><input type="text" name="salario"><BR></td>
	</tr>
	<tr>
	    <td class='modo3'><label for="horas">Horas Extras</label></td>  <td class='modo2'><input type="text" name="horas"><BR></td>
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
	<fieldset> 
       <legend>Empleados</legend>
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