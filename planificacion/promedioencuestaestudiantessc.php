<style type="text/css">
<!--
div.encabezado{
  text-align:center;
  position: static;
  font-size:13px;
}
table.lista{
  border-collapse: collapse;
  width: 100%;
  margin-top: 10px;
  vertical-align: middle;
  font-size:12px;
}
table.lista td{
  border: 2px solid black;
}

-->
</style>
<page>
  <br><br><br><br>
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
        <td colspan="2" align="center"><strong>ENCUESTA A LOS ESTUDIANTES SOBRE LA ACTUACI&Oacute;N DOCENTE</strong></td>
      </tr>
      </table><br>
      <form name="PromedioEncuestaEstudiantes" method="post" align="center">
                <table width="100%" align="center" style='font-size:12px;'>
                    <tr>
                        <td align="left"><strong>Docente: </strong><?php echo utf8_encode($fila_cedula['nombres'])?> <?php echo utf8_encode($fila_cedula['apellidos'])?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><strong>C.I.: </strong><? echo $cedula_doc ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><strong>Lapso: </strong><? echo $lapso_cons ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><strong>Fecha: </strong><?php echo $date[2] ?>-<?php echo $date[1] ?>-<?php echo $date[0] ?></td>
                    </tr>
                    <tr>
                        <td align="left"><strong>Asignatura: </strong><?php echo $fila_materia['cod_mat']?> - <?php echo $fila_materia['des_mat'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><strong>Secci&oacute;n: </strong><? echo $sec_mat ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><strong>N&deg; Inscritos: </strong><? echo $fila_resultado['n_inscritos']?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><strong>N&deg; Encuestados: </strong><? echo $fila_resultado['encuestas_agregadas']?> de <? echo $fila_resultado['n_encuestados']?></td>
                    </tr>
                </table><br>

        <table class="lista" width="100%" align="center">
          <tr style='font-size:13px; background-color:#C2C2C2;'>
              <td><strong>Nro.</strong></td>
              <td width="550"  height="20"><strong>INDICADORES</strong></td>
              <td width="120"><strong>CUANTITATIVA</strong></td>
              <td width="120"><strong>CUALITATIVA</strong></td>          
          </tr><tr>
              <td>1</td>
              <td align="left">Aplica estrategias de sensibilizaci&oacute;n a los estudiantes</td>
              <td><?php echo truncateFloat($fila_resultado['prom1'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom1']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom1'] <=4.50 && $fila_resultado['prom1']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom1'] <4 && $fila_resultado['prom1']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom1'] <3 && $fila_resultado['prom1']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>2</td>
              <td align="left">Se revisa la Ley de Servicio Comunitario con los Estudiantes</td>
              <td><?php echo truncateFloat($fila_resultado['prom2'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom2']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom2'] <=4.50 && $fila_resultado['prom2']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom2'] <4 && $fila_resultado['prom2']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom2'] <3 && $fila_resultado['prom2']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>3</td>
              <td align="left">Presenta la estructura de las actividades a desarrollar durante el proyecto</td>
              <td><?php echo truncateFloat($fila_resultado['prom3'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom3']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom3'] <=4.50 && $fila_resultado['prom3']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom3'] <4 && $fila_resultado['prom3']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom3'] <3 && $fila_resultado['prom3']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>4</td>
              <td align="left">Existe intercambio de experiencias entre el Tutor de Servicio Comunitario y el estudiante</td>
              <td><?php echo truncateFloat($fila_resultado['prom4'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom4']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom4'] <=4.50 && $fila_resultado['prom4']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom4'] <4 && $fila_resultado['prom4']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom4'] <3 && $fila_resultado['prom4']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>5</td>
              <td align="left">La Comunicaci&oacute;n entre el Tutor y los Estudiante es cordial</td>
              <td><?php echo truncateFloat($fila_resultado['prom5'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom5']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom5'] <=4.50 && $fila_resultado['prom5']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom5'] <4 && $fila_resultado['prom5']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom5'] <3 && $fila_resultado['prom5']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>6</td>
              <td align="left">Facilita el tutor herramientas para el diagn&oacute;stico</td>
              <td><?php echo truncateFloat($fila_resultado['prom6'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom6']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom6'] <=4.50 && $fila_resultado['prom6']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom6'] <4 && $fila_resultado['prom6']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom6'] <3 && $fila_resultado['prom6']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>7</td>
              <td align="left">Se analizan conjuntamente las necesidades seg&uacute;n los resultados del diagn&oacute;stico</td>
              <td><?php echo truncateFloat($fila_resultado['prom7'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom7']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom7'] <=4.50 && $fila_resultado['prom7']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom7'] <4 && $fila_resultado['prom7']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom7'] <3 && $fila_resultado['prom7']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>8</td>
              <td align="left">Sugiere alternativas para la satisfacci&oacute;n de las necesidades reales de la Comunidad</td>
              <td><?php echo truncateFloat($fila_resultado['prom8'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom8']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom8'] <=4.50 && $fila_resultado['prom8']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom8'] <4 && $fila_resultado['prom8']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom8'] <3 && $fila_resultado['prom8']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>9</td>
              <td align="left">Recibes el conocimiento para desarrollar actividades propias del proyecto</td>
              <td><?php echo truncateFloat($fila_resultado['prom9'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom9']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom9'] <=4.50 && $fila_resultado['prom9']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom9'] <4 && $fila_resultado['prom9']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom9'] <3 && $fila_resultado['prom9']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>10</td>
              <td align="left">El tutor verifica el esquema b&aacute;sico del Proyecto</td>
              <td><?php echo truncateFloat($fila_resultado['prom10'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom10']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom10'] <=4.50 && $fila_resultado['prom10']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom10'] <4 && $fila_resultado['prom10']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom10'] <3 && $fila_resultado['prom10']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>11</td>
              <td align="left">Cumple con las horas de asesor&iacute;a pautadas para el desarrollo de las actividades</td>
              <td><?php echo truncateFloat($fila_resultado['prom11'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom11']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom11'] <=4.50 && $fila_resultado['prom11']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom11'] <4 && $fila_resultado['prom11']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom11'] <3 && $fila_resultado['prom11']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>12</td>
              <td align="left">Manifiesta disposici&oacute;n e inter&eacute;s en las actividades desarrolladas por el estudiantes</td>
              <td><?php echo truncateFloat($fila_resultado['prom12'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom12']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom12'] <=4.50 && $fila_resultado['prom12']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom12'] <4 && $fila_resultado['prom12']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom12'] <3 && $fila_resultado['prom12']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>13</td>
              <td align="left">Supervisa el cumplimiento de las actividades de Servicio Comunitario</td>
              <td><?php echo truncateFloat($fila_resultado['prom13'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom13']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom13'] <=4.50 && $fila_resultado['prom13']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom13'] <4 && $fila_resultado['prom13']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom13'] <3 && $fila_resultado['prom13']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>14</td>
              <td align="left">Asume con responsabilidad su rol como asesor del Servicio Comunitario</td>
              <td><?php echo truncateFloat($fila_resultado['prom14'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom14']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom14'] <=4.50 && $fila_resultado['prom14']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom14'] <4 && $fila_resultado['prom14']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom14'] <3 && $fila_resultado['prom14']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr>
              <td>15</td>
              <td align="left">Eval&uacute;a el Informe Final de Servicio Comunitario</td>
              <td><?php echo truncateFloat($fila_resultado['prom15'],2); ?></td>
              <td><?php
                                                if ($fila_resultado['prom15']>4.50) {
                                                    echo "Muy Bueno";
                                                } elseif ($fila_resultado['prom15'] <=4.50 && $fila_resultado['prom15']>=4) {
                                                    echo "Bueno";
                                                } elseif ($fila_resultado['prom15'] <4 && $fila_resultado['prom15']>=3) {
                                                    echo "Regular";  
                                                } elseif ($fila_resultado['prom15'] <3 && $fila_resultado['prom15']>=2) {
                                                    echo "Deficiente"; 
                                                } else {
                                                    echo "Muy Deficiente";
                                                }
                                                ?></td>
          </tr><tr style='font-size:13px; background-color:#C2C2C2;'>
              <td height="20" colspan=2><strong>PUNTUACI&Oacute;N TOTAL</strong></td>
              <td><strong><?php echo truncateFloat($fila_resultado['prom_total'],2); ?></strong></td>
              <td><strong> <?php
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
        </table><br><br><br><br>

            <table align="center" width="100%">
              <tr>
                <td align="center" width="33%">_________________________________&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center" width="33%">_________________________________&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center" width="33%">_________________________________</td>
              </tr>
              <tr>
                <td style='align:center; font-size:10px;'>Coordinador de Planificaci&oacute;n Evaluaci&oacute;n<br>y Apoyo Docente</td>
                <td style='align:center; font-size:10px;'>Coordinador de C&aacute;tedra</td>
                <td style='align:center; font-size:10px;'>Docente de la Asignatura</td>
              </tr>
            </table>
      </form>
</page>
<page>
  <br><br><br><br>
  <table>
      <tr>
          <td align="left" style='font-size:11px;'><strong>Observaciones y Recomendaciones de los Estudiantes: </strong><br>
        <?php 
          if($cant>0)
          {
            while ($fila_obs_es=mysql_fetch_assoc($result_obs_es))
            {
              echo '-'; echo utf8_encode($fila_obs_es['observacion']);
              echo '<br>';
            }
          }else{
            echo "No hay Observaci&oacute;nes de los Estudinates";
      }?></td>
      </tr>
  </table>
</page>