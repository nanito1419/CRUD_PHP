<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

<h1>ACTUALIZAR</h1>

<?php
 
include ("conexion.php");  // esto es para hacer la actualizacion desde la misma pagina sin crear otro archivo PHP que haga el update
if (!isset($_POST["bot_actualizar"])) {  //si no has pulsado el boton actualizar ejecuta o captura las variables $_GET


$id=$_GET["Id"];  //se capturan todads los datos q sevan actualizar con su debido parametro ya luego se crea la variable que quieras
$nom=$_GET["Nom"];
$ape=$_GET["Ape"];		
$dir=$_GET["Dir"];

}else {  //de lo contrario. si pulsaste el boton ejecuta o as esto!!

	$id=$_POST["id"]; //pero ahora capturando con el nombre del formulario, no con el del CRUD
	$nom=$_POST["nom"];
	$ape=$_POST["ape"];
	$dir=$_POST["dir"];
	//se hace laistruccion SQL para prepararla y evitar inyeccion.
	$sql="UPDATE datos_usuarios SET Nombre=:minom, Apellido=:miape, Direccion=:midir WHERE ID=:miid";  //la consulta se hara con marcadores, teniendo en cuenta que el where es el critero ola linea que modificare q es el id
	$resultado=$base->prepare($sql); //preparando array
	$resultado->execute(array(":miid"=>$id, ":minom"=>$nom, ":miape"=>$ape, ":midir"=>$dir )  );  //aqui se ejecuta y se asigna a los criteros (:miid,minom,miape) los valores que se capturaron en las variables de $_POST

	header("location:mostrar_CRUD.php");


}

?>


<p>
 
</p>
<p>&nbsp;</p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">  <!-- se envia los datos por POST para no generar complicaciones en cuanto a sobre escribir en las variables $_GET y <?php echo $_SERVER['PHP_SELF'];?> ES para recargar y enviar los datos de POST a la misma pagina -->
  <table width="25%" border="0" align="center">
    <tr>
      <td></td>
      <td><label for="id"></label>
      <input type="hidden" name="id" id="id" value="<?php echo $id ?>"> <?php echo $id ?> </td> <!-- el hidden es para poder escribir un texto pero oculto en su propiedadpor ejemplo value="<?php echo $id ?> ... tener en cuenta que si no pongo el atribute value no va a capturar la variable indispensable para el WHERE en la UPDATE -->
    </tr>
    <tr>
      <td>Nombre</td>
      <td><label for="nom"></label>
      <input type="text" name="nom" id="nom" value=" <?php echo $nom ?> "></td> <!-- se te el codigo php dentro de input en el atributo value para q el dato se vea desde dentro del cuadro de texto y no desde fuera-->
    </tr>
    <tr>
      <td>Apellido</td>
      <td><label for="ape"></label>
      <input type="text" name="ape" id="ape" value="<?php echo $ape ?>"> </td>
    </tr>
    <tr>
      <td>Dirección</td>
      <td><label for="dir"></label>
      <input type="text" name="dir" id="dir" value="<?php echo $dir ?>"> </td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>