<?php
include('../lib/session.php');

include('../lib/conexion.php');
$Success=false;
$Error=true;

$cedula_doc=$_POST['cedula_doc'];
$cod_esc=$_POST['escuela'];
$cod_mat=$_POST['materia'];
$sec_mat=$_POST['seccion'];
$lapso_cons=$_POST['lapso_cons']; 

$sql_cedula="SELECT * FROM profesores WHERE cedula='$cedula_doc'";
$result_cedula=mysql_query($sql_cedula);
$fila_cedula=mysql_fetch_assoc($result_cedula);

$sql_materia="SELECT * FROM materias WHERE cod_mat='$cod_mat'";
$result_materia=mysql_query($sql_materia);
$fila_materia=mysql_fetch_assoc($result_materia);

$sql_escuela="SELECT * FROM escuelas WHERE cod_esc='$cod_esc'";
$result_escuela=mysql_query($sql_escuela);
$fila_escuela=mysql_fetch_assoc($result_escuela);

$sql="SELECT * FROM encuesta_estudiantes WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso_cons'";
$resultado=mysql_query($sql);
$fila_resultado=mysql_fetch_assoc($resultado);
$fecha=$fila_resultado['fecha'];

$sql_obs_es="SELECT * FROM observaciones_planif WHERE id_tipo ='1' AND cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso_cons'";
$result_obs_es=mysql_query($sql_obs_es);
$cant=mysql_num_rows($result_obs_es);

if(!is_numeric($cedula_doc) || strlen($cedula_doc)<6 || strlen($cedula_doc)>8)
{
    header("Location: consultaencuestaestudiantes.php?h=1");
}
if(empty($cod_mat))
{
    header("Location: consultaencuestaestudiantes.php?i=1");
}
if(empty($cod_esc))
{
    header("Location: consultaencuestaestudiantes.php?j=1");
}
if(empty($sec_mat))
{
    header("Location: consultaencuestaestudiantes.php?k=1");
}
if(empty($lapso_cons))
{
    header("Location: consultaencuestaestudiantes.php?l=1");
}

function truncateFloat($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
}

$date=explode("-", $fecha);

  ob_start();
    include(dirname(__FILE__).'/promedioencuestaestudiantes.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('L', 'Letter', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('PromedioEncuestaEstudiantes.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


?>