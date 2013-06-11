<?php
include('../lib/session.php');

include('../lib/conexion.php');

$sql_cedula = "SELECT cedula FROM coordinadores WHERE cod_coord='PLA/ING'";
$result_cedula=mysql_query($sql_cedula);
$result_ced=mysql_fetch_assoc($result_cedula);

if(isset($_POST['validar']) && $_POST['validar']='Siguiente')
        { 
            $tipo_ev=$_POST['tipo_ev'];
            if ($tipo_ev==1){ 

                header("Location: consultaevaluaciondocente.php");

            }else
            {

                header("Location: consultaevaluaciondocenteplanificacion.php");

            }
        }

include('lib/header.php'); 

?>
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
                <form name="FormularioEncuestaEstudiantes" action="" method="post">
                        <h2 align="center">Seleccionar el Tipo de Evaluaci&oacute;n Docente</h2><br>
                            <table align="center">
                                    <td align="center"><label>Tipo de Evaluaci&oacute;n:</label></td>
                                </tr>
                                <tr>
                                    <td><select name="tipo_ev" id="tipo_ev" title="Seleccionar Encuesta" required= "true">
                                        <option value ="">Tipo de Evaluaci&oacute;n</option>
                                        <option value ="1">Supervisi&oacute;n del Desempe&ntilde;o Docente por el Coordinador de C&aacute;tedra</option>
                                        <option value ="2">Supervisi&oacute;n del Desempe&ntilde;o Docente por el Coordinador de CPEYAD</option></select></td>
                                </tr>
                                    <td align="center"><input type="submit" name="validar" value="Siguiente" ></td>    
                            </table>
                </form>
            </div>  


<?php include('../lib/footer.php'); ?>