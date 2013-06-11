<?php
include('../lib/session.php');
include('../lib/conexion.php');

$sql_lapso= "SELECT DISTINCT lapso FROM listaalumnos";
$result_lapso = mysql_query($sql_lapso);

if(isset($_POST['generar'])&& $_POST['generar']=='Generar PDF')
{
    $lpsc=$_POST['lpsc'];

    header("Location: informetopdf.php?lpsc=$lpsc");
}

include('lib/header.php');
?>


            <div class="columna_derecha">   
                <br />
                    
            </div>
           <div class="columna_izquierda">              
                    <?php   {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="RegistroEmpresa"></div></td><td><a href="registroempresa.php">Agregar Empresa</a></td></tr></table></div>';}?>
                    <?php   {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="ListadoEmpresa"></div></td><td><a href="listempresa.php">Ver Listado de Empresas</a></td></tr></table></div>';}?>
                    <?php   {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="Reportes"></div></td><td><a href="seleccionarlapso.php">Informe de Gestion</a></td></tr></table></div>';}?>
                    <?php   {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="SolicitudPasantias"></div></td><td><a href="solicitudpasantias.php">Agregar Solicitud de Alumno</a></td></tr></table></div>';}?>
                    <?php   {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="ListaAlumnos"></div></td><td><a href="listaalumnos.php">Ver Listado de Alumnos</a></td></tr></table></a></div>';}?>
                    <?php   {echo '<div class="favorito2"><table><tr><td><div class="favorito" id="FormularioActaEvaluacion"></div></td><td><a href="formularioactaevaluacion.php">Acta de Evaluacion del Pasante</a></td></tr></table></div>';}?>
                    <div class="favorito2"><table><tr><td><div class="favorito" id="Salir"></div></td><td><a href="../salir.php">Cerrar Sesi&oacute;n</a></td></tr></table></div>
            </div>
<div class="columna_central">
                <div>
                    <form name="SeleccionarLapso"  method="post" target="_blank">
                        <h2 align="center">Informe de Gestion</h2>
                            <table align="center">
                                <tr>
                                    <td colspan=3 align="center"><select name="lpsc" id="lpsc" title="Seleccionar Lapso" required>
                                        <option value ="">Lapso</option>
                                        <?php while($fila = mysql_fetch_assoc($result_lapso)): ?>
                                        <option value="<?php echo $fila['lapso']?>"><?php echo $fila['lapso'] ?> </option>
                                        <?php endwhile ?></select></td>
                                </tr><tr>
                                </tr><tr>
                                </tr><tr>
                                    <td colspan=3 align="center"><input type="submit" name="generar" value="Generar PDF" ></td> 
                                </table>
                    </form>
                </div>
            </div>  

<?php include('../lib/footer.php'); ?>