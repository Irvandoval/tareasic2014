<?php

require_once("../Conexion/Login.php");
Conexion::conectar();
if(isset($_SESSION["id"]))
{
?>

<?php

function  agregarUsuario()
{

if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['apellido']) && !empty($_POST['apellido']) && isset ($_POST['puesto']) && !empty($_POST['puesto'])&&isset($_POST['sexo']) && !empty($_POST['sexo']) &&isset($_POST['salario']) && !empty($_POST['salario']) ) 
{
  $nombre=htmlentities($_POST['nombre']);
  $apellido=htmlentities($_POST['apellido']);
  $puesto=htmlentities($_POST['puesto']);
  $sexo=htmlentities($_POST['sexo']);
  $salario=htmlentities($_POST['salario']);
  $horas=htmlentities($_POST['horas']);
  
  $isr=0;  $isss=0; $afp=0;
  
  $isr=isr($salario+$horas);
  $isss=isss($salario+$horas);
  $afp=afp($salario+$horas);
  $totald=($isr+$isss+$afp);
	  
  $empleado="insert into empleado(codigo,nombre,apellido,salario,horae,sexo) values(".$puesto.",'".$nombre."','".$apellido."','".$salario."','".$horas."','".$sexo."')";
  mysql_query($empleado) or die(mysql_error());  
  
  $id=mysql_insert_id();
  $retenciones="insert into retenciones(id,isss,afp,renta,totald) values(".$id.",'".$isss."','".$afp."','".$isr."','".$totald."')";
  mysql_query($retenciones) or die(mysql_error());  
  
  echo "<script type=\"text/javascript\" >
               alert('Los datos se han introducido correcptamente.');
               setTimeout(\"location.href='empleadosAgregar.php'\",1);
            </script>";
}

else 
   {

       echo "<script type=\"text/javascript\" >
               alert('Error no se ha podido ingresar los datos del empleado');
               setTimeout(\"location.href='empleados.php'\",1);
            </script>";

   }
   
 }
 
 function buscarEmpleado()
 {
   $empleado="SELECT id, nombre, apellido FROM empleado";
   $consulta=mysql_query($empleado) or die(mysql_error());

   echo "<select name='buscarEmpleado'>";
            echo "<option value='0'>Seleccione un Empleado</option>";
		while($ver = mysql_fetch_array($consulta))
		{
			echo "<option value=".$ver['id'].">".$ver['nombre']." ".$ver['apellido']."</option>";
		}
   echo "</select>"; 
   echo "<br>";   
 }
 
function eliminaEmpleado()
{
  if(isset($_POST['buscarEmpleado']) && !empty($_POST['buscarEmpleado']) ) 
  {
     $id=htmlentities($_POST['buscarEmpleado']);
	 $elimina="DELETE FROM empleado WHERE id =".$id; 
	 mysql_query($elimina) or die(mysql_error());
	 
	 $quitarRetencion="DELETE FROM retenciones WHERE id =".$id;
 	 mysql_query($quitarRetencion) or die(mysql_error());
	 
	 echo "<script type=\"text/javascript\" >
               alert('El empleado se ha eliminado con exito.');
               setTimeout(\"location.href='empleadosEliminar.php'\",1);
            </script>";
	 
  }
  else 
     {

       echo "<script type=\"text/javascript\" >
               alert('Error no se ha podido eliminar empleado');
               setTimeout(\"location.href='empleados.php'\",1);
            </script>";

     }
 } 
 
 function mostrarEmpleado()
 {  
    if(isset($_GET['buscarEmpleado']))
	{  
	  $id=htmlentities($_GET['buscarEmpleado']);
      $empleado="SELECT id,codigo, nombre, apellido, salario, horae, sexo FROM empleado WHERE id=".$id;
      $consulta=mysql_query($empleado) or die(mysql_error());
	  echo"<br><br>";
	  while($ver = mysql_fetch_array($consulta))
		{
		   echo "<table border='1' aling='center' class='tabla'>";
                 
		   echo"<input type='hidden' name='id'   value=".$ver['id'].">";   
           echo "<tr class='modo1'> 
		        <td class='modo3'>Codigo</td>"; 
		   echo"<td class='modo2'><input type='text' name='codigo'   value=".$ver['codigo']." readonly='readonly'></td></tr>";   
		   echo "<tr class='modo1'> 
		         <td class='modo3'>Nombre</td>";
		   echo"<td class='modo2'><input type='text' name='nombre'   value=".$ver['nombre']."></td> </tr>"; 
		   echo"<tr class='modo1'> 
		        <td class='modo3'>Apellido</td>";
		   echo"<td class='modo2'><input type='text' name='apellido' value=".$ver['apellido']."></td> </tr>";
           echo"<tr class='modo1'> 
		        <td class='modo3'>Salario</td>";
		   echo"<td class='modo2'><input type='text' name='salario'  value=".$ver['salario']."></td> </tr>";
		   echo"<tr class='modo1'> 
		        <td class='modo3'>Extras</td>";
		   echo"<td class='modo2'><input type='text' name='hora'     value=".$ver['horae']."></td> </tr>";
		   echo"<tr class='modo1'> 
		        <td class='modo3'>Sexo</td>";
		   echo"<td class='modo2'><input type='text' name='sexo'     value=".$ver['sexo']."></td> </tr>";  

			echo "</table>";
		}
	} 
 }
 
 function mostrarPlanilla()
 {  
    if(isset($_GET['buscarEmpleado']))
	{  
	  $id=htmlentities($_GET['buscarEmpleado']);
      $empleado="SELECT 
                 empleado.id AS id, 
				 empleado.apellido AS apellido, 
				 empleado.nombre AS nombre, 
				 cargo.puesto AS cargo,
				 empleado.salario AS salario, 
				 empleado.horae AS horas, 
				 (empleado.salario + empleado.horae) AS total, 
				 retenciones.isss AS isss, 
				 retenciones.afp AS afp, 
				 retenciones.renta AS isr,
				(empleado.salario + empleado.horae-retenciones.isss-retenciones.afp - retenciones.renta ) as liquido
                 FROM empleado, cargo, retenciones
                 WHERE empleado.codigo = cargo.codigo
                 AND empleado.id = retenciones.id AND empleado.id=".$id;
      $consulta=mysql_query($empleado) or die(mysql_error());
	  
	  while($ver = mysql_fetch_array($consulta))
		{
		   echo "<table border=1 class='tabla'>";
		   echo"<input type='hidden' name='id'   value=".$ver['id'].">";   
		   echo"<tr class='modo1'> 
				  <td rowspan='2'>Id</td> 
				  <td colspan='2'>Empleado</td>
				  <td rowspan='2'>Cargo </td> 
				  <td rowspan='2'>Salario Base</td> 
	              <td>Otros Ingresos</td>
				  <td rowspan='2'>Total Devengado</td>
				  <td colspan='3'>Retenciones</td>
				  <td rowspan='2'>Salario a Pagar</td>
				</tr> 
				<tr class='modo1'> 
				  <td>Apellido</td>
				  <td>Nombre</td>
				  <td>Horas Extras</td>
				  <td>ISSS</td>
				  <td>AFP</td> 
				  <td>ISR</td>
		        </tr>";
		   echo"<tr class='modo2'>"; 
		   echo"<td>".$ver['id']."</td>";
		   echo"<td>".$ver['apellido']."</td>";
		   echo"<td>".$ver['nombre']."</td>";
		   echo"<td>".$ver['cargo']."</td>";
		   echo"<td>$".$ver['salario']."</td>";
		   echo"<td>".$ver['horas']."</td>";
		   echo"<td>$".round($ver['total'],2)."</td>";
		   echo"<td>$".round($ver['isss'],2)."</td>";
		   echo"<td>$".round($ver['afp'],2)."</td>";
		   echo"<td>$".round($ver['isr'],2)."</td>";
		   echo"<td>$".round($ver['liquido'],2)."</td>";
		   echo"</tr>";
           echo "</table>";
		}
	} 
 }
 
 function actualizaEmpleado()
 {
    $id=$_GET['id'];  
    $codigo=$_GET['codigo'];    
    $nombre=$_GET['nombre'];
    $apellido=$_GET['apellido'];
    $salario=$_GET['salario'];
    $hora=$_GET['hora'];
    $sexo=$_GET['sexo']; 
	
	$actualiza="UPDATE empleado SET codigo='".$codigo."', nombre='".$nombre."' , apellido='".$apellido."', salario='".$salario."', horae='".$hora."', sexo='".$sexo."' WHERE id=".$id;
	mysql_query($actualiza) or die(mysql_error());
	echo "<script type=\"text/javascript\" >
               alert('Se ha logrado Actualizar.');
               setTimeout(\"location.href='empleadosActualizar.php'\",1);
            </script>";
 
 }
 
 function mostrar()
 {  
      $usuario="SELECT nombre, apellido FROM empleado";
      $consulta=mysql_query($usuario) or die(mysql_error());
	  echo "<table border='1' aling='left' class='tabla'>";
	  echo "<tr class='modo3'>  
		         <td>Correlativo </td>
			     <td>nombre </td>
			     <td>apellido </td>
			</tr>";		 
	  $i=1;  
	  while($ver = mysql_fetch_array($consulta))
		{
		   echo "<tr class='modo2'>"; 
		     echo"<td > ".$i." </td>"; 
		     echo"<td > ".$ver['nombre']." </td>"; 
		     echo"<td > ".$ver['apellido']." </td>"; 
		   echo "</tr>"; 
		   $i++;
		}
	   echo "</table>";
} 
 
 
 ?>  
 
 <?php

}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../index.php';
          </script>";
    }
?>
