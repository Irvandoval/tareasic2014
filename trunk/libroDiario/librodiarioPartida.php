<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../Css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../Css/steel.css" />
    <script type="text/javascript" src="../JavaScript/jscal2.js"></script>
    <script type="text/javascript" src="../JavaScript/es.js"></script>
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
 
Conexion::conectar();  

function imprime_celdas()
{
	echo "<td><select name=\"cuenta[]\" >";
	$cuentas=mysql_query("select *from mayor") or die(mysql_error());
	while($res=mysql_fetch_assoc($cuentas)) 
	{
		echo "<option value=".$res['codigom'].">".$res['mayo']."</option>";		
	};
	echo"</select></td><td><input type=\"text\" name=\"deber[]\" size=\"10\" value=0></td><td><input type=\"text\" name=\"haber[]\" size=\"10\" value=0></td><tr>";
}
?>

<form name="libro_diario" method="post" action="../libroDiario/librodiarioRegistro.php">
<table>
<tr>
    <td> Partida N: <input name="partida" type="text" value="" size="3"></td>
	<td>
        <label for="f_rangeStart">Fecha:</label>
		<input size="15" id="f_rangeStart" name="f_rangeStart"/>
    </td>
    <td>	
		<button class='boton negro formaBoton' id="f_rangeStart_trigger">Calendario</button> 
        <br>       
		<script type="text/javascript">
			RANGE_CAL_1 = new Calendar
			(
				{
					inputField: "f_rangeStart",
					dateFormat: "%Y-%m-%d",
					trigger: "f_rangeStart_trigger",
					bottomBar: false,
					onSelect: function() 
					{
						var date = Calendar.intToDate(this.selection.get());
						LEFT_CAL.args.min = date;
						LEFT_CAL.redraw();
						this.hide();
					}
				}
			);
			function clearRangeStart() 
			{
				document.getElementById("f_rangeStart").value = "";
				LEFT_CAL.args.min = null;
				LEFT_CAL.redraw();
			};
                
		</script>

	</td>
</tr>
</table>
<br>
<table border="1" class="tabla">
	<tr class="modo1">
		<th>Cuenta</th>
		<th>Deber</th>
		<th>Haber</th>
	</tr>


<?php
if(isset($_GET['u']))
{
  $u=$_GET['u'];	
}
else 
   {
		$u=2;
   }
   
for($i=0;$i<$u;$i++)
{
	imprime_celdas();
}
echo "<tr><td><b><a href='".$_SERVER['PHP_SELF']."?u=".($u+1)."' class='boton negro formaBoton'> Nueva cuenta</a></b></td> <td><b><a class='boton negro formaBoton' href='".$_SERVER['PHP_SELF']."?u=".($u-1)."' > Eliminar</a></b></td></tr>";
?>


</table>
Describir Partida:<br> <br>
<textarea name="descripcion" rows="5" cols="86"></textarea><br>
<input type="hidden" value="<?php echo $u; ?>" name="n"> <br>
<input type="submit" class='boton negro formaBoton' value="Registrar">                    
<input type="reset" class='boton negro formaBoton' value="Limpiar Formulario">
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
