<?php
 
session_start(); 
class Conexion
{
    public static function conectar()
    {
		$sql=mysql_connect("localhost","root","root");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db("catalogo");
		return	$sql;
	}
    
   
 }
?>



 
