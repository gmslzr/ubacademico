<? include('../lib/session.php');
include('../lib/conexion.php');
?>
<style type="text/css">
<!--
div.encabezado{
  text-align:center;
  font-style: italic;
  position: static;
}
table.lista{
  border-collapse: collapse;
  width: 100%;
  margin-top: 20px;
  vertical-align: middle;
  font-size:10px;
}
table.lista td{
  border: 2px solid black;
}


-->
</style>

<page>
    <table style="width: 100%">
      <tr>
        <td style="width: 5%">
                <img src='images/logouba.jpg' alt='UBA'/>
        </td>
        <td style="width: 75%;">
          <div class="encabezado">REP&Uacute;BLICA BOLIVARIANA DE VENEZUELA</div>
              <div class="encabezado">UNIVERSIDAD BICENTENARIA DE ARAGUA</div>
              <div class="encabezado"><strong>VICERRECTORADO ACAD&Eacute;MICO</strong></div>
              <div class="encabezado"><strong>FACULTAD DE INGENIER&Iacute;A</strong></div>
              <div class="encabezado"><strong>Coordinaci&oacute;n de Pasant&iacute;as</strong></div>
              <? if ($cod_pas_escu == "1") { ?>
               <div class="encabezado"><strong>Escuela de Ingenier&iacute;a de Sistemas</strong></div>                    
              <? } ?>
              <? if($cod_pas_escu == "2") { ?> 
                      <div class="encabezado"><strong>Escuela de Ingenier&iacute;a El&eacute;ctrica</strong></div>
                    <? } ?>
              
              <div class="encabezado">San Joaquin de Turmero - Estado Aragua.</div><br/><br/>
          </td>
       <? if ($cod_pas_escu == "1") { ?>
        <td style="width: 5%">
            <img src='images/logoesis1.png' alt='ESIS'/> 
        </td>  
       <? } ?> 

        <? if ($cod_pas_escu == "2") { ?>
        <td style="width: 5%">
            <img src='images/logoesis1.png' alt='ELEC'/>
        </td>  
       <? } ?>
         <? if ($cod_pas_escu == "3") { ?>
        <td style="width: 5%">
            <img src='images/logoesis1.png' alt='ELEC'/>
        </td>  
       <? } ?> 
         <? if ($cod_pas_escu == "4") { ?>
        <td style="width: 5%">
            <img src='images/logoesis1.png' alt='ELEC'/>
        </td>  
       <? } ?> 
         <? if ($cod_pas_escu == "5") { ?>
        <td style="width: 5%">
            <img src='images/logoesis1.png' alt='ELEC'/>
        </td>  
       <? } ?>       
      </tr> 
      </table>

      <h2 align="center"> Acta de Evaluaci&oacute;n del Pasante</h2>
      <div style="text-align: right;margin:30;"><strong>Fecha: </strong><?php echo date("d/m/Y")?> </div>

      <table width="50%" align="center">
        <tr>
          <td width="10%"><strong>Nombres y Apellidos:</strong> <?php echo $nombreest ?></td>
          <td></td>
        </tr>
        <tr>
          <td ><strong>C&eacute;dula de Identidad:</strong> <?php echo $cedulaest ?></td>         
          <td width="5%"><strong>Escuela:</strong><?php echo $escuela ?></td>
        </tr>
        <tr>
          <td><strong>Empresa:</strong><?php echo $nom_emp ?></td>
        </tr> 
      </table> <br/><br/><br/><br/>
      <form name="evaluacion" action="" method="post">
    <table width="500px"border="0" align="center">
      <tr>
        <td><strong>Evaluaci&oacute;n del Tutor Industrial:</strong><br/></td>
        <td style="font-size:20px;"> <?php echo $nota_indus ?></td><br />
      </tr>
      <tr>
        <td><strong>Evaluaci&oacute;n del Tutor Academico </strong><br/></td>
        <td style="font-size:20px;"> <?php echo $nota_acad ?></td><br/>
      </tr>
      <tr>
        <td><strong>Evaluaci&oacute;n del Informe </strong><br/></td>
        <td style="font-size:20px;"><?php echo $nota_info ?></td><br/>
      </tr>
      <tr>
        <td><strong>Sumatoria Total en Base 100%</strong><br/></td>
        <td style="font-size:20px;"><?php echo truncateFloat($porcentaje,2) ?>%</td><br/>
      </tr>
      
      <tr>
        <td> En la escala del 01 al 20, obtuvo un calificaci&oacute;n de &nbsp; <br/></td>
        <td style="font-size:20px;"> <?php echo truncateFloat($total,2) ?>  puntos</td>
      </tr>
      
     </table>
   </form><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>


<page_footer>
<p><?php 
$nombres= strtolower($nombres);
$apellidos= strtolower($apellidos);

$nombres= ucwords($nombres);
$apellidos= ucwords($apellidos);

echo $nombres.' '.$apellidos?> <br/><br/>
<? if ($sqlresgenero == "M") { ?>
 Coordinador de Pasant&iacute;as, Escuela de <?php echo utf8_encode(nombreEscuela($cod_pas_escu)); ?>.
<? } ?>
Coordinadora de Pasant&iacute;as, Escuela de <?php echo utf8_encode(nombreEscuela($cod_pas_escu)); ?>
</p>
    <div><strong><i>“Una Universidad para la Creatividad”</i></strong></div>
    <hr>
    <div style="font-size:10px; text-align:center;"><i>Av. Intercomunal Santiago Mariño c/c Av. Universidad, Sector La Providencia,  San Joaquín de Turmero. Estado Aragua. Venezuela.</i></div>
    <div style="font-size:10px; text-align:center;"><i>Teléfono: Máster  (0243) 2650011 – 265.00.52 – 265.00.57 Fax: 265.00.62</i></div>
    <div style="font-size:10px; text-align:center;"><i>web site: <a>http://www.uba.edu.ve</a>  / e-mail: <a>ubaweb@uba.edu.ve</a></i></div>

    </page_footer>
</page>