<?php
require_once("../Conexion/Login.php");
Conexion::conectar();
if(isset($_SESSION["id"]))
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <link rel="stylesheet" type="text/css" href="../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../Css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../Css/steel.css" />
    <script type="text/javascript" src="../JavaScript/jscal2.js"></script>
    <script type="text/javascript" src="../JavaScript/es.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
</head>

<body>

<body>
<div id="wrapper">
  <div id="pagina">

  <header> 
     
  </header>
  
 <?php
include('../menu.php');
include('InventarioFunciones.php');
menu2();
 ?> 


 <div id="izquierda">
<form action='InventarioOperacion.php' method='post' id='ope'>
<fieldset> 
<legend>Nueva Transaccion</legend>
<table border='1'  class='tabla' cellspacing='2' cellspacing='2'>
   <tr class='modo1'> 
        <td>Producto</td>
        <td> <?php buscaProducto(); ?>   </td>
   </tr>
   <tr class='modo1'> 
        <td>Transaccion </td>
		<td><select name="operacion">
		    <option selected>Seleccione una transaccion</option>
			<option value="0">Inventario Inicial </option>
			<option value="1">Compra de Mercaderia </option>
			<option value="2">Venta de Mercaderia </option>
	        </select>
        </td>
   </tr>
   <tr class='modo1'> 
        <td>Descripcion</td>
		<td><textarea name="descripcion" rows="2" cols="19"></textarea><br></td>
   </tr>
   <tr class='modo1'> 
        <td>Fecha</td>
		<td><input  id="f_rangeStart" name="f_rangeStart"/>
		    <button  id="f_rangeStart_trigger">Ver </button>        
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
   
   <tr class='modo1'> 
        <td>cantidad</td>
		<td><input type="text" name="cantidad"></td>
   </tr class='modo1'>
	
   <tr class='modo1' > 
        <td>Precio</td>
		<td><input type="text" name="precio"></td>
   </tr>
</table>
<input type="submit" class='boton negro formaBoton' value="Agregar Trasaccion"> 
</fieldset> 
</form>
</div>

 <div id="derecha"  id="content" align="justify">
  <fieldset> 
	<legend>Metodo</legend>
	  <h4>Para establecer aquel costo promedio de los inventarios, se realiza un promedio entre el costo de los inventarios que se poseen y el costo de aquellos inventarios que se van adquiriendo. La aplicación de las NIIF (se está llevando a cabo por muchas empresas a nivel mundial, esto con el objetivo de preparar y presentar Estados Financieros más razonables. Teniendo presente lo mencionado. Recuerda que al llevar contabilidad con las NIIF, si se permite la aplicación del método promedio ponderado. Es decir, si aplicas NIIF COMPLETAS o NIIF para PYMES, puedes llevar como método de valoración de inventarios el método Promedio Ponderado. 
	  </h4>
  </fieldset>
  </div> 

<?php 

transaccion();


	
?>

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
