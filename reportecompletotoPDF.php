<?php
include('procesos/session.php');

include('procesos/conexion.php');

$sql_carreras="SELECT cod_esc, Facultad FROM escuelas WHERE cod_nuc=$cod_nuc_prof";
$result_carreras=mysql_query($sql_carreras);

//$sql_materias="SELECT cod_mat, sec_mat,cod_nuc, (SELECT COUNT(*) FROM horamate WHERE cod_mat=secciones.cod_mat AND sec_mat=secciones.sec_mat AND cod_nuc=secciones.cod_nuc AND lapso=secciones.lapso) as horasmateria FROM secciones WHERE "


	ob_start();
    include(dirname(__FILE__).'/reportecompleto.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('Pr', 'A4', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('REPORTECOMPLETO.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>