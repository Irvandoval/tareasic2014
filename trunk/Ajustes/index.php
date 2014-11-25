<?php
require_once("../Conexion/Login.php");
Conexion::conectar();
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
	<script type="text/javascript" src="../JavaScript/calculadora.js"></script>
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

include('ajustesFunciones.php');
periodo();

function imprime_celdas()
{
	echo "<td><select name=\"cuenta[]\" >";
	$cuentas=mysql_query("SELECT * FROM mayor WHERE ajuste='a'") or die(mysql_error());
	while($res=mysql_fetch_assoc($cuentas)) 
	{
		echo "<option value=".$res['codigom'].">".$res['mayo']."</option>";		
	};
	echo"</select></td><td><input type=\"text\" name=\"deber[]\" size=\"10\" value=0></td><td><input type=\"text\" name=\"haber[]\" size=\"10\" value=0></td><tr>";
}
?>

    <form name="libro_diario" method="post" action="../libroDiario/librodiarioRegistro.php">
    <table cellspacing='2' cellspacing='2'>
    <tr>
        <td> Partida N: <input name="partida" type="text" value="" size="3"></td>
		<td>
			<label for="f_rangeStart">Fecha:</label>
			<input size="15" id="f_rangeStart" name="f_rangeStart"/>
		</td>
		<td>	
		<button class='boton2' id="f_rangeStart_trigger">Calendario</button> 
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
	<table border="0" class="tabla">
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
	echo "<tr><td><b><a href='".$_SERVER['PHP_SELF']."?u=".($u+1)."' class='boton2'>+</a></b></td> <td><b><a class='boton2' href='".$_SERVER['PHP_SELF']."?u=".($u-1)."' >-</a></b></td></tr>";
	?>
	</table>
	Describir Partida:<br> <br>
	<textarea name="descripcion" rows="5" cols="86"></textarea><br>
	<input type="hidden" value="<?php echo $u; ?>" name="n"> <br>
	<input type="submit" class='boton' value="Registrar">                    
	<input type="reset" class='boton' value="Limpiar Formulario">
	</form>
	<br>
    
	<div id="izquierda">
	<fieldset> 
	<legend>Calculadora</legend>
	 <div align="center">
	<form name=result>
	<input size=20 name=result onFocus="refresh(); this.blur();">	<br>
    </form>
	<IMG SRC="scalc.gif" width=159 height=224 usemap="#map" border=0>
	<MAP name="map">
		<area shape=rect HREF="javascript:digit(0)" COORDS="12,191,32,209">
		<area shape=rect HREF="javascript:period()" COORDS="40,191,60,209">
		<area shape=rect HREF="javascript:exp()"    COORDS="68,191,88,209">
		<area shape=rect HREF="javascript:sign()"   COORDS="96,191,116,209">
		<area shape=rect HREF="javascript:equals()" COORDS="124,191,144,209">
		<area shape=rect HREF="javascript:digit(1)" COORDS="12,166,32,184">
		<area shape=rect HREF="javascript:digit(2)" COORDS="40,166,60,184">
		<area shape=rect HREF="javascript:digit(3)" COORDS="68,166,88,184">
		<area shape=rect HREF="javascript:operator('+')"  COORDS="96,166,116,184">
		<area shape=rect HREF="javascript:operator('-')"  COORDS="124,166,144,184">
		<area shape=rect HREF="javascript:digit(4)" COORDS="12,141,32,159">
		<area shape=rect HREF="javascript:digit(5)" COORDS="40,141,60,159">
		<area shape=rect HREF="javascript:digit(6)" COORDS="68,141,88,159">
		<area shape=rect HREF="javascript:operator('*')"  COORDS="96,141,116,159">
		<area shape=rect HREF="javascript:operator('/')"  COORDS="124,141,144,159">
		<area shape=rect HREF="javascript:digit(7)" COORDS="12,116,32,134">
		<area shape=rect HREF="javascript:digit(8)" COORDS="40,116,60,134">
		<area shape=rect HREF="javascript:digit(9)" COORDS="68,116,88,134">
		<area shape=rect HREF="javascript:clear()"  COORDS="96,116,116,134">
		<area shape=rect HREF="javascript:clearAll()"  COORDS="124,116,144,134">
		<area shape=rect HREF="javascript:openp()"     COORDS="12,90,32,104">
		<area shape=rect HREF="javascript:closep()"    COORDS="40,90,60,104">
		<area shape=rect HREF="javascript:func('Min')" COORDS="68,90,88,104">
		<area shape=rect HREF="javascript:func('MR')"  COORDS="96,90,116,104">	
		<area shape=rect HREF="javascript:func('M+')"  COORDS="124,90,144,104">
		<area shape=rect HREF="javascript:operator('pow')"  COORDS="12,65,32,79">
		<area shape=rect HREF="javascript:func('n!')"   COORDS="40,65,60,79">
		<area shape=rect HREF="javascript:func('sqrt')" COORDS="68,65,88,79">
		<area shape=rect HREF="javascript:func('1/x')"  COORDS="96,65,116,79">
		<area shape=rect HREF="javascript:func('swap')" COORDS="124,65,144,79">
		<area shape=rect HREF="javascript:inv()"        COORDS="12,40,32,54">
		<area shape=rect HREF="javascript:func('sin')"  COORDS="40,40,60,54">
		<area shape=rect HREF="javascript:func('cos')"  COORDS="68,40,88,54">	
		<area shape=rect HREF="javascript:func('tan')"  COORDS="96,40,116,54">
		<area shape=rect HREF="javascript:func('pi')"   COORDS="124,40,144,54">
		<area shape=rect HREF="javascript:func('log')"  COORDS="12,15,32,29">
		<area shape=rect HREF="javascript:func('ln')"   COORDS="40,15,60,29">
		<area shape=rect HREF="javascript:func('log2')" COORDS="68,15,88,29">
		<area shape=rect HREF="javascript:hex()"        COORDS="96,15,116,29">
		<area shape=rect HREF="js-info.htm"               COORDS="124,15,144,29">
	</MAP>
	</div>
	</fieldset> 
	</div>
	
	<div id="derecha">
	<fieldset> 
	  <legend>Consideraciones</legend>
	   <div align="justify">   
	    <h4> Estos ajustes y correcciones son necesarios para poder emitir estados financieros ajustados a la realidad economica y financiera de la empresa, ademas de cumplir con los principios de contabilidad.Durante el ejercicio contable, los errores son casi inevitables, lo que hace necesaria una revision al final del periodo para identificar y corregir esos errores. Algunos hechos economicos, debido a que en el momento de su registro no se conocen plenamente, se registran de forma incompleta, de modo que se hace necesario realizar el ajuste respectivo al finalizar el periodo contable.
	    </h4>
	   </div>	
	</fieldset> 
    </div>
	
</div>
<footer>
</footer>

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
