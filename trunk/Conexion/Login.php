<?php
include "Conexion.php";
 

class Login{
    
    
    public function acceso()
    {
	    if(isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['password']) && !empty($_POST['password']) )
		{
        $usuario =($_POST['usuario']);
        $password = base64_encode($_POST['password']); 
		
        $sql = "SELECT * FROM usuarios
                WHERE usuario='$usuario'
                AND password='$password'";
        
        $res = mysql_query($sql,Conexion::conectar());
        
        if(mysql_num_rows($res) == 0){
		
            echo "<script type='text/javascript'>
                    alert('Los datos ingresados no existen en la Base de Datos');
                    window.location = 'index.php';
                  </script>";
        }else{
            if($reg = mysql_fetch_array($res)){
                $_SESSION["id"] = $reg["id"];
				$_SESSION["nivel"] = $reg["nivel"];
                header("Location: inicio.php");
            }
        }
		}
    }
	/*
	  public function finaliza()
      {
	    session_start();
        //session_unregister("id");
        //session_unregister("nivel");
        session_destroy();
        header("Location: ../index.php");  
	  }
	 */

   
	
}
?> 