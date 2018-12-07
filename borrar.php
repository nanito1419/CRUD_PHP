<?php

include("conexion.php");

$argu=$_GET["Id"]; // el $_GET[nombre del parametro q se envia]

$base->query("DELETE FROM datos_usuarios WHERE ID='$argu'");

header("location:mostrar_CRUD.php");

?>