 <?php 

require_once("Conexion/Login.php");
if(isset($_POST["envio"]) and $_POST["envio"] == "si")
{
    $conectar = new Login();
    $conectar-> acceso();
    exit;
} 
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
  <head>
    <title> Industrializaci&#243;n de la Leche para obtener L&#225;cteos de Especialidad</title>
    <meta name="keywords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="all"/> 
      <link href="style.css" rel="stylesheet" type="text/css" media="all"/> 
	<script type="text/javascript" src="JavaScript/validar.js"></script>
    <base target="_top">
 </head>



<body onload="limpiarLogin();">

<div id="wrapper">   
	<div id="pagina">
	<header> 
    </header>

        <table class="tabla">
        <TR  class="modo1">
            <TD width="60%">
			    <div id="content" align="justify">      
		          <h4> <?php include 'usuarios/Intro.php'; ?></h4>
		        </div>
            </TD>
                
            <TD width="40%"> 
			    <div id="sidebar" >
	            <div >
	            <h3>Iniciar sesi&#243;n</h3>					
		       	<form id="login" name="login" method="post" action="">
				<span style="color:#0xFFFFFF; font-size:12px; size=10 ">Usuario</span> <br> 
				<input type="text" id="usuario" name="usuario" value="bender"/><br><br>
        
				<span style="color:#0xFFFFFF; font-size:12px;">Contrase&#241;a</span><br> 
				<input type="password" id="password"  name="password" value="123456"/><br><br>
              
				<input class="button-style" type="button" value="INGRESAR" onclick="validaLogin();" /> 
				<p><input type="hidden" name="envio" value="si" /></p>
				<br/>
		
				</form>	 

		        </div>
			    </div>
           </TD> 
        </TR>
        <TR class="modo2"> 
            <td colspan="2">
                <p align="center"> Industrializaci&#243;n de la Leche para obtener L&#225;cteos de Especialidad </p>
                <p> </p>
           </td> 
        </TR>  
        </TABLE>   
   
	    <div >
		   <p>Copyright (c) 2014 </p>
	    </div>
              
    </div> 
 </div> 	
</body>
</html>