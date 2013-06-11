<?php
include('../lib/session.php');

include('../lib/conexion.php');

$sql_cedula = "SELECT cedula FROM coordinadores WHERE cod_coord='PLA/ING'";
$result_cedula=mysql_query($sql_cedula);
$result_ced=mysql_fetch_assoc($result_cedula);

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
    $msgError='Error Debe Seleccionar un Lapso';
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
                    url: "lib/procesamiento.php?dato="+cedula_doc+"&busqueda="+busqueda+"&cond=cedula&tabla=encuesta_estudiantes_tp&multiple=materia",
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
            var busqueda = "lapso";
            var cedula_doc = $("#cedula_doc").val();
            $.ajax({
                type: "GET",
                url: "lib/procesamiento.php?dato="+materia+"&busqueda="+busqueda+"&cond=cod_mat&tabla=encuesta_estudiantes_tp&multiple=lapso_cons&cedula="+cedula_doc+"",
                cache: false,
                success: function(html)
                {
                   $("#lapso_cons").html(html);
                } 
            });

         });

        $("#lapso_cons").change(function(){

            var lapso_cons = $("#lapso_cons").val();
            var materia = $("#materia").val();
            var cedula_doc = $("#cedula_doc").val();
            var busqueda = "sec_mat";
            $.ajax({
                type: "GET",
                url: "lib/procesamiento.php?dato="+lapso_cons+"&busqueda="+busqueda+"&cond=lapso&tabla=encuesta_estudiantes_tp&multiple=seccion&cod_mat="+materia+"&cedula="+cedula_doc+"",
                cache: false,
                success: function(html)
                {
                   $("#seccion").html(html);
                } 
            });

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
                <div>
                    <form name="ConsultaEncuestaEstudiantesTP" action="promedioencuestaestudiantestptopdf.php" method="post" target="_blank">
                        <h2 align="center">Encuesta a Los Estudiantes sobre la Actuaci&oacute;n Docente para Asignaturas Te&oacute;rico - Pr&aacute;cticas</h2>
                            <table align="center">
                                <tr>
                                    <td>C.I. del Docente:</td>
                                    <td><input type="text" name="cedula_doc" id="cedula_doc" value="" placeholder="C.I. del Docente" title="Seleccionar C&eacute;dula del Docente" required/></td>
                                </tr><tr>
                                    <td>Nombres:</td>
                                    <td><input type="text" name="nombres_doc" id="nombres_doc" size="30" value="" placeholder="Nombres del Docente" readonly/></td>
                                </tr><tr>
                                    <td>Apellidos:</td>
                                    <td><input type="text" name="apellidos_doc" id="apellidos_doc" size="30" value="" placeholder="Apellidos del Docente" readonly/></td>
                                </tr><tr>
                                    <td>Materia:</td>
                                    <td><select name="materia" id="materia" title="Seleccionar Materia" required>
                                        <option value ="">Materia</option></select></td>
                                </tr><tr>
                                    <td>C&aacute;tedra:</td>
                                    <td><select name="catedra"  id="catedra" title="Seleccionar Catedra" required>
                                        <option value ="">Catedra</option></select></td>
                                </tr><tr>
                                    <td>Escuela:</td>
                                    <td><select name="escuela" id="escuela" title="Seleccionar Escuela" required>
                                        <option value ="">Escuela</option></select></td>
                                </tr><tr>
                                    <td>Lapso:</td>
                                    <td><select name="lapso_cons" id="lapso_cons" title="Seleccionar Lapso" required>
                                        <option value ="">Lapso</option></select></td>
                                </tr><tr>
                                    <td>Secci&oacute;n:</td>
                                    <td><select name="seccion" id="seccion" title="Seleccionar Secci&oacute;n" required>
                                        <option value ="">Secci&oacute;n</option></select></td>
                                </tr>
                                    <td colspan=2 align="center"><input type="submit" name="buscar" value="Buscar"></td> 
                            </table>
                    </form>
                </div>
            </div>  

<?php include('../lib/footer.php'); ?>