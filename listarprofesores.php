<?php
session_start();

if($_SESSION['Loginadmin']!=true)
{
	header('Location: index.php');
}
include('lib/conexion.php');

$sql="SELECT * FROM profesores";
$rs=mysql_query($sql);

function mostrarNucleo($x)
{
	if($x==""){
		return "Este Profesor a&uacute;n no tiene n&uacute;cleo asignado";
	}
	include('lib/conexion.php');
	$sqlnuc= "SELECT des_nucleo FROM nucleos WHERE ID = $x";
	$rsnuc = mysql_fetch_array(mysql_query($sqlnuc));
	return $rsnuc['des_nucleo'];
}
function mostrarCoordinacion($x)
{
	
	include('lib/conexion.php');
	$sql_cod_coord="SELECT cod_coord FROM coordinadores WHERE cedula= $x";
	$rs_cod=mysql_query($sql_cod_coord);
	$cant=mysql_num_rows($rs_cod);
	if($cant==0){
		return "NO";
	}
	$coordinacion="";
	while($cod=mysql_fetch_array($rs_cod))
	{
		$coord=explode("/", $cod['cod_coord']);
		$sercom=explode("M", $cod['cod_coord']);
		if($coord[0]=='PLA')
		{
			$sqldesc="SELECT valores FROM tbl_configuraciones WHERE descripcion='coord_planificacion_".$coord[1]."_desc'";
			$desc=mysql_fetch_array(mysql_query($sqldesc));
			$coordinacion.='<li>';
			$coordinacion.=strtoupper($desc['valores']);
			$coordinacion.='</li>';		
		}elseif($coord[0]=='INV')
		{
			$sqldesc="SELECT valores FROM tbl_configuraciones WHERE descripcion='coord_investigacion_".$coord[1]."_desc'";
			$desc=mysql_fetch_array(mysql_query($sqldesc));
			$coordinacion.='<li>';
			$coordinacion.=strtoupper($desc['valores']);
			$coordinacion.='</li>';	
		}elseif($coord[0]=='PAS')
		{
			$sqldesc="SELECT valores FROM tbl_configuraciones WHERE descripcion='coord_pasantia_".$coord[1]."_desc'";
			$desc=mysql_fetch_array(mysql_query($sqldesc));
			$coordinacion.='<li>';
			$coordinacion.=strtoupper($desc['valores']);
			$coordinacion.='</li>';	
		}elseif($sercom[0]=='SCO')
		{
            $sqldesc="SELECT valores FROM tbl_configuraciones WHERE descripcion='coord_sercomunitario_".$sercom[1]."_desc'";
            $desc=mysql_fetch_array(mysql_query($sqldesc));
			$coordinacion.='<li>';
			$coordinacion.=strtoupper($desc['valores']);
			$coordinacion.='</li>';

		}elseif($coord[0]=='LAB')
		{
			$sqldesc="SELECT valores FROM tbl_configuraciones WHERE descripcion='coordinacion_laboratorios_".$coord[1]."_desc'";
			$desc=mysql_fetch_array(mysql_query($sqldesc));
			$coordinacion.='<li>';
			$coordinacion.=strtoupper($desc['valores']);
			$coordinacion.='</li>';

		}elseif($cod['cod_coord']=='GESAC')
		{
			$sqldesc="SELECT valores FROM tbl_configuraciones WHERE descripcion='coordinacion_gestion_academica_desc'";
			$desc=mysql_fetch_array(mysql_query($sqldesc));
			$coordinacion.='<li>';
			$coordinacion.=strtoupper($desc['valores']);
			$coordinacion.='</li>';
		}else
		{
			$sqldesc="SELECT desc_catedra FROM h_catedra WHERE cod_catedra='".$cod['cod_coord']."'";
			$desc=mysql_fetch_array(mysql_query($sqldesc));
			$coordinacion.='<li>';
			$coordinacion.=strtoupper($desc['desc_catedra']);
			$coordinacion.='</li>';
		}
	}

	return $coordinacion;	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="google-site-verification" content="6w9FrEF8LRQPaIIOjQE2Fb1erDJQhmZuKgZJ2u0Jekg" />
		<title>Universidad Bicentenaria de Aragua date</title>
		<link src="css/estilo.css" type="text/css"/>
		<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" /> 
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="modernizr-latest.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/jquery.dataTables.js"></script>
		<link type="text/css" rel="stylesheet" href="css/jquery-ui.css" />


<style type="text/css">
.marco {
	margin:auto 25px 25px 100px; /* Centrado horizontal */
}
.cuerpo {
    padding:0px 0px 0;
    height: 1000px;
    width: 1299px;
}
.pie{
	padding-left: 250px;
}
    </style>
<style type="text/css">
            @import "css/demo_table_jui.css";
            @import "css/themes/smoothness/jquery-ui-1.8.4.custom.css";
        </style>
        
        <style>
            *{
                font-family: "Times New Roman";
            }
        </style>
        <script type="text/javascript" >
            $(document).ready(function(){
              $('#datatable').dataTable({
                   "sPaginationType":"full_numbers",
                    "aaSorting":[[0, "asc"]],
                    //"sScrollY": "350px",
                    "bJQueryUI":true

                });
            })
            function confirmDel(url){
			//var agree = confirm("¿Realmente desea eliminarlo?");
			if(confirm(String.fromCharCode(191)+"Desea realmente eliminar al profesor seleccionado?"))
				window.location.href = url;
			else
				return false ;
			}
        </script>
</head>
<body>
	<div class="marco">
		<div class="cabecera">
			<div class="columna_derecha_cabecera">
			</div>
			<div class="columna_izquierda_cabecera">
			</div>
			<div class="columna_central_cabecera">
				<div id="link_logo"><a href="menusu.php"><img src="images/logo.jpg" alt="UBA"/></a></div>
			</div>
		</div>
		<div class="cuerpo">
				<h2>Listar Profesores</h2><br>
				<table id ="datatable" class="display">
					<thead>
						<th>C&eacute;dula</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Carnet</th>
						<th>Password</th>
						<th>Coordinaci&oacute;n</th>
						<th>N&uacute;cleo</th>
						<th>Opciones</th>
					</thead>
					<tbody>
						<?php
						while($p=mysql_fetch_assoc($rs)){?>
							<tr>
								<td><?php echo $p['cedula']; ?></td>
								<td><?php echo $p['nombres']; ?></td>
								<td><?php echo $p['apellidos']; ?></td>
								<td><?php echo $p['carnet']; ?></td>
								<td><?php echo $p['password']; ?></td>
								<td><?php echo mostrarCoordinacion($p['cedula']); ?></td>
								<td><?php echo mostrarNucleo($p['cod_nuc']); ?></td>
								<td><a href="deleteprof.php?cedula=<?php echo $p['cedula'];?>" onclick="if(confirmDel() == false){return false;}">Eliminar</a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
<?php include('lib/footer.php'); ?>