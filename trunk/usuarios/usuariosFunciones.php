<?php

function  agregarUsuario()
{

if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['apellido']) && !empty($_POST['apellido']) && isset ($_POST['usuario']) && !empty($_POST['usuario'])&&isset($_POST['nivel']) && !empty($_POST['nivel']) &&isset($_POST['password']) && !empty($_POST['password']) ) 
{
  $nombre=htmlentities($_POST['nombre']);
  $apellido=htmlentities($_POST['apellido']);
  $usuario=htmlentities($_POST['usuario']);
  $password=base64_encode($_POST['password']);
  $nivel=htmlentities($_POST['nivel']);
  
  $usuario="insert into usuarios(nombre,apellido,usuario,password,nivel) values('".$nombre."','".$apellido."','".$usuario."','".$password."','".$nivel."')";
  mysql_query($usuario) or die(mysql_error());  
  
  echo "<script type=\"text/javascript\" >
               alert('Los datos se han introducido correcptamente.');
               setTimeout(\"location.href='usuarioAgregar.php'\",1);
            </script>";
}

else 
   {

       echo "<script type=\"text/javascript\" >
               alert('Error no se ha podido ingresar los datos del usuario');
               setTimeout(\"location.href='usuarioAgregar.php'\",1);
            </script>";

   }
   
 }
 
 function buscarUsuario()
 {
   $empleado="SELECT id, nombre, apellido FROM usuarios";
   $consulta=mysql_query($empleado) or die(mysql_error());

   echo "<select name='buscarUsuario'>";
            echo "<option value='0'>Seleccione un Usuario</option>";
		while($ver = mysql_fetch_array($consulta))
		{
			echo "<option value=".$ver['id'].">".$ver['nombre']." ".$ver['apellido']."</option>";
		}
   echo "</select>"; 
   echo "<br>";   
 }
 
function eliminaUsuario()
{
  if(isset($_POST['buscarUsuario']) && !empty($_POST['buscarUsuario']) ) 
  {
     $id=htmlentities($_POST['buscarUsuario']);
	 $elimina="DELETE FROM usuarios WHERE id =".$id; 
	 mysql_query($elimina) or die(mysql_error());
	 
	 echo "<script type=\"text/javascript\" >
               alert('El usuario se ha eliminado con exito.');
               setTimeout(\"location.href='usuarioEliminar.php'\",1);
            </script>";
	 
  }
  else 
     {

       echo "<script type=\"text/javascript\" >
               alert('Error no se ha podido eliminar usuario');
               setTimeout(\"location.href='usuarioEliminar.php'\",1);
            </script>";

     }
 } 
 
 function mostrarUsuario()
 {  
    if(isset($_GET['buscarUsuario']))
	{  
	  $id=htmlentities($_GET['buscarUsuario']);
      $empleado="SELECT id, nombre, apellido, usuario, password, nivel FROM usuarios WHERE id=".$id;
      $consulta=mysql_query($empleado) or die(mysql_error());
	  echo"<br><br>";
	  while($ver = mysql_fetch_array($consulta))
		{
		   echo "<table border='1' aling='center' class='tabla'>";
                 
		   echo"<input type='hidden' name='id'   value=".$ver['id'].">";   
		   
		   echo "<tr class='modo1'> 
		         <td class='modo3'>Nombre</td>";
		   echo"<td class='modo2'><input type='text' name='nombre'   value=".$ver['nombre']."></td> </tr>"; 
		   
		   echo"<tr class='modo1'> 
		        <td class='modo3'>Apellido</td>";
		   echo"<td class='modo2'><input type='text' name='apellido' value=".$ver['apellido']."></td> </tr>";
           echo"<tr class='modo1'> 
		        <td class='modo3'>Usuario</td>";
		   echo"<td class='modo2'><input type='text' name='usuario'  value=".$ver['usuario']."></td> </tr>";
		   echo"<tr class='modo1'> 
		        <td class='modo3'>Password</td>";
		   echo"<td class='modo2'><input type='text' name='password'     value=".base64_decode($ver['password'])."></td> </tr>";
		   echo"<tr class='modo1'> 
		        <td class='modo3'>Nivel</td>";
		   echo"<td class='modo2'><input type='text' name='nivel'     value=".$ver['nivel']."></td> </tr>";  

			echo "</table>";
		}
	} 
 }
 

 function actualizaUsuario()
 {
    $id=$_GET['id'];  
    $nombre=$_GET['nombre'];
    $apellido=$_GET['apellido'];
	$usuario=$_GET['usuario'];    
    $password=base64_encode($_GET['password']);
    $nivel=$_GET['nivel'];

	$actualiza="UPDATE usuarios SET  nombre='".$nombre."' , apellido='".$apellido."', usuario='".$usuario."' , password='".$password."', nivel='".$nivel."'  WHERE id=".$id;
	mysql_query($actualiza) or die(mysql_error());
	echo "<script type=\"text/javascript\" >
               alert('Se ha logrado Actualizar.');
               setTimeout(\"location.href='usuarioActualizar.php'\",1);
            </script>";
 
 }
 
 function mostrar()
 {  
      $usuario="SELECT nombre, apellido, usuario FROM usuarios";
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


function mostrarPeriodo()
{
   $periodo="SELECT * FROM periodocontable";
   $consulta=mysql_query($periodo) or die(mysql_error());
   while($ver = mysql_fetch_array($consulta))
   { 
        echo " <form name='actualiza' method='post' action='usuariosRegistra.php'>";
	    echo "<table border='1' aling='center' class='tabla'>";
                 
           echo "<tr class='modo1'> 
		         <td class='modo3'>Periodo</td>"; 
		   echo"<td class='modo2'><input type='text' name='periodo'   value=".$ver['periodo']." readonly='readonly'></td></tr>";
		   
		   echo "<tr class='modo1'> 
		         <td class='modo3'>Inicio Periodo</td>";
		   echo"<td class='modo2'><input type='text' name='fechainicio'   value=".$ver['fechainicio']."></td> </tr>"; 
		   
		   echo"<tr class='modo1'> 
		        <td class='modo3'>Fin de Periodo</td>";
		   echo"<td class='modo2'><input type='text' name='fechafin' value=".$ver['fechafin']."></td> </tr>";
		   
           echo"<tr class='modo1'> 
		        <td class='modo3'>Fecha Actual</td>";
		   echo"<td class='modo2'><input type='text' name='fechaactual'  value=".$ver['fechaactual']." disabled></td> </tr>";
 
		echo "</table>";
   }
   
}


function actualizaPeriodo()
{
  
     $i=$_POST['fechainicio'];
	 $f=$_POST['fechafin'];
     $actualiza="UPDATE periodocontable SET fechainicio ='".$i."' , fechafin ='".$f."' WHERE id =1";
	 mysql_query($actualiza) or die(mysql_error());
	 echo "<script type=\"text/javascript\" >
               alert('Se ha logrado Cambiar el Periodo Contable.');
               setTimeout(\"location.href='cerrarPeriodo.php'\",1);
            </script>";
  
}

function intro()
{
  echo "El periodo contable, como uno de los principios de Contabilidad considerados por nuestra legislación, se refiere a que las operaciones económicas de una empresa se deben reconocer y registrar en un determinado tiempo, que por regla general es de un año, que va desde el 01 de enero a 31 de diciembre. El existir el periodo contable, nos permite medir el desempeño de la empresa al compararlo con otros periodos. El periodo contable permite que se cumpla uno de los principales objetivos de la contabilidad que es su utilidad.";
}
 
 ?>  