<?php
include('../lib/session.php');

include('../lib/conexion.php');
$Success=false;
$Error=true;

$cedula_doc=$_POST['cedula_doc'];
$cod_esc=$_POST['escuela'];
$cod_mat=$_POST['materia'];
$sec_mat=$_POST['seccion'];
$cedula_ev=$_POST['cedula_ev'];
$fecha=$_POST['fecha'];
$tipo_ev=$_POST['tipo_ev'];
$date=explode("-", $fecha);
$fechaactual=date("Ymd");
$fecha_sel=explode("-", $fecha);
$fecha_comp=$fecha_sel[0].$fecha_sel[1].$fecha_sel[2];

$sql_cedula="SELECT * FROM profesores WHERE cedula='$cedula_doc'";
$res_cedula=mysql_query($sql_cedula);
$fila_cedula=mysql_fetch_assoc($res_cedula);

$sql_cedula_ev="SELECT * FROM profesores WHERE cedula='$cedula_ev'";
$res_cedula_ev=mysql_query($sql_cedula_ev);
$fila_cedula_ev=mysql_fetch_assoc($res_cedula_ev);

$sql_materia="SELECT * FROM materias WHERE cod_mat='$cod_mat'";
$res_materia=mysql_query($sql_materia);
$fila_materia=mysql_fetch_assoc($res_materia);

$sql_escuela="SELECT * FROM escuelas WHERE cod_esc='$cod_esc'";
$res_escuela=mysql_query($sql_escuela);
$fila_escuela=mysql_fetch_assoc($res_escuela);

$sql_buscar = "SELECT * FROM inscripciones WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso=$lapso"; 
$res_buscar=mysql_query($sql_buscar);
$fila=mysql_fetch_assoc($res_buscar);

if ($_POST['tipo_ev']==1)
{
    $sql_bus1 = "SELECT * FROM evaluacion_docente WHERE cedula=$cedula_doc AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_esc='$cod_esc' AND lapso=$lapso"; 
    $res_bus1=mysql_query($sql_bus1);
    $cant1=mysql_num_rows($res_bus1);
}
else
{
    $sql_bus1 = "SELECT * FROM evaluacion_docente_planif WHERE cedula=$cedula_doc AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_esc='$cod_esc' AND lapso=$lapso"; 
    $res_bus1=mysql_query($sql_bus1);
    $cant1=mysql_num_rows($res_bus1);
}

if(!is_numeric($cedula_doc) || strlen($cedula_doc)<6 || strlen($cedula_doc)>8)
{
    header("Location: formularioencuestaestudiantes.php?h=1");
}
elseif(empty($cod_mat))
{
    header("Location: formularioencuestaestudiantes.php?i=1");
}
elseif(empty($cod_esc))
{
    header("Location: formularioencuestaestudiantes.php?j=1");
}
elseif(empty($sec_mat))
{
    header("Location: formularioencuestaestudiantes.php?k=1");
}
elseif($fecha_comp>$fechaactual)
{
    header("Location: formularioevaluaciondocente.php?a=1");
}
elseif($fila=="")
{
    header("Location: formularioevaluaciondocente.php?b=1");
}
elseif($cant1==1)
{
    header("Location: formularioevaluaciondocente.php?c=1");
}
elseif($cedula_doc==$cedula_ev)
{
    header("Location: formularioevaluaciondocente.php?d=1");
}
elseif(isset($_POST['borrar']) && $_POST['borrar']='Borrar' )
{
    if ($_POST['tipo_ev']==1)
    {
          $sqlbuscar="SELECT * FROM evaluacion_docente WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
          $resultbuscar=mysql_query($sqlbuscar);
          $fila=mysql_fetch_assoc($resultbuscar);
          $cant=mysql_num_rows($resultbuscar);
          if($cant!==0)
          {
              $sql_borrar = "DELETE FROM evaluacion_docente WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
              $res_borrar=mysql_query($sql_borrar);    
              header ("Location: formularioevaluaciondocente.php?e=1");
          }
          else
          {
              header ("Location: formularioevaluaciondocente.php?f=1");
          }
    }
    else
    { 
          $sqlbuscar="SELECT * FROM evaluacion_docente_planif WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
          $resultbuscar=mysql_query($sqlbuscar);
          $fila=mysql_fetch_assoc($resultbuscar);
          $cant=mysql_num_rows($resultbuscar);
          if($cant!==0)
          {
              $sql_borrar = "DELETE FROM evaluacion_docente_planif WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
              $res_borrar=mysql_query($sql_borrar);    
              header ("Location: formularioevaluaciondocente.php?e=1");
          }
          else
          {
              header ("Location: formularioevaluaciondocente.php?f=1");
          }
    }
}

include('lib/header.php'); 

if($tipo_ev==1)
{ ?>
        
<form name="evaluaciondocente" action="formularioevaluaciondocente.php" method="post">
  <h2 align="center">Supervisi&oacute;n del Desempe&ntilde;o Docente (Visita de Aula) por el Coordinador de C&aacute;tedra</h2>  
    <table  width="100%">
      <tr>
        <td width="36%"><strong>Docente: </strong><?php echo utf8_encode($fila_cedula['nombres'])?> <?php echo utf8_encode($fila_cedula['apellidos'])?></td>
        <td width="14%"><strong>C.I.: </strong><? echo $cedula_doc ?><input type="hidden" name="cedula_doc" value="<?php echo $cedula_doc?>"/></td>
        <td width="14%"><strong>Secci&oacute;n: </strong><? echo $sec_mat ?><input type="hidden" name="seccion" value="<?php echo $sec_mat?>"/></td>
        <td width="36%"><strong>Escuela: </strong><?php echo $fila_escuela['Facultad'] ?><input type="hidden" name="escuela" value="<?php echo $cod_esc?>"/></td>
      </tr>
      <tr>
        <td><strong>Asignatura: </strong><?php echo $fila_materia['cod_mat']?> - <?php echo $fila_materia['des_mat'] ?><input type="hidden" name="materia" value="<?php echo $cod_mat?>"/></td>
        <td><strong>Fecha: </strong><?php echo $date[2] ?>-<?php echo $date[1] ?>-<?php echo $date[0] ?><input type="hidden" name="fecha" value="<?php echo $fecha?>"/></td>
        <td><strong>Lapso: </strong><? echo $lapso ?></td>
        <td><strong>Evaluador: </strong><?php echo utf8_encode($fila_cedula_ev['nombres'])?> <?php echo utf8_encode($fila_cedula_ev['apellidos'])?><input type="hidden" name="cedula_ev" value="<?php echo $cedula_ev?>"/></td>
      </tr>
    </table><br>
    <table class=tabla-a align="center">
      <tr class=tabla-cabecera>
          <th class=td-a>CRITERIOS</th>
          <th class=td-a>Item</th>
          <th class=td-a>INDICADORES</th>
          <th class=td-a width="70">Muy Deficiente<br>(1)</th>
          <th class=td-a width="70">Deficiente<br>(2)</th>
          <th class=td-a width="70">Regular<br>(3)</th>
          <th class=td-a width="70">Bueno<br>(4)</th>
          <th class=td-a width="70">Muy Bueno<br>(5)</th>
      </tr><tr height="35">
          <th class=td-a rowspan=8>ASPECTOS<br>GENERALES</th>
          <td class=td-a>1</td>
          <td class=td-a align="left">Puntualidad en la llegada al Aula o sitio de trabajo</td>
          <td class=td-a><input type="radio" name="ResD1" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD1" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD1" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD1" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD1" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>2</td>
          <td class=td-a align="left">Apariencia Personal</td>
          <td class=td-a><input type="radio" name="ResD2" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD2" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD2" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD2" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD2" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>3</td>
          <td class=td-a align="left">Manejo de la Planificai&oacute;n de clase</td>
          <td class=td-a><input type="radio" name="ResD3" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD3" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD3" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD3" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD3" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>4</td>
          <td class=td-a align="left">Control de la Asistencia de los Estudiantes</td>
          <td class=td-a><input type="radio" name="ResD4" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD4" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD4" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD4" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD4" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>5</td>
          <td class=td-a align="left">Uso de Actividades motivacionales</td>
          <td class=td-a><input type="radio" name="ResD5" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD5" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD5" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD5" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD5" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>6</td>
          <td class=td-a align="left">Manejo de las relaciones interpersonales con los estudiantes</td>
          <td class=td-a><input type="radio" name="ResD6" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD6" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD6" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD6" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD6" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>7</td>
          <td class=td-a align="left">Disposici&oacute;n para Atender las situaciones presentadas por los estudiantes</td>
          <td class=td-a><input type="radio" name="ResD7" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD7" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD7" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD7" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD7" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>8</td>
          <td class=td-a align="left">Dominio de la disciplina para el nivel andrag&oacute;gico</td>
          <td class=td-a><input type="radio" name="ResD8" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD8" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD8" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD8" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD8" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <th class=td-a rowspan=2>INICIO DE<br>CLASE</th>
          <td class=td-a>9</td>
          <td class=td-a align="left">Retoma el contenido de la clase anterior</td>
          <td class=td-a><input type="radio" name="ResD9" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD9" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD9" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD9" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD9" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>10</td>
          <td class=td-a align="left">Presentaci&oacute;n del Tema</td>
          <td class=td-a><input type="radio" name="ResD10" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD10" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD10" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD10" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD10" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <th class=td-a rowspan=7><h4>DESARROLLO<br>DE LA<br>CLASE</h4></th>
          <td class=td-a>11</td>
          <td class=td-a align="left">Coherencia en el desarrollo del contenido</td>
          <td class=td-a><input type="radio" name="ResD11" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD11" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD11" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD11" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD11" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>12</td>
          <td class=td-a align="left">Pertinencia de la estrategia de aprendizaje utilizada para el desarrollo del contenido</td>
          <td class=td-a><input type="radio" name="ResD12" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD12" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD12" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD12" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD12" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>13</td>
          <td class=td-a align="left">Uso de t&eacute;cnicas para propiciar la participaci&oacute;n de los estudiantes (horizontalidad)</td>
          <td class=td-a><input type="radio" name="ResD13" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD13" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD13" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD13" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD13" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>14</td>
          <td class=td-a align="left">Claridad y precisi&oacute;n del lenguaje utilizado</td>
          <td class=td-a><input type="radio" name="ResD14" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD14" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD14" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD14" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD14" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>15</td>
          <td class=td-a align="left">Uso del lenguaje t&eacute;cnico</td>
          <td class=td-a><input type="radio" name="ResD15" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD15" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD15" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD15" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD15" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>16</td>
          <td class=td-a align="left">Refuerzo de la intervenci&oacute;n del estudiante</td>
          <td class=td-a><input type="radio" name="ResD16" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD16" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD16" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD16" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD16" value="5" class="regular-radio" required="true"></td>   
      </tr><tr height="35">
          <td class=td-a>17</td>
          <td class=td-a align="left">Complementa el contenido te&oacute;rico con ejemplos pr&aacute;cticos</td>
          <td class=td-a><input type="radio" name="ResD17" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD17" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD17" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD17" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD17" value="5" class="regular-radio" required="true"></td>  
      </tr><tr height="35">
          <th class=td-a rowspan=3>CIERRE<br>DE LA<br>CLASE</th>
          <td class=td-a>18</td>
          <td class=td-a align="left">Sintetiza el contenido desarrollado en clase</td>
          <td class=td-a><input type="radio" name="ResD18" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD18" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD18" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD18" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD18" value="5" class="regular-radio" required="true"></td>     
      </tr><tr height="35">
          <td class=td-a>19</td>
          <td class=td-a align="left">Revisa el contenido a desarrollar en la pr&oacute;xima clase</td>
          <td class=td-a><input type="radio" name="ResD19" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD19" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD19" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD19" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD19" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>20</td>
          <td class=td-a align="left">Recomienda materiales de referencia para el desarrollo de la pr&oacute;xima clase</td>
          <td class=td-a><input type="radio" name="ResD20" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD20" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD20" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD20" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD20" value="5" class="regular-radio" required="true"></td>
      </tr>                
    </table><br />

    <center><textarea cols="100" rows="7" name="obs_ev" placeholder="Observaciones y Recomendaciones del Supervisor:" maxlength="500"></textarea></center><br />

    <center><input type="submit" name="guardar" value="Guardar"></center>
  </form>

 <?php
}
else
{?> 

  <form name="evaluaciondocente" action="formularioevaluaciondocente.php" method="post">
  <h2 align="center">Supervisi&oacute;n del Desempe&ntilde;o Docente (Visita de Aula) por el CPEYAD</h2>  
    <table  width="100%">
      <tr>
        <td width="36%"><strong>Docente: </strong><?php echo utf8_encode($fila_cedula['nombres'])?> <?php echo utf8_encode($fila_cedula['apellidos'])?></td>
        <td width="14%"><strong>C.I.: </strong><? echo $cedula_doc ?><input type="hidden" name="cedula_doc" value="<?php echo $cedula_doc?>"/></td>
        <td width="14%"><strong>Secci&oacute;n: </strong><? echo $sec_mat ?><input type="hidden" name="seccion" value="<?php echo $sec_mat?>"/></td>
        <td width="36%"><strong>Escuela: </strong><?php echo $fila_escuela['Facultad'] ?><input type="hidden" name="escuela" value="<?php echo $cod_esc?>"/></td>
      </tr>
      <tr>
        <td><strong>Asignatura: </strong><?php echo $fila_materia['cod_mat']?> - <?php echo $fila_materia['des_mat'] ?><input type="hidden" name="materia" value="<?php echo $cod_mat?>"/></td>
        <td><strong>Fecha: </strong><?php echo $date[2] ?>-<?php echo $date[1] ?>-<?php echo $date[0] ?><input type="hidden" name="fecha" value="<?php echo $fecha?>"/></td>
        <td><strong>Lapso: </strong><? echo $lapso ?></td>
        <td><strong>Evaluador: </strong><?php echo utf8_encode($fila_cedula_ev['nombres'])?> <?php echo utf8_encode($fila_cedula_ev['apellidos'])?><input type="hidden" name="cedula_ev" value="<?php echo $cedula_ev?>"/></td>
      </tr>
    </table><br>
    <table class=tabla-a align="center">
      <tr class=tabla-cabecera>
          <th class=td-a>CRITERIOS</th>
          <th class=td-a>Item</th>
          <th class=td-a>INDICADORES</th>
          <th class=td-a width="70">Muy Deficiente<br>(1)</th>
          <th class=td-a width="70">Deficiente<br>(2)</th>
          <th class=td-a width="70">Regular<br>(3)</th>
          <th class=td-a width="70">Bueno<br>(4)</th>
          <th class=td-a width="70">Muy Bueno<br>(5)</th>
      </tr><tr height="35">
          <th class=td-a rowspan=8>ASPECTOS<br>GENERALES</th>
          <td class=td-a>1</td>
          <td class=td-a align="left">Puntualidad en la llegada al Aula o sitio de trabajo</td>
          <td class=td-a><input type="radio" name="ResD1" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD1" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD1" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD1" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD1" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>2</td>
          <td class=td-a align="left">Apariencia Personal</td>
          <td class=td-a><input type="radio" name="ResD2" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD2" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD2" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD2" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD2" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>3</td>
          <td class=td-a align="left">Manejo de la Planificai&oacute;n de clase</td>
          <td class=td-a><input type="radio" name="ResD3" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD3" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD3" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD3" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD3" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>4</td>
          <td class=td-a align="left">Control de la Asistencia de los Estudiantes</td>
          <td class=td-a><input type="radio" name="ResD4" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD4" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD4" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD4" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD4" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>5</td>
          <td class=td-a align="left">Uso de Actividades motivacionales</td>
          <td class=td-a><input type="radio" name="ResD5" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD5" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD5" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD5" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD5" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>6</td>
          <td class=td-a align="left">Manejo de las relaciones interpersonales con los estudiantes</td>
          <td class=td-a><input type="radio" name="ResD6" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD6" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD6" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD6" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD6" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>7</td>
          <td class=td-a align="left">Disposici&oacute;n para Atender las situaciones presentadas por los estudiantes</td>
          <td class=td-a><input type="radio" name="ResD7" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD7" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD7" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD7" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD7" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>8</td>
          <td class=td-a align="left">Dominio de la disciplina para el nivel andrag&oacute;gico</td>
          <td class=td-a><input type="radio" name="ResD8" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD8" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD8" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD8" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD8" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <th class=td-a rowspan=2>INICIO DE<br>CLASE</th>
          <td class=td-a>9</td>
          <td class=td-a align="left">Retoma el contenido de la clase anterior</td>
          <td class=td-a><input type="radio" name="ResD9" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD9" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD9" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD9" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD9" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>10</td>
          <td class=td-a align="left">Presentaci&oacute;n del Tema</td>
          <td class=td-a><input type="radio" name="ResD10" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD10" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD10" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD10" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD10" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <th class=td-a rowspan=7><h4>DESARROLLO<br>DE LA<br>CLASE</h4></th>
          <td class=td-a>11</td>
          <td class=td-a align="left">Coherencia en el discurso</td>
          <td class=td-a><input type="radio" name="ResD11" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD11" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD11" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD11" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD11" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>12</td>
          <td class=td-a align="left">Desarrolla adecuadamente la estrategia de aprendizaje</td>
          <td class=td-a><input type="radio" name="ResD12" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD12" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD12" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD12" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD12" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>13</td>
          <td class=td-a align="left">Uso de t&eacute;cnicas para propiciar la participaci&oacute;n de los estudiantes (horizontalidad)</td>
          <td class=td-a><input type="radio" name="ResD13" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD13" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD13" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD13" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD13" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>14</td>
          <td class=td-a align="left">Claridad y precisi&oacute;n del lenguaje utilizado</td>
          <td class=td-a><input type="radio" name="ResD14" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD14" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD14" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD14" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD14" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>15</td>
          <td class=td-a align="left">Habilidad en el manejo de los recursos did&aacute;cticos</td>
          <td class=td-a><input type="radio" name="ResD15" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD15" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD15" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD15" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD15" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>16</td>
          <td class=td-a align="left">Refuerzo de la intervenci&oacute;n del estudiante</td>
          <td class=td-a><input type="radio" name="ResD16" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD16" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD16" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD16" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD16" value="5" class="regular-radio" required="true"></td>   
      </tr><tr height="35">
          <td class=td-a>17</td>
          <td class=td-a align="left">Realiza Evaluaci&oacute;n formativa</td>
          <td class=td-a><input type="radio" name="ResD17" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD17" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD17" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD17" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD17" value="5" class="regular-radio" required="true"></td>  
      </tr><tr height="35">
          <th class=td-a rowspan=3>CIERRE<br>DE LA<br>CLASE</th>
          <td class=td-a>18</td>
          <td class=td-a align="left">Sintetiza el contenido desarrollado en clase</td>
          <td class=td-a><input type="radio" name="ResD18" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD18" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD18" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD18" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD18" value="5" class="regular-radio" required="true"></td>     
      </tr><tr height="35">
          <td class=td-a>19</td>
          <td class=td-a align="left">Revisa el contenido a desarrollar en la pr&oacute;xima clase</td>
          <td class=td-a><input type="radio" name="ResD19" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD19" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD19" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD19" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD19" value="5" class="regular-radio" required="true"></td>
      </tr><tr height="35">
          <td class=td-a>20</td>
          <td class=td-a align="left">Recomienda materiales de referencia para el desarrollo de la pr&oacute;xima clase</td>
          <td class=td-a><input type="radio" name="ResD20" value="1" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD20" value="2" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD20" value="3" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD20" value="4" class="regular-radio" required="true"></td>
          <td class=td-a><input type="radio" name="ResD20" value="5" class="regular-radio" required="true"></td>
      </tr>                
    </table><br />

    <center><textarea cols="100" rows="7" name="obs_ev" placeholder="Observaciones y Recomendaciones del Supervisor:" maxlength="500"></textarea></center><br />

    <center><input type="submit" name="guardar_planif" value="Guardar"></center>
  </form>

<?php } ?>
<?php include('../lib/footer.php'); ?>