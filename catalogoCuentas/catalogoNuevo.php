<?php
require_once("../Conexion/Conexion.php");
if(isset($_SESSION["id"]))
{

?>

<?php
function generaCuentas()
{
   
    Conexion::conectar();

	$consulta=mysql_query("SELECT codigoe, elemento FROM elemento");
	

	echo "<select name='cuenta' id='cuenta' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
		
	}

	echo "</select>";
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">



<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Crear Nueva Cuenta</title>
<link rel="stylesheet" type="text/css" href="select_dependiente.css">
<script type="text/javascript" src="select_dependientes.js"></script>
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
menu2();
 ?> 
    <fieldset>
         <legend>Nueva Cuenta:</legend>
        <form method="post" action="catalogoResultado.php">  
        <br>   		
			<div>
			    <table border='1' class='tabla'>
                    <tr class='modo1'>
						<td colspan="2" WIDTH="50%">
						   Seleccione la Cuenta 
						  <div>
						   <?php generaCuentas(); ?>
						  </div>
						</td>
					</tr>
					<tr class='modo1'>
						<td WIDTH="25%">
						  Elija el rubro
						  <div > 
							<select disabled="disabled" name="subcuenta" id="subcuenta" >			
							</select>
						  </div>
						</td>
						<td WIDTH="25%">
						  Escriba el numero de mayor 
					      <div> 
						  <input type="text" size="40" name="codigo">
						  </div > 
						</td>
					</tr>
					<tr class='modo1'>
						<td colspan="2" WIDTH="50%">
						Escriba la cuenta 
						<div>
						<input type="text" size="90" name="cuentat">
						</div>
						</td>
					</tr>
				</table>
			</div>
							
			<br>
		<input class="boton negro formaBoton" type="submit" value="CREAR">

    </form>	
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
