<?php
include('../lib/session.php');

include('../lib/conexion.php');

$sql_cedula = "SELECT cedula FROM coordinadores WHERE cod_coord='PLA/ING'";
$result_cedula=mysql_query($sql_cedula);
$result_ced=mysql_fetch_assoc($result_cedula);

include('lib/header.php'); 
?>

<script type="text/javascript">
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
                    <form name="ConsultaEncuestaAlumnos" action="PromedioEncuestaAlumnos.php" method="post">
                        <h2 align="center">Consultar Gr&aacute;ficas</h2>
                            <table align="center">
                                <tr>
                                    <td colspan=3 align="center">
                                        <select name="tipo" id="tipo" title="Seleccionar evaluaci&oacute;n" required>
                                            <option value ="">Tipo de Evaluaci&oacute;n</option>
                                            <option value ="1">Encuesta a los Estudiantes</option>
                                            <option value ="2">Supervisi&oacute;n del Desempe&ntilde;o Docente por el Coordinador</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=3 align="center">
                                        <select name="lapso" id="lapso" title="Seleccionar Lapso" required>
                                            <option value ="">Lapso</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=3 align="center"><input type="submit" name="Buscar" value="Buscar"></td> 
                                </tr>
                                </table>
                    </form>
                </div>
            </div>  

<?php include('../lib/footer.php'); ?>