<?php
include('../lib/session.php');
include('../lib/conexion.php');



$lpsc=$_GET['lpsc'];

$sqlestudiantes= "SELECT *,(SELECT NOM_APE FROM estudiantes WHERE cedula=listaalumnos.cedula) as NOM_APE ,(SELECT nom_emp FROM empresas WHERE codEmp=listaalumnos.codEmp) as nom_emp, (SELECT codPer FROM empresas_area WHERE codEmp= listaalumnos.codEmp) as codPer, (SELECT codTutor FROM empresas_tutor WHERE codEmp= listaalumnos.codEmp) as codTutor FROM listaalumnos WHERE cod_escuela =$cod_pas_escu and lapso = $lapso" ;
$sqlresultado = mysql_query($sqlestudiantes);
$alumnos = array();
while ($fila=mysql_fetch_assoc($sqlresultado)){
	$alumnos[] = $fila;
}
$paginas = ceil(sizeof($alumnos) / 30);

function mostrarArea($codPer){
        if($codPer == ""){
            return "Esta empresa aun no tiene area.";
        }
        include('../lib/conexion.php');

        $sqlAreas = "SELECT perfil FROM perfiles WHERE codPer = $codPer";
        //Ejecutar la consulta
        $areas = mysql_fetch_array(mysql_query($sqlAreas));
        return $areas['perfil'];
        }

function mostrarTutor($codTutor){
        if($codTutor == ""){
            return "No tiene tutor asignado.";
        }
        include('../lib/conexion.php');

        $sqlTutor = "SELECT nombre FROM tutorindustrial WHERE codTutor = $codTutor";
        //Ejecutar la consulta
        $tutor = mysql_fetch_array(mysql_query($sqlTutor));
        return $tutor['nombre'];
        }



ob_start();
    include(dirname(__FILE__).'/informe.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'Letter', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('INFORMEDEGESTION.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>