<?php

require_once("../Conexion/Login.php");
if($_SESSION['nivel']=='1')
{

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/boton.css" media="screen" />
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
  
   <form action="usuariosRegistra.php" method="post" id="eliminaUsuario">
 
   <fieldset> 
   <legend>Eliminar Usuario</legend>
   <table> 
     <tr>
	 <td>
     <?php
       buscarUsuario();
     ?>
     </td>
	
	 <td>
        <input type="submit" class="boton purpura" value="Eliminar"/>
        <input  type="hidden" name="elimina"  value="si" /> 
	 </td>	
     </tr>	
   </table>	 
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
