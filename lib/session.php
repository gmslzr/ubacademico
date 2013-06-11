<?php
session_start();

if($_SESSION['Login']!=true)
{
	header('Location: index.php');
}
$coord_estatus=$_SESSION['coord_estatus'];
$cedula=$_SESSION['cedula'];
$lapso=$_SESSION['lapso'];
$nombres=$_SESSION['nombres'];
$apellidos=$_SESSION['apellidos'];
$nucleo=$_SESSION['nucleo'];
$cod_nuc_prof=$_SESSION['cod_nuc_prof'];

if($coord_estatus==1)
{
	$i=1;
	for ($i=1; $i<=$_SESSION['i'] ; $i++)
	{
		$coordinacion=explode("/",$_SESSION['cod_coord'.$i]);
		$sercom=explode("M", $_SESSION['cod_coord'.$i]);

		if($coordinacion[0]=='PLA')
		{
			//genera la variable para la coordinacion de planificacion
			$coord_pla=1;
			$cod_plan=$_SESSION['cod_coord'.$i];
			$cod_plan_escu=$_SESSION['cod_escu'.$i];
		}
		elseif($coordinacion[0]=='PAS')
		{
			//genera la variable para la coordinacion de pasantia
			$coord_pas=1;
			$cod_pas=$_SESSION['cod_coord'.$i];
			$cod_pas_escu=$_SESSION['cod_escu'.$i];
		}
		elseif($coordinacion[0]=='INV')
		{
			//genera la variable para la coordinacion del centro de investigaciones
			$coord_inv=1;
			$cod_inv=$_SESSION['cod_coord'.$i];
			$cod_inv_escu=$_SESSION['cod_escu'.$i];
		}
		elseif ($sercom[0]=='SCO') 
		{
			//genera la variable para la coordinacion de servicio comunitario
			$coord_scom=1;
			$cod_scom=$_SESSION['cod_coord'.$i];
			$cod_scom_escu=$_SESSION['cod_escu'.$i];
		}elseif($_SESSION['cod_coord'.$i]=='GESAC')
		{
			$coord_gesac=1;
			$cod_gesac=$_SESSION['cod_coord'.$i];
		}else
		{
			//genera la variable para la coordinacion de catedra
			$coord_cat=$i;
			${"cod_catedra".$i}=$_SESSION['cod_coord'.$i];
			${"cod_catedra_escu".$i}=$_SESSION['cod_escu'.$i];
		}
	}
}
?>