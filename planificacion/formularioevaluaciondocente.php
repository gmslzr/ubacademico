<?php
include('../lib/session.php');

include('../lib/conexion.php');
$Success=false;
$Error=true;

$sql_cedula = "SELECT cedula FROM coordinadores WHERE cod_coord='PLA/ING'";
$result_cedula=mysql_query($sql_cedula);
$result_ced=mysql_fetch_assoc($result_cedula);

if (isset($_GET['z']) && $_GET['z']==1) 
{
    $Success=true;
    $msgSuccess='Encuestas Agregadas Correctamente';
}
if (isset($_GET['a']) && $_GET['a']==1) 
{
    $Error=false;
    $msgError='Error la Fecha no Puede ser Superior a la Fecha Actual';
}
if (isset($_GET['b']) && $_GET['b']==1) 
{
    $Error=false;
    $msgError='Error la Secci&oacute;n No tiene Estudiantes Inscritos';
}
if (isset($_GET['c']) && $_GET['c']==1) 
{
    $Error=false;
    $msgError='Error la Evaluaci&oacute;n Ya est&aacute; Agregada en el Sistema';
}
if (isset($_GET['d']) && $_GET['d']==1) 
{
    $Error=false;
    $msgError='EL Docente no Puede ser Igual a la C&eacute;dula del Evaluador';
}
if (isset($_GET['e']) && $_GET['e']==1) 
{
    $Success=true;
    $msgSuccess='Las Encuestas Fueron Eliminadas Correctamente';
}
if (isset($_GET['f']) && $_GET['f']==1) 
{
    $Error=false;
    $msgError='Error No Hay Evaluaciones Agregadas en el Sistema';
}
if (isset($_GET['h']) && $_GET['h']==1) 
{
    $Error=false;
    $msgError='Error al escribir la C&eacute;dula';
}
if (isset($_GET['i']) && $_GET['i']==1) 
{
    $Error=false;
    $msgError='Error Debe Seleccionar una Materia';
}
if (isset($_GET['j']) && $_GET['j']==1) 
{
    $Error=false;
    $msgError='Error Debe Seleccionar una Escuela';
}
if (isset($_GET['k']) && $_GET['k']==1) 
{
    $Error=false;
    $msgError='Error Debe Seleccionar una Secci&oacute;n';
}

if(isset($_POST['guardar']))
    {     
        $cedula_doc=$_POST['cedula_doc'];
        $cod_esc=$_POST['escuela'];
        $cod_mat=$_POST['materia'];
        $sec_mat=$_POST['seccion'];
        $cedula_ev=$_POST['cedula_ev'];
        $fecha=$_POST['fecha'];
        $ResD1=$_POST['ResD1'];
        $ResD2=$_POST['ResD2'];
        $ResD3=$_POST['ResD3'];
        $ResD4=$_POST['ResD4'];
        $ResD5=$_POST['ResD5'];
        $ResD6=$_POST['ResD6'];
        $ResD7=$_POST['ResD7'];
        $ResD8=$_POST['ResD8'];
        $ResD9=$_POST['ResD9'];
        $ResD10=$_POST['ResD10'];
        $ResD11=$_POST['ResD11'];
        $ResD12=$_POST['ResD12'];
        $ResD13=$_POST['ResD13'];
        $ResD14=$_POST['ResD14'];
        $ResD15=$_POST['ResD15'];
        $ResD16=$_POST['ResD16'];
        $ResD17=$_POST['ResD17'];
        $ResD18=$_POST['ResD18'];
        $ResD19=$_POST['ResD19'];
        $ResD20=$_POST['ResD20'];
        $obs_ev=$_POST['obs_ev'];
        $Promedio=(($ResD1+$ResD2+$ResD3+$ResD4+$ResD5+$ResD6+$ResD7+$ResD8+$ResD9+$ResD10+$ResD11+$ResD12+$ResD13+$ResD14+$ResD15+$ResD16+$ResD17+$ResD18+$ResD19+$ResD20)/"20");
        if(!empty($obs_ev))
        {
            $sql_ev="INSERT INTO observaciones_planif (id_tipo,cedula,cod_esc,cod_mat,sec_mat,lapso,observacion) VALUES ('2',$cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$obs_ev')";
            $res_ev=mysql_query($sql_ev);
        }
        $sql_insertar="INSERT INTO evaluacion_docente (cedula,cod_esc,cod_mat,sec_mat,ci_evaluador,lapso,fecha,prom1,prom2,prom3,prom4,prom5,prom6,prom7,prom8,prom9,prom10,prom11,prom12,prom13,prom14,prom15,prom16,prom17,prom18,prom19,prom20,prom_total) VALUES ($cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$cedula_ev,$lapso,'$fecha','$ResD1','$ResD2','$ResD3','$ResD4','$ResD5','$ResD6','$ResD7','$ResD8','$ResD9','$ResD10','$ResD11','$ResD12','$ResD13','$ResD14','$ResD15','$ResD16','$ResD17','$ResD18','$ResD19','$ResD20','$Promedio')";
        $resultado=mysql_query($sql_insertar);
        $Success=true;
        $msgSuccess='Evaluaci&oacute;n Agregada Correctamente';
    }

if(isset($_POST['guardar_planif']))
    {     
        $cedula_doc=$_POST['cedula_doc'];
        $cod_esc=$_POST['escuela'];
        $cod_mat=$_POST['materia'];
        $sec_mat=$_POST['seccion'];
        $cedula_ev=$_POST['cedula_ev'];
        $fecha=$_POST['fecha'];
        $ResD1=$_POST['ResD1'];
        $ResD2=$_POST['ResD2'];
        $ResD3=$_POST['ResD3'];
        $ResD4=$_POST['ResD4'];
        $ResD5=$_POST['ResD5'];
        $ResD6=$_POST['ResD6'];
        $ResD7=$_POST['ResD7'];
        $ResD8=$_POST['ResD8'];
        $ResD9=$_POST['ResD9'];
        $ResD10=$_POST['ResD10'];
        $ResD11=$_POST['ResD11'];
        $ResD12=$_POST['ResD12'];
        $ResD13=$_POST['ResD13'];
        $ResD14=$_POST['ResD14'];
        $ResD15=$_POST['ResD15'];
        $ResD16=$_POST['ResD16'];
        $ResD17=$_POST['ResD17'];
        $ResD18=$_POST['ResD18'];
        $ResD19=$_POST['ResD19'];
        $ResD20=$_POST['ResD20'];
        $obs_ev=$_POST['obs_ev'];
        $Promedio=(($ResD1+$ResD2+$ResD3+$ResD4+$ResD5+$ResD6+$ResD7+$ResD8+$ResD9+$ResD10+$ResD11+$ResD12+$ResD13+$ResD14+$ResD15+$ResD16+$ResD17+$ResD18+$ResD19+$ResD20)/"20");
        if(!empty($obs_ev)){
            $sql_ev="INSERT INTO observaciones_planif (id_tipo,cedula,cod_esc,cod_mat,sec_mat,lapso,observacion) VALUES ('3',$cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$obs_ev')";
            $res_ev=mysql_query($sql_ev);
        }
        $sql_insertar="INSERT INTO evaluacion_docente_planif (cedula,cod_esc,cod_mat,sec_mat,ci_evaluador,lapso,fecha,prom1,prom2,prom3,prom4,prom5,prom6,prom7,prom8,prom9,prom10,prom11,prom12,prom13,prom14,prom15,prom16,prom17,prom18,prom19,prom20,prom_total) VALUES ($cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$cedula_ev,$lapso,'$fecha','$ResD1','$ResD2','$ResD3','$ResD4','$ResD5','$ResD6','$ResD7','$ResD8','$ResD9','$ResD10','$ResD11','$ResD12','$ResD13','$ResD14','$ResD15','$ResD16','$ResD17','$ResD18','$ResD19','$ResD20','$Promedio')";
        $resultado=mysql_query($sql_insertar);
        $Success=true;
        $msgSuccess='Evaluaci&oacute;n Agregada Correctamente';
    }

include('lib/header.php'); 

?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#cedula_doc").blur(function(){
            var cedula_doc = $("#cedula_doc").val();
            var busqueda = "nombres";
                $.ajax({
                    type: "GET",
                    url: "lib/procesamiento.php?dato="+cedula_doc+"&busqueda="+busqueda+"&cond=cedula&tabla=profesores",
                    cache: false,
                    success: function(html)
                    {
                        $("#nombres_doc").val(html);

                            var cedula_doc = $("#cedula_doc").val();
                            var busqueda = "apellidos";
                                $.ajax({
                                    type: "GET",
                                    url: "lib/procesamiento.php?dato="+cedula_doc+"&busqueda="+busqueda+"&cond=cedula&tabla=profesores",
                                    cache: false,
                                    success: function(html)
                                    {
                                        $("#apellidos_doc").val(html);
                                    } 
                                });
                    } 
                });
        });

        $("#cedula_ev").blur(function(){
            var cedula_ev = $("#cedula_ev").val();
            var cedula = <?php echo $cedula; ?>;
            var busqueda = "nombres";
                $.ajax({
                    type: "GET",
                    url: "lib/procesamiento.php?dato="+cedula_ev+"&busqueda="+busqueda+"&cond=cedula&tabla=profesores",
                    cache: false,
                    success: function(html)
                    {
                        $("#nombres_ev").val(html);

                            var cedula_ev = $("#cedula_ev").val();
                            var busqueda = "apellidos";
                                $.ajax({
                                    type: "GET",
                                    url: "lib/procesamiento.php?dato="+cedula_ev+"&busqueda="+busqueda+"&cond=cedula&tabla=profesores",
                                    cache: false,
                                    success: function(html)
                                    {
                                        $("#apellidos_ev").val(html);
                                    }

                                });
                    } 
                });

                if (cedula_ev == cedula) 
                {
                    $('<option value="2">Evaluaci&oacute;n del Coordinador de CPEYAD</option>').appendTo("#tipo_ev");
                }

        }); 

        $("#cedula_doc").blur(function(){
            var cedula_doc = $("#cedula_doc").val();
            var busqueda = "cod_mat";
                $.ajax({
                    type: "GET",
                    url: "lib/procesamiento.php?dato="+cedula_doc+"&busqueda="+busqueda+"&cond=ced_prof&tabla=secciones&multiple=materia&lapso=<?php echo $lapso;?>",
                    cache: false,
                    success: function(html)
                    {
                        $("#materia").html(html);
                    } 
                });
            }); 

        $("#materia").change(function(){

            var materia = $("#materia").val();
            var busqueda = "cod_catedra";
            $.ajax({
                type: "GET",
                url: "lib/procesamiento.php?dato="+materia+"&busqueda="+busqueda+"&cond=cod_mat&tabla=h_catemate&multiple=catedra",
                cache: false,
                success: function(html)
                {
                   $("#catedra").html(html);
                } 
            });

         });

         $("#catedra").change(function(){

            var catedra = $("#catedra").val();
            var busqueda = "cod_escu";
            $.ajax({
                type: "GET",
                url: "lib/procesamiento.php?dato="+catedra+"&busqueda="+busqueda+"&cond=cod_catedra&tabla=h_catedra&multiple=escuela",
                cache: false,
                success: function(html)
                {
                   $("#escuela").html(html);
                } 
            });

         });

        $("#materia").change(function(){

            var materia = $("#materia").val();
            var cedula_doc =$("#cedula_doc").val();
            var busqueda = "sec_mat";     
            $.ajax({
                type: "GET",
                url: "lib/procesamiento.php?dato="+materia+"&busqueda="+busqueda+"&cond=cod_mat&tabla=secciones&multiple=seccion&ced_prof="+cedula_doc+"&lapso=<?php echo $lapso;?>",
                cache: false,
                success: function(html)
                {
                   $("#seccion").html(html);
                } 
            });

        });

        $("#tipo_ev").change(function(){

            var tipo_ev = $("#tipo_ev").val();
            var cedula_doc = $("#cedula_doc").val();
            var escuela = $("#escuela").val();
            var materia = $("#materia").val();
            var seccion = $("#seccion").val();
            var busqueda = "cedula";
            var borrar = document.getElementById('borrar');
            if (tipo_ev==1)
            {
                $.ajax({
                    type: "GET",
                    url: "lib/procesamiento.php?dato="+materia+"&busqueda="+busqueda+"&cond=cod_mat&tabla=evaluacion_docente&count=1&cedula="+cedula_doc+"&cod_esc="+escuela+"&sec_mat="+seccion+"&lapso=<?php echo $lapso;?>",                    
                    cache: false,
                    success: function(html)
                    {
                        $("#borrar_est").val(html);
                        var borrar_est = $("#borrar_est").val();
                        if (borrar_est == 0) 
                        {
                            borrar.disabled = true;
                        }
                        else 
                        {
                            borrar.disabled = false;
                        }
                    }
                });
            }
            else
            {
                $.ajax({
                    type: "GET",
                    url: "lib/procesamiento.php?dato="+materia+"&busqueda="+busqueda+"&cond=cod_mat&tabla=evaluacion_docente_planif&count=1&cod_esc="+escuela+"&sec_mat="+seccion+"&lapso=<?php echo $lapso;?>",                   
                    cache: false,
                    success: function(html)
                    {
                        $("#borrar_est").val(html);
                        var borrar_est = $("#borrar_est").val();
                        if (borrar_est == 0) 
                        {
                            borrar.disabled = true;
                        }
                        else 
                        {
                            borrar.disabled = false;
                        }
                    } 
                });
            }     
        });
    });

</script>

            <div class="columna_derecha"></div>
            <div class="columna_izquierda">
                <div>
                    <?php
                        if ($cedula==$result_ced['cedula']) 
                        {
                            {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="EncuestaEstudiantes"></div></td><td><a href="formularioencuestaestudiantes.php">Agregar Encuesta Estudiantes</a></td></tr></table></div>';}
                            {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="EvaluacionDocente"></div></td><td><a href="formularioevaluaciondocente.php">Agregar Evaluaci&oacute;n Docente</a></td></tr></table></div>';}
                            {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="ConsultaEncuestaEstudiantes"></div></td><td><a href="seleccionencuestaestudiantes.php">Consultar Encuesta Estudiantes</a></td></tr></table></div>';}
                            {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="ConsultaEvaluacionDocente"></div></td><td><a href="seleccionevaluaciondocente.php">Consultar Evaluaci&oacute;n Docente</a></td></tr></table></div>';} 
                            {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="GraficasPlanificacion"></div></td><td><a href="consultagraficas.php">Gr&aacute;ficas</a></td></tr></table></div>';}
                        }
                        else
                        {
                            {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="ConsultaEncuestaEstudiantes"></div></td><td><a href="seleccionencuestaestudiantes.php">Consultar Encuesta Estudiantes</a></td></tr></table></div>';}
                            {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="ConsultaEvaluacionDocente"></div></td><td><a href="seleccionevaluaciondocente.php">Consultar Evaluaci&oacute;n Docente</a></td></tr></table></div>';}    
                        }               
                    ?>
                </div>
                <div class="favorito2"><a href="../salir.php"><table><tr><td><div class="favorito" id="Salir"></div></td><td>Cerrar Sesi&oacute;n</td></tr></table></a></div>
            </div>
            <div class="columna_central">
                    <form name="FormularioEvaluacionDocente" action="evaluaciondocente.php" method="post">
                        <h2 align="center">Supervisi&oacute;n del Desempe&ntilde;o Docente (Visita de Aula)</h2>
                            <table align="center">
                                <?php
                                    if($Error!=true && isset($Error)){ ?>
                                        <tr>
                                            <td colspan="2">
                                                <div class="warning"><?php echo $msgError ?></div>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        if($Success==true && isset($Success)){ ?>
                                        <tr>
                                            <td colspan="2">
                                                <div class="success"><?php echo $msgSuccess ?></div>
                                            </td>
                                        </tr>   
                                <?php } ?>
                            </table>
                            <table align="center">
                                    <td colspan=2 align="center"><label>Lapso: <?php echo $lapso;?></label></td>
                                </tr>
                                <tr>
                                    <td>C.I del Docente:</td>
                                    <td><input type="text" name="cedula_doc" id="cedula_doc" value="<?php if (isset($cedula_doc)){echo $cedula_doc;}?>" placeholder="C.I. del Docente" title="Seleccionar C&eacute;dula del Docente" required/></td>
                                </tr>
                                <tr>
                                    <td>Nombres:</td>
                                    <td><input type="text" name="nombres_doc" id="nombres_doc" size="30" value="<?php if (isset($nombres_doc)){echo $apellidos_doc;}?>" placeholder="Nombres del Docente" readonly/></td>
                                </tr>
                                <tr>
                                    <td>Apellidos:</td>
                                    <td><input type="text" name="apellidos_doc" id="apellidos_doc" size="30" value="<?php if (isset($apellidos_doc)){echo $apellidos_doc;}?>" placeholder="Apellidos del Docente" readonly/></td>
                                </tr>
                                <tr>
                                    <td>Materia:</td>
                                    <td><select name="materia" id="materia" title="Seleccionar Materia" required>
                                        <option value ="">Materia</option></select></td>
                                </tr>
                                <tr>
                                    <td>C&aacute;tedra:</td>
                                    <td><select name="catedra"  id="catedra" title="Seleccionar Catedra" required>
                                        <option value ="">Catedra</option></select></td>
                                </tr>
                                <tr>
                                    <td>Escuela:</td>
                                    <td><select name="escuela" id="escuela" title="Seleccionar Escuela" required>
                                        <option value ="">Escuela</option></select></td>
                                </tr>
                                <tr>
                                    <td>Secci&oacute;n:</td>
                                    <td><select name="seccion" id="seccion" title="Seleccionar Secci&oacute;n" required>
                                        <option value ="">Secci&oacute;n</option></select></td>
                                </tr>
                                <tr>
                                    <td>C.I. del Evaluador:</td>
                                    <td><input type="text" name="cedula_ev" id="cedula_ev" value="" placeholder="C.I. del Evaluador" title="Seleccionar C&eacute;dula del Docente" required/></td>
                                </tr>
                                <tr>
                                    <td>Nombres del Evaluador:</td>
                                    <td><input type="text" name="nombres_ev" id="nombres_ev" size="30" value="" placeholder="Nombres del Evaluador" readonly/></td>
                                </tr>
                                <tr>
                                    <td>Apellidos del Evaluador:</td>
                                    <td><input type="text" name="apellidos_ev" id="apellidos_ev" size="30" value="" placeholder="Apellidos del Evaluador" readonly/></td>
                                </tr>
                                <tr>
                                    <td>Tipo de Evaluaci&oacute;n:</td>
                                    <td><select name="tipo_ev" id="tipo_ev" title="Seleccionar Evaluaci&oacute;n" required>
                                        <option value ="">Seleccionar Evaluaci&oacute;n</option>
                                        <option value ="1">Evaluaci&oacute;n del Coordinador de C&aacute;tedra</option></select></td>
                                </tr>
                                <tr>
                                    <td>Fecha:</td>
                                    <td><input type="text" name="fecha" id="fecha" placeholder="Ej: AAAA-MM-DD" required/></td>       
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><input type="submit" name="borrar" id="borrar" value="Borrar Evaluaci&oacute;n" disabled="true"><input type="hidden" name="borrar_est" id="borrar_est" value=""/>
                                        <input type="submit" name="validar" value="Siguiente" ></td>  
                                </tr>
                            </table>
                  </form> 
            </div>

<?php include('../lib/footer.php'); ?>