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
              <td align="left">Inicia la actividad en el horario establecido</td>
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
              <td align="left">En la Actividad se expresa con lenguaje t&eacute;cnico</td>
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
              <td align="left">La pr&aacute;ctica se fundamenta en los contenidos previos a la misma</td>
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
              <td align="left">Propicia el aprendizaje en la actividad pr&aacute;ctica</td>
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
              <td align="left">Estimula el an&aacute;lisis de los contenidos de las pr&aacute;cticas</td>
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
              <td align="left">Inicia la actividad pr&aacute;ctica con la presencia del estudiante</td>
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
              <td align="left">La actividad pr&aacute;ctica se desarrolla en un ambiente emp&aacute;tico</td>
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
              <td align="left">Cumple lo establecido en el plan de evaluaci&oacute;n</td>
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
              <td align="left">Recibe retroinformaci&oacute;n al final de la actividad pr&aacute;ctica</td>
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
              <td align="left">Se cumple con el horario de salida establecido para la actividad pr&aacute;ctica</td>
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