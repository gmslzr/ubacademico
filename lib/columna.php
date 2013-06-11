<?php
include('conexion.php');

$sql="ALTER TABLE profesores ADD COLUMN escuela int (2)";
$rs=mysql_query($sql);
echo 'listo';

?>