<?php

try{
	$base=new PDO("mysql:host=localhost; dbname=prueba", "root", "");
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$base->exec("SET CHARACTER SET UTF8"); 

}catch(Exception $e) {
	die("error" . $e->getMessage());

	echo "linea del error" . $e->getLine();
	 
}
?> 