<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>pagina de consutal CRUD</title>
</head>
<body BGCOLOR="#99aaff">

	<?php

	include ("conexion.php");

	/*$conexion=$base->querry("SELECT * FROM datos_usuario_crud"); //por medio delllamado de la base de dato se cra una variable $conexion donde se guarda la ejecucion de la consulta
	//se debe almacenar la instruccion en un array de objeto para poder utilizar la informacion mas adelante para registrar modificar.
	$registros=$conexion->fetchall(PDO::FETCH_OBJ); //prepara en un array y devuelve array pero como un objeto para utilizar tambien sus propiedades.*/
	// tambien se puede escribir en 1 sola linea
	$registro=$base->query("SELECT * FROM datos_usuarios")->fetchAll(PDO::FETCH_OBJ);

//esto es para el apcion insertar
	if (isset($_POST["crear"])) { //si se preciono el boton insertar entonces ejecuta
		$nombre=$_POST["Nombre"]; //guardame en una variable lo q el usuario escribio en el cuadro de texto "Nombre"
		$apellido=$_POST["Apellido"];//guardame en una variable lo q el usuario escribio en el cuadro de texto "Apellido"
		$direccion=$_POST["Direccion"];//guardame en una variable lo q el usuario escribio en el cuadro de texto "Direccion"

	$sql="INSERT INTO datos_usuarios (Nombre, Apellido, Direccion) VALUES (:NOM, :APE, :DIR )";
	//(nombre indice de la base de dato) VALUES (marcadores para guardar los valores en orden a los indicadores)
	$resultado=$base->prepare($sql);// prepara la sentencia o instruccion sql en array
	$resultado->execute(array(":NOM"=>$nombre, ":APE"=>$apellido, ":DIR"=>$direccion));// ejecucion del array asignandoles y guardando los valores de las variables que se capturaron con POST a los marcadores

	 header("location:mostrar_CRUD.php");// esto es para refrescar y ver la actualizacion 
		
	}

	?>

	<table align="center">
		<tr><td> <font size="7" color="ffff99"><p  align="center"><b>CRUD</b></p></font> </td><td><front><p align="CENTER">Create Read Update Delete</p></front> </td></tr>
				
				
</table>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- esto es para recargar la pagina de nuevo cuando se precione el boton q tenga como atributo submit, para asi enviar la informacion a la misma pagina y reutilizarla, en este caso en el boton insrtar para crear un nuevo dato -->
<TABLE ALIGN="CENTER" border="5" width="30" height="30">
	
	<tr><td><b>ID</b></td> <td><b>NOMBRE</b></td><td><b>APELLIDO</b></td><td><b>DIRECCION</b></td></tr>

	<?php
	foreach($registro as $persona):?> <!--//repite codigo tantas veces haiga interaccion en el array obj y cada interacion guardamelo en $persona como objeto y :? es para no utilizar llaves y tener que concatenar las cosas -->
	   
	<tr><td><?php echo $persona->ID ?> </td> <td> <?php echo $persona->Nombre ?> </td> <td><?php echo $persona->Apellido ?> </td><td><?php echo $persona->Direccion ?> </td><!-- final de las casillas--><td> <!-- comienzode la casilla del botton-->
<!-- <a es para llamar dirigirse al archivo borrar donde con "?" le digo que le voy a pasar un parametro o variable puede ser cualquier nombre, =es para darle el valor que tendra ese parametro puede ser constante o puedo capturar el valor por medio del GET asi <?php echo $persona->ID?>   -->
		<a href="borrar.php?Id=<?php echo $persona->ID?>"> <INPUT TYPE="button" id="del" name="del" VALUE="BORRAR"></a></td><!--aqui termina la celda del boton -->
		   
		   <td><a href="editar.php?Id=<?php echo $persona->ID ?> & Nom=<?php echo $persona->Nombre ?> & Ape=<?php echo $persona->Apellido ?> & Dir=<?php echo $persona->Direccion ?>">  <input type="button" name="BOTON" value="ACTULIZAR"></a> </td></tr>

	<?php
endforeach; //sentencia de final de la llave o del codigo que tendra que repetir el foreach
?>

	<TR> <TD> </TD> <TD><input type="text" name="Nombre" size="20" maxlength="15"> </TD><td><input type="text" name="Apellido" size="20" maxlength="15"></td><td><input type="text" name="Direccion" size="20" maxlength="15"></td> <td><input type="submit" name="crear" id="crear" value="INSERTAR"> </td></TR>

	</TABLE>
</form>

<h2 align="CENTER">CRUD LISTO</h2>
</body>
</html>