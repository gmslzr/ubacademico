<?php
include('conexion.php');

$sql="SELECT * FROM tbl_configuraciones";
$rs=mysql_query($sql);

while($prof=mysql_fetch_assoc($rs)){
	echo '<pre>';
	echo $prof['valores'].' - '.$prof['descripcion'];
	echo '</pre>';
}


?>