<?php
include('lib/session.php');

include('lib/conexion.php');

$cod_mat=$_GET['cod_mat'];
$sec_mat=$_GET['sec_mat'];
$cod_nuc_mat=$_GET['cod_nuc_mat'];

$sqlcatedra="SELECT cod_catedra as catedra FROM h_catemate WHERE cod_mat='$cod_mat'";
$sqlresultcatedra=mysql_query($sqlcatedra);
$fila3=mysql_fetch_assoc($sqlresultcatedra);
$catedra=$fila3['catedra'];

$sqlescuela="SELECT cod_escu FROM h_catedra WHERE cod_catedra='$catedra'";
$sqlresultescuela=mysql_query($sqlescuela);
$fila4=mysql_fetch_assoc($sqlresultescuela);
$escuela=$fila4['cod_escu'];

$sqlescueladescripcion="SELECT Facultad, Dfacultad FROM escuelas WHERE cod_esc='$escuela'";
$sqlresultadodescripcion=mysql_query($sqlescueladescripcion);
$fila5=mysql_fetch_assoc($sqlresultadodescripcion);
$des_escuela=$fila5['Facultad'];
$des_facultad=$fila5['Dfacultad'];


	$sql="SELECT *, (SELECT nombres FROM profesores WHERE cedula=secciones.ced_prof) as nombre, (SELECT apellidos FROM profesores WHERE cedula=secciones.ced_prof) as apellido,  (SELECT des_mat FROM materias WHERE cod_mat='$cod_mat' LIMIT 0,1) as des_mat  FROM secciones WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso=$lapso AND cod_nuc=$cod_nuc_mat AND ced_prof=$cedula";
	$sqlresultado=mysql_query($sql);
	$cant=mysql_num_rows($sqlresultado);
	$fila2=mysql_fetch_assoc($sqlresultado);
	if($cant>0)
	{
		$sql ="SELECT *, (SELECT nom_ape FROM estudiantes WHERE cedula=inscripciones.cedula LIMIT 0,1) AS nombre FROM inscripciones WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso=$lapso AND cod_nuc=$cod_nuc_mat";
		$sqlresultado=mysql_query($sql);
	}else  {
	

	}

//Acomodar minusculas a mayusculas
$des_facultad=strtoupper($des_facultad);
$fila2['apellido']=strtoupper($fila2['apellido']);
$fila2['nombre']=strtoupper($fila2['nombre']);

    ob_start();
    include(dirname(__FILE__).'/listadoalumno.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('Pr', 'Letter', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('LISTADOALUMNO.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>