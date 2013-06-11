<style type="text/css">
<!--
div.encabezado{
  text-align:center;
  position: static;
  font-size:12px;
}
table.lista{
  border-collapse: collapse;
  width: 100%;
  margin-top: 10px;
  vertical-align: middle;
  font-size:11px;
}
table.lista td{
  border: 2px solid black;
}

-->
</style>
<page>
  <br>
    <table align="center" style="width: 100%">
      <tr>
        <td style="width: 5%">
                <img src='images/logo uba.jpg' alt='UBA'/>
        </td>
        <td style="width: 75%;">
          <div class="encabezado">REP&Uacute;BLICA BOLIVARIANA DE VENEZUELA</div>
              <div class="encabezado">UNIVERSIDAD BICENTENARIA DE ARAGUA</div>
              <div class="encabezado">VICERRECTORADO ACAD&Eacute;MICO</div>
              <div class="encabezado">COORDINACI&Oacute;N DE PLANIFICACI&Oacute;N, EVALUACI&Oacute;N Y APOYO DOCENTE</div>
          </td>     
      </tr>
      <tr>
        <td colspan="2" align="center"><strong>INFORME DE SUPERVISI&Oacute;N METODOL&Oacute;GICA</strong></td>
      </tr>
      </table>

  <form name="PromedioEvaluacionDocentePlanificacion" method="post" align="center">
    <table width="100%" align="center" style='font-size:11px;'>
      <tr>
        <td align="left"><strong>Docente: </strong><?php echo utf8_encode($fila_cedula['nombres'])?> <?php echo utf8_encode($fila_cedula['apellidos'])?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="left"><strong>C.I.: </strong><? echo $cedula_doc ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="left"><strong>Secci&oacute;n: </strong><? echo $sec_mat ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="left"><strong>Escuela: </strong><?php echo utf8_encode($fila_escuela['Facultad'])?></td>
      </tr>
      <tr>
        <td align="left"><strong>Asignatura: </strong><?php echo utf8_encode($fila_materia['cod_mat'])?> - <?php echo utf8_encode($fila_materia['des_mat'])?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="left"><strong>Fecha: </strong><?php echo $date[2] ?>-<?php echo $date[1] ?>-<?php echo $date[0] ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="left"><strong>Lapso: </strong><? echo $lapso_cons ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="left"><strong>Evaluador: </strong><?php echo utf8_encode($fila_cedula_ev['nombres'])?> <?php echo utf8_encode($fila_cedula_ev['apellidos'])?></td>
      </tr>
    </table>
    <table class="lista" width="100%" align="center">
      <tr style='background-color:#C2C2C2;'>
          <td><strong>CRITERIOS</strong></td>
          <td><strong>Item</strong></td>
          <td><strong>INDICADORES</strong></td>
          <td width="70"><strong>Muy Deficiente<br>(1)</strong></td>
          <td width="70"><strong>Deficiente<br>(2)</strong></td>
          <td width="70"><strong>Regular<br>(3)</strong></td>
          <td width="70"><strong>Bueno<br>(4)</strong></td>
          <td width="70"><strong>Muy Bueno<br>(5)</strong></td>
      </tr><tr>
          <td rowspan=8>ASPECTOS<br>GENERALES</td>
          <td>1</td>
          <td align="left">Puntualidad en la llegada al aula o sitio de trabajo</td>
          <td><strong><?if ($fila_resultado['prom1']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom1']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom1']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom1']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom1']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>2</td>
          <td align="left">Apariencia personal</td>
          <td><strong><?if ($fila_resultado['prom2']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom2']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom2']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom2']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom2']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>3</td>
          <td align="left">Manejo de la planificai&oacute;n de clase</td>
          <td><strong><?if ($fila_resultado['prom3']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom3']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom3']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom3']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom3']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>4</td>
          <td align="left">Control de la asistencia de los estudiantes</td>
          <td><strong><?if ($fila_resultado['prom4']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom4']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom4']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom4']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom4']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>5</td>
          <td align="left">Uso de actividades motivacionales</td>
          <td><strong><?if ($fila_resultado['prom5']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom5']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom5']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom5']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom5']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>6</td>
          <td align="left">Manejo de las relaciones interpersonales con los estudiantes</td>
          <td><strong><?if ($fila_resultado['prom6']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom6']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom6']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom6']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom6']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>7</td>
          <td align="left">Disposici&oacute;n para atender las situaciones presentadas por los estudiantes</td>
          <td><strong><?if ($fila_resultado['prom7']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom7']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom7']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom7']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom7']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>8</td>
          <td align="left">Dominio de la disciplina para el nivel andrag&oacute;gico</td>
          <td><strong><?if ($fila_resultado['prom8']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom8']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom8']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom8']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom8']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td rowspan=2>INICIO DE<br>CLASE</td>
          <td>9</td>
          <td align="left">Retoma el contenido de la clase anterior</td>
          <td><strong><?if ($fila_resultado['prom9']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom9']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom9']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom9']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom9']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>10</td>
          <td align="left">Presentaci&oacute;n del tema</td>
          <td><strong><?if ($fila_resultado['prom10']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom10']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom10']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom10']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom10']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td rowspan=7>DESARROLLO<br>DE LA<br>CLASE</td>
          <td>11</td>
          <td align="left">Coherencia en el discurso</td>
          <td><strong><?if ($fila_resultado['prom11']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom11']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom11']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom11']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom11']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>12</td>
          <td align="left">Desarrolla adecuadamente la estrategia de aprendizaje</td>
          <td><strong><?if ($fila_resultado['prom12']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom12']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom12']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom12']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom12']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>13</td>
          <td align="left">Uso de t&eacute;cnicas para propiciar la participaci&oacute;n de los estudiantes (horizontalidad)</td>
          <td><strong><?if ($fila_resultado['prom13']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom13']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom13']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom13']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom13']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>14</td>
          <td align="left">Claridad y precisi&oacute;n del lenguaje utilizado</td>
          <td><strong><?if ($fila_resultado['prom14']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom14']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom14']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom14']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom14']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>15</td>
          <td align="left">Habilidad en el manejo de los recursos did&aacute;cticos</td>
          <td ><strong><?if ($fila_resultado['prom15']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom15']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom15']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom15']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom15']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>16</td>
          <td align="left">Refuerzo de la intervenci&oacute;n del estudiante</td>
          <td><strong><?if ($fila_resultado['prom16']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom16']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom16']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom16']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom16']==5) {
                                    echo "5";}?></strong></td>   
      </tr><tr>
          <td>17</td>
          <td a align="left">Realiza Evaluaci&oacute;n formativa</td>
          <td><strong><?if ($fila_resultado['prom17']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom17']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom17']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom17']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom17']==5) {
                                    echo "5";}?></strong></td> 
      </tr><tr>
          <td rowspan=3>CIERRE<br>DE LA<br>CLASE</td>
          <td>18</td>
          <td align="left">Sintetiza el contenido desarrollado en clase</td>
          <td><strong><?if ($fila_resultado['prom18']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom18']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom18']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom18']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom18']==5) {
                                    echo "5";}?></strong></td> 
      </tr><tr>
          <td>19</td>
          <td align="left">Revisa el contenido a desarrollar en la pr&oacute;xima clase</td>
          <td><strong><?if ($fila_resultado['prom19']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom19']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom19']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom19']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom19']==5) {
                                    echo "5";}?></strong></td>
      </tr><tr>
          <td>20</td>
          <td align="left">Recomienda materiales de referencia para el desarrollo de la pr&oacute;xima clase</td>
          <td ><strong><?if ($fila_resultado['prom20']==1) {
                                    echo "1";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom20']==2) {
                                    echo "2";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom20']==3) {
                                    echo "3";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom20']==4) {
                                    echo "4";}?></strong></td>
          <td><strong><?if ($fila_resultado['prom20']==5) {
                                    echo "5";}?></strong></td>
      </tr>                
    </table>


    <table width="100%" style='margin-right: 0px; margin-left: 0px; margin-bottom: 0px; margin-top: 10px;' >
        <tr>
            <td width="33%">
              <table class="lista" style='margin-right: 0px; margin-left: 100px; margin-bottom: 0px; margin-top: 5px;' >
                <tr>
                  <td colspan=2><strong>ESCALA VALORATIVA</strong></td>
                </tr>
                <tr>
                  <td width="90"><strong>Cualitativa</strong></td>
                  <td width="90"><strong>Cuantitativa</strong></td>
                </tr>
                <tr>
                  <td>Muy Bueno</td>
                  <td>4.51 a 5.00</td>
                </tr>
                <tr>
                  <td>Bueno</td>
                  <td>4.00 a 4.50</td>
                </tr>
                <tr>
                  <td>Regular</td>
                  <td>3.00 a 3.99</td>
                </tr>
                <tr>
                  <td>Deficiente</td>
                  <td>2.00 a 2.99</td>
                </tr>
                <tr>
                  <td>Muy Deficiente</td>
                  <td>1.00 a 1.99</td>
                </tr>
              </table>
            </td>

          <td width="33%">
            <table class="lista" style='margin-right: 0px; margin-left: 100px; margin-bottom: 0px; margin-top: 5px;' >
              <tr>
                <td colspan=2><strong>VALORACI&Oacute;N</strong></td>
              </tr>
              <tr>
                <td width="90"><strong>Cuantitativa</strong></td>
                <td width="90"><strong>Cualitativa</strong></td>
              </tr>
              <tr>
                <td height="16" style='font-size:12px;'><strong><?php echo truncateFloat($fila_resultado['prom_total'],2); ?></strong></td>
                <td height="16" style='font-size:12px;'><strong> <?php
                                                if ($fila_resultado['prom_total']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom_total'] <=4.50 && $fila_resultado['prom_total']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom_total'] <4 && $fila_resultado['prom_total']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom_total'] <3 && $fila_resultado['prom_total']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></strong></td>
              </tr>
            </table>
          </td>

          <td width="33%">
            <table  style='margin-right: 0px; margin-left: 100px; margin-bottom: 0px; margin-top: 5px;' >
              <tr>
                <td colspan="2" align="center">__________________________</td>
              </tr>
              <tr>
                <td style='align:center; font-size:10px;'>Firma del Coordinador<br><br></td>
              </tr>
              <tr>
                <td align="center"><br><br>__________________________</td>
              </tr>
              <tr>
                <td style='align:center; font-size:10px;'>Firma del Docente</td>
              </tr>
            </table>
          </td>

        </tr>
    </table><br>

        <table>
          <tr>
            <td align="left" style='font-size:11px;'><strong>Observaciones y Recomendaciones al Docente: </strong><?php if(!empty($fila_obs_ev['observacion'])){
                                                                    echo utf8_encode($fila_obs_ev['observacion']);
                                                                  }else{
                                                                    echo "No hay Observaci&oacute;n del Supervisor";
                                                                  }?></td>
          </tr>
        </table>

  </form>
</page>
