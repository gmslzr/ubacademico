<?php
include('../lib/session.php');

include('../lib/conexion.php');
$Success=false;
$Error=true;

$sql_cedula = "SELECT cedula FROM coordinadores WHERE cod_coord='PLA/ING'";
$result_cedula=mysql_query($sql_cedula);
$result_ced=mysql_fetch_assoc($result_cedula);

if(isset($_POST['agregar']))
{
    $encuestas_agregadas=$_POST['encuestas_agregadas'];
}

if (isset($_GET['z']) && $_GET['z']==1) 
{
    $Success=true;
    $msgSuccess='Las Encuestas Ya Est&aacute;n Agregadas Correctamente';
}
if (isset($_GET['a']) && $_GET['a']==1) 
{
    $Error=false;
    $msgError='Error la Fecha no Puede ser Superior a la Fecha Actual';
}
if (isset($_GET['b']) && $_GET['b']==1) 
{
    $Error=false;
    $msgError='Error el N&deg; de Encuestados Tiene que ser Mayor a 0 y Menor o Igual al N&deg; de Inscritos';
}
if (isset($_GET['c']) && $_GET['c']==1) 
{
    $Error=false;
    $msgError='Error la Secci&oacute;n No tiene Estudiantes Inscritos';
}
if (isset($_GET['d']) && $_GET['d']==1) 
{
    $Error=false;
    $msgError='Error las Encuestas ('.$encuestas_agregadas.') Ya est&aacute;n Agregadas en el Sistema';
}
if (isset($_GET['e']) && $_GET['e']==1) 
{
    $Success=true;
    $msgSuccess='Las Encuestas Fueron Eliminadas Correctamente';
}
if (isset($_GET['f']) && $_GET['f']==1) 
{
    $Success=true;
    $msgSuccess='Las Encuestas Fueron Actualizadas Correctamente';
}
if (isset($_GET['g']) && $_GET['g']==1) 
{
    $Error=false;
    $msgError='Error el N&deg; de Encuestados es Menor a las Encuestas que Ya est&aacute;n Agregadas';
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
if (isset($_GET['l']) && $_GET['l']==1) 
{
    $Error=false;
    $msgError='Error No se Puede Eliminar, La Encuesta No Est&aacute; Agregada';
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
            var cedula_doc = $("#cedula_doc").val();
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

        $("#seccion").change(function(){

            var seccion = $("#seccion").val();
            var materia = $("#materia").val();
            var busqueda = "cedula";
            $.ajax({
                type: "GET",
                url: "lib/procesamiento.php?dato="+seccion+"&busqueda="+busqueda+"&cond=sec_mat&tabla=inscripciones&count=1&cod_mat="+materia+"&lapso=<?php echo $lapso;?>",
                cache: false,
                success: function(html)
                {
                   $("#inscritos").val(html);
                } 
            });

         });

        $("#seccion").change(function(){

            var seccion = $("#seccion").val();
            var escuela = $("#escuela").val();
            var cedula_doc = $("#cedula_doc").val();
            var materia = $("#materia").val();
            var mat = materia.split("M");
            var busqueda = "encuestas_agregadas";
            var borrar = document.getElementById('borrar');


                    if (mat[0] == 'SCO')
                    {
                        $.ajax({
                            type: "GET",
                            url: "lib/procesamiento.php?dato="+seccion+"&busqueda="+busqueda+"&cond=sec_mat&tabla=encuesta_estudiantes_sc&cod_mat="+materia+"&cedula="+cedula_doc+"&cod_esc="+escuela+"&lapso=<?php echo $lapso;?>",
                            cache: false,
                            success: function(html)
                            {
                                $("#encuestas_agr").val(html);
                                var encuestas_agr = $("#encuestas_agr").val();
                                if (encuestas_agr == "") 
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
                    else if (materia == 'AAAAAAAAAAA')
                    {
                        $.ajax({
                            type: "GET",
                            url: "lib/procesamiento.php?dato="+seccion+"&busqueda="+busqueda+"&cond=sec_mat&tabla=encuesta_estudiantes_tp&cod_mat="+materia+"&cedula="+cedula_doc+"&cod_esc="+escuela+"&lapso=<?php echo $lapso;?>",
                            cache: false,
                            success: function(html)
                            {
                                $("#encuestas_agr").val(html);
                                var encuestas_agr = $("#encuestas_agr").val();
                                if (encuestas_agr == "") 
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
                            url: "lib/procesamiento.php?dato="+seccion+"&busqueda="+busqueda+"&cond=sec_mat&tabla=encuesta_estudiantes&cod_mat="+materia+"&cedula="+cedula_doc+"&cod_esc="+escuela+"&lapso=<?php echo $lapso;?>",
                            cache: false,
                            success: function(html)
                            {
                                $("#encuestas_agr").val(html);
                                var encuestas_agr = $("#encuestas_agr").val();
                                if (encuestas_agr == "") 
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

        $("#seccion").change(function(){

            var seccion = $("#seccion").val();
            var escuela = $("#escuela").val();
            var cedula_doc = $("#cedula_doc").val();
            var materia = $("#materia").val();
            var mat = materia.split("M");
            var busqueda = "n_encuestados";


                    if (mat[0] == 'SCO')
                    {
                        $.ajax({
                            type: "GET",
                            url: "lib/procesamiento.php?dato="+seccion+"&busqueda="+busqueda+"&cond=sec_mat&tabla=encuesta_estudiantes_sc&cod_mat="+materia+"&cedula="+cedula_doc+"&cod_esc="+escuela+"&lapso=<?php echo $lapso;?>",
                            cache: false,
                            success: function(html)
                            {
                               $("#encuestados").val(html);
                            } 
                        });
                    }     
                    else if (materia == 'ECS243')
                    {
                        $.ajax({
                            type: "GET",
                            url: "lib/procesamiento.php?dato="+seccion+"&busqueda="+busqueda+"&cond=sec_mat&tabla=encuesta_estudiantes_tp&cod_mat="+materia+"&cedula="+cedula_doc+"&cod_esc="+escuela+"&lapso=<?php echo $lapso;?>",
                            cache: false,
                            success: function(html)
                            {
                               $("#encuestados").val(html);
                            } 
                        });
                    }        
                    else
                    {
                        $.ajax({
                            type: "GET",
                            url: "lib/procesamiento.php?dato="+seccion+"&busqueda="+busqueda+"&cond=sec_mat&tabla=encuesta_estudiantes&cod_mat="+materia+"&cedula="+cedula_doc+"&cod_esc="+escuela+"&lapso=<?php echo $lapso;?>",
                            cache: false,
                            success: function(html)
                            {
                               $("#encuestados").val(html);
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
                <form name="FormularioEncuestaEstudiantes" action="encuestaestudiantes.php" method="post">
                        <h2 align="center">Encuesta a los Estudiantes sobre la Actuaci&oacute;n Docente</h2>
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
                                    <td>C.I. del Docente:</td>
                                    <td><input type="text" name="cedula_doc" id="cedula_doc" value="<?php if (isset($cedula_doc)){echo $cedula_doc;}?>" placeholder="C.I. del Docente" title="Seleccionar C&eacute;dula del Docente" required/></td>
                                </tr>
                                <tr>
                                    <td>Nombres:</td>
                                    <td><input type="text" name="nombres_doc" id="nombres_doc" size="30" value="<?php if (isset($nombres_doc)){echo $nombres_doc;}?>" placeholder="Nombres del Docente" readonly/></td>
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
                                </tr><tr>
                                    <td>Escuela:</td>
                                    <td><select name="escuela" id="escuela" title="Seleccionar Escuela" required>
                                        <option value ="">Escuela</option></select></td>
                                </tr><tr>
                                    <td>Secci&oacute;n:</td>
                                    <td><select name="seccion" id="seccion" title="Seleccionar Secci&oacute;n" required>
                                        <option value ="">Secci&oacute;n</option></select></td>
                                </tr>
                                <tr>
                                    <td>Fecha:</td>
                                    <td><input type="text" name="fecha" id="fecha" placeholder="Ej: AAAA-MM-DD" required/></td>   
                                <tr>
                                    <td>N&deg; Inscritos:</td>  
                                    <td><input type="text" name="inscritos" id="inscritos" value="" maxlength="2" size="1" readonly/></td>                   
                                </tr>
                                <tr>
                                    <td>N&deg; Encuestados:</td>
                                    <td><input type="text" name="encuestados" id="encuestados" value="<?php if (isset($encuestados)){echo $encuestados;}?>" title="N&deg; Encuestados Menor o Igual a N&deg; Inscritos" maxlength="2" size="1" pattern="[0-9]{0,2}" required/></td>
                                </tr>
                                <tr>
                                    <td>N&deg; Encuestas<br>Agregadas:</td>
                                    <td><input type="text" name="encuestas_agr" id="encuestas_agr" value="" maxlength="2" size="1" pattern="[0-9]{0,2}" required readonly/></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><input type="submit" name="borrar" id="borrar" value="Borrar Encuestas" disabled="true"><input type="submit" name="validar" value="Siguiente" ></td>    
                                </tr>
                            </table>
                </form>
            </div>  


<?php include('../lib/footer.php'); ?>
