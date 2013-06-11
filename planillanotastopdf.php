<?php
include('lib/session.php');

include('lib/conexion.php');

$cod_mat=$_GET['cod_mat'];
$sec_mat=$_GET['sec_mat'];
$cod_nuc_mat=$_GET['cod_nuc_mat'];
$corte=$_GET['corte'];
//descripcion de la materia
$sql_des_materia="SELECT des_mat FROM materias WHERE cod_mat='$cod_mat' LIMIT 0,1";
$result_des_materia=mysql_query($sql_des_materia);
$des_mat=mysql_fetch_assoc($result_des_materia);
//datos del profesor
$sql_profesor="SELECT nombres, apellidos FROM profesores WHERE cedula=$cedula";
$result_profesor=mysql_query($sql_profesor);
$profesor=mysql_fetch_assoc($result_profesor);
//numero de cortes del semestre
$sql_num_cortes="SELECT valores FROM tbl_configuraciones WHERE descripcion='num_cortes_semestre'";
$result_num_cortes=mysql_query($sql_num_cortes);
$num_cortes=mysql_fetch_assoc($result_num_cortes);
//porcentajes del corte
for($z=1;$z<=$num_cortes['valores'];$z++)
{
    ${'sql_max_eval_corte'.$z}="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_corte_".$z."'";
    ${'result_max_eval_corte'.$z}=mysql_query(${'sql_max_eval_corte'.$z});
    ${'max_evaluaciones_corte'.$z}=mysql_fetch_assoc(${'result_max_eval_corte'.$z});
}
$sql_porcentajes="SELECT * FROM calificaciones_plan_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat";
$result_porcentajes=mysql_query($sql_porcentajes);
$porcentajes=mysql_fetch_assoc($result_porcentajes);
//inscritos y notas
$sql_inscritos="SELECT cedula FROM inscripciones WHERE lapso=$lapso AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat ORDER BY CEDULA";
$result_inscritos=mysql_query($sql_inscritos);
$cantinscritos=mysql_num_rows($result_inscritos);
$paginacion=ceil($cantinscritos/18);
$idcod=0;
$codigo=0;
while($inscritos=mysql_fetch_assoc($result_inscritos))
{
    $idcod++;
    $sql_porcentajes="SELECT * FROM calificaciones_plan_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat";
    $result_porcentajes=mysql_query($sql_porcentajes);
    $porcentajes=mysql_fetch_assoc($result_porcentajes);
    $sql_estudiantes="SELECT NOM_APE from estudiantes WHERE CEDULA=".$inscritos['cedula'];
    $result_estudiantes=mysql_query($sql_estudiantes);
    $nombres_estu=mysql_fetch_assoc($result_estudiantes);
    $sql_notas="SELECT * FROM calificaciones_parciales_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat AND CEDULA=".$inscritos['cedula'];
    $result_notas=mysql_query($sql_notas);
    $notas=mysql_fetch_assoc($result_notas);
    $totalnota=0;
    $totalcorte=0;
    for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
    {
        if(!empty($notas['CALIF_'.$corte.$i.'']))
        {
            $totalnota=($notas['CALIF_'.$corte.$i.'']*$porcentajes['PORC_'.$corte.$i.''])/100;
            $totalcorte=$totalcorte+$totalnota;
        }
    }
    $codigo=$codigo+($idcod*$inscritos['cedula']*$totalcorte);
}

   ob_start();
    include(dirname(__FILE__).'/planillanotascorte.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('L', 'Legal', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('PLANILLANOTAS.pdf');
    }
    
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>