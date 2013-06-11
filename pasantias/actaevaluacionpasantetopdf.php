<?php
include('../lib/session.php');
include('../lib/conexion.php');

if(isset($_POST['generar']) && $_POST['generar']='Generar PDF')
        { 
          $cedulaest=$_POST['cedulaest'];
          $nombreest=$_POST['nombreest'];
          $escuela=$_POST['escuela'];
          $nom_emp=$_POST['nom_emp'];
          $nota_indus=$_POST['nota_indus'];
          $nota_acad=$_POST['nota_acad'];
          $nota_info=$_POST['nota_info'];
          if (($nota_indus>100) || ($nota_indus<=0))
          {
            $a=1;
            header("Location: formularioactaevaluacion.php?a=$a");
          }elseif (($nota_acad>100) || ($nota_acad<=0))
          {
            $b=1;
             header("Location: formularioactaevaluacion.php?b=$b");
          }
          elseif (($nota_info>100) || ($nota_info<=0))
          {
            $c=1;
             header("Location: formularioactaevaluacion.php?c=$c");
          } 
     
        }

$sqlestudiantes= "SELECT *,(SELECT NOM_APE FROM estudiantes WHERE cedula=listaalumnos.cedula) as NOM_APE ,(SELECT nom_emp FROM empresas WHERE codEmp=listaalumnos.codEmp) as nom_emp, (SELECT codPer FROM empresas_area WHERE codEmp= listaalumnos.codEmp) as codPer, (SELECT codTutor FROM empresas_tutor WHERE codEmp= listaalumnos.codEmp) as codTutor FROM listaalumnos";
$sqlresultado = mysql_query($sqlestudiantes);

$sqlgenero = "SELECT genero FROM profesores WHERE cedula = $cedula";
$sqlresgenero = mysql_query($sqlgenero);
echo $sqlgenero;
die();

          $porcentaje= ($nota_indus + $nota_acad +$nota_info)/3;
          $total=($porcentaje*0.2);

          function truncateFloat($number, $digitos)
          {
            $raiz=10;
            $multiplicador=pow($raiz,$digitos);
            $resultado = ((int) ($number * $multiplicador))/ $multiplicador;
            return number_format($resultado, $digitos);
          }

function nombreEscuela($id){
    include('../lib/conexion.php');

    $query = "SELECT Facultad FROM escuelas WHERE cod_esc = '$id'";
    $rs = mysql_fetch_array(mysql_query($query));
    return $rs["Facultad"];
    $cod_pas_escu = strtolower($cod_pas_escu);
    $cod_pas_escu = ucwords($cod_pas_escu);
    
  }
 
	ob_start();
    include(dirname(__FILE__).'/actaevaluacionpasante.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'Letter', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('ACTAEVALUACIONPASANTE.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


?> 