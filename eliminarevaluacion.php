<?php
include('lib/session.php');


$id=$_GET['id'];
$cod_mat=$_GET['cod_mat'];
$sec_mat=$_GET['sec_mat'];
$cod_nuc_mat=$_GET['cod_nuc_mat'];

include('lib/conexion.php');

$sql="DELETE FROM plan_evaluacion WHERE ced_prof='$cedula' AND id='$id' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat'";
$resultado=mysql_query($sql);

header("Location: planevaluacioneliminar.php?cod_mat=$cod_mat&sec_mat=$sec_mat&cod_nuc_mat=$cod_nuc_mat");

?>