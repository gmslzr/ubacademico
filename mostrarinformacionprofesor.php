<?php
include('lib/session.php');

$ced_prof=$_GET['ced_prof'];

include('lib/conexion.php');


$sql="SELECT * FROM profesores WHERE cedula='$ced_prof'";
$resultado=mysql_query($sql);
$fila=mysql_fetch_assoc($resultado);

if(isset($_POST['modificar']) && $_POST['modificar']='Modificar')
{
	header("Location: modificarinformacionprofesor.php?ced_prof=$ced_prof");
}

include('lib/header.php');

?>
            <div class="columna_central">
                <h2>Mostrar Informaci&oacute;n de Profesor</h2>
                 <form name="AsignarProfesor" action="" method="post">
                    <table width="80%">
                         <tr>
                            <td>C&eacute;dula:</td>
                            <td><?php echo $fila['cedula']?></td>
                        </tr>
                        <tr>
                            <td>Nombres:</td>
                            <td><?php echo utf8_encode($fila['nombres'])?></td>
                        </tr>
                        <tr>
                                <td>Apellidos:</td>
                                <td><?php echo utf8_encode($fila['apellidos'])?></td>
                        </tr>
                        <tr>
                            <td>Fecha de Nacimiento:</td>
                            <td>
                                <?php
                                    $fechanac=explode("-",$fila['fecha_nacimiento']);
                                    echo $fechanac[2].'-'.$fechanac[1].'-'.$fechanac[0]; 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Carnet:</td>
                            <td><?php echo $fila['carnet']?></td>
                        </tr>
                        <tr>
                            <td>Tel&eacute;fono:</td>
                            <td><?php echo $fila['telefono']?></td>
                        </tr>
                        <tr>
                            <td>Direcci&oacute;n:</td>
                            <td><?php echo utf8_encode($fila['direccion'])?></td>
                        </tr>
                        <tr>
                            <td>T&iacute;tulo de Pregrado:</td>
                            <td><?php echo utf8_encode($fila['titulo_pregrado'])?></td> 
                            <td>A&ntilde;o:</td><td><?php echo $fila['ano_titulo_pregrado']?></td>
                        </tr>
                        <tr>
                            <td>T&iacute;tulo de Postgrado:</td>
                            <td><?php echo utf8_encode($fila['titulo_postgrado'])?></td> 
                            <td>A&ntilde;o:</td><td><?php echo $fila['ano_titulo_postgrado']?></td>
                        </tr>
                        <tr>
                            <td>&Aacute;rea de Investigaci&oacute;n:</td>
                            <td><?php echo utf8_encode($fila['area_investigacion'])?></td>
                        </tr>
                        <tr>
                            <td>Curso Componente Docente:</td>
                            <td><?php echo utf8_encode($fila['curso_comp_docente'])?></td>
                        </tr>
                        <tr>
                            <td>Curso Formaci&oacute;n de Tutores:</td>
                            <td><?php echo utf8_encode($fila['curso_formacion_tutores'])?></td>
                        </tr>
                        <tr>
                            <td>Informaci&oacute;n Relevante:</td>
                            <td><?php echo utf8_encode($fila['info_relevante'])?></td>
                        </tr>
                        <tr>
                            <td>Correo Electr&oacute;nico:</td>
                            <td><?php echo utf8_encode($fila['correo_electronico'])?></td>
                        </tr>
                        <tr>
                            <td>Fecha de Ingreso a la Instituci&oacute;n:</td>
                            <td>
                                <?php
                                    $fechaingreso=explode("-",$fila['fecha_ingreso']);
                                    echo $fechaingreso[2].'-'.$fechaingreso[1].'-'.$fechaingreso[0]; 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Escuela: </td>
                            <td><?php
                                $sql_escuela="SELECT Facultad FROM escuelas WHERE cod_esc=".$fila['escuela'];
                                $rs=mysql_query($sql_escuela);
                                $escuela=mysql_fetch_assoc($rs);
                                echo $escuela['Facultad'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>N&uacute;cleo:</td>
                            <td>
                                <?php
                                    $sql_nuc="SELECT des_nucleo FROM nucleos WHERE ID=".$fila['cod_nuc'];
                                    $rs=mysql_query($sql_nuc);
                                    $desc_cod_nuc=mysql_fetch_assoc($rs);
                                    echo $desc_cod_nuc['des_nucleo'];
                                    /*if($fila['cod_nuc']==0){echo 'San Joaqu&iacute;n';}
                                    if ($fila['cod_nuc']==1){echo 'San Antonio de los Altos';}
                                    if ($fila['cod_nuc']==2){echo 'Apure';}
                                    if ($fila['cod_nuc']==3){echo 'Pto. Ord&aacute;z';}*/
                                ?>
                            </td>
                        </tr>
                            <?php
                                if($fila['activo_prof']==1)
                                {   
                                    echo '<tr>
                                            <td>Activo:</td>
                                            <td>S&iacute;</td>                   
                                        </tr>';
                                }else
                                {
                                    echo '<tr>
                                            <td>Activo:</td>
                                            <td>No</td>                   
                                        </tr>';
                                }
                                if($fila['coord_estatus']==1)
                                {
                                    echo '<tr>
                                            <td>Coordinador:</td>
                                            <td>S&iacute;</td>                   
                                        </tr>';
                                    $sql_coordinacion="SELECT * FROM coordinadores WHERE cedula=$ced_prof";
                                    $result_coordinacion=mysql_query($sql_coordinacion);
                                    while($cod_coord=mysql_fetch_assoc($result_coordinacion))
                                    {   
                                        $coordinacion=explode("/",$cod_coord['cod_coord']);
                                        $sercom=explode("M",$cod_coord['cod_coord']);

                                        if($coordinacion[0]=='PLA')
                                        {
                                            $sql_catedra="SELECT valores FROM tbl_configuraciones WHERE descripcion='coord_planificacion_".$coordinacion[1]."_desc'";
                                            $resultado_catedra=mysql_query($sql_catedra);
                                            $fila2=mysql_fetch_assoc($resultado_catedra);

                                            echo '<tr>
                                                    <td>Coordinaci&oacute;n:</td>
                                                    <td>'.$fila2['valores'].'</td>
                                                </tr>';

                                        }elseif($coordinacion[0]=='INV')
                                        {
                                            $sql_catedra="SELECT valores FROM tbl_configuraciones WHERE descripcion='coord_investigacion_".$coordinacion[1]."_desc'";
                                            $resultado_catedra=mysql_query($sql_catedra);
                                            $fila2=mysql_fetch_assoc($resultado_catedra);

                                            echo '<tr>
                                                    <td>Coordinaci&oacute;n:</td>
                                                    <td>'.$fila2['valores'].'</td>
                                                </tr>';

                                        }elseif($coordinacion[0]=='PAS')
                                        {
                                            $sql_catedra="SELECT valores FROM tbl_configuraciones WHERE descripcion='coord_pasantia_".$coordinacion[1]."_desc'";
                                            $resultado_catedra=mysql_query($sql_catedra);
                                            $fila2=mysql_fetch_assoc($resultado_catedra);

                                            echo '<tr>
                                                    <td>Coordinaci&oacute;n:</td>
                                                    <td>'.$fila2['valores'].'</td>
                                                </tr>';

                                        }elseif($sercom[0]=='SCO')
                                        {
                                            $sql_catedra="SELECT valores FROM tbl_configuraciones WHERE descripcion='coord_sercomunitario_".$sercom[1]."_desc'";
                                            $resultado_catedra=mysql_query($sql_catedra);
                                            $fila2=mysql_fetch_assoc($resultado_catedra);

                                            echo '<tr>
                                                    <td>Coordinaci&oacute;n:</td>
                                                    <td>'.$fila2['valores'].'</td>
                                                </tr>';
                                        }elseif($coordinacion[0]=='LAB')
                                        {
                                            $sql_catedra="SELECT valores FROM tbl_configuraciones WHERE descripcion='coordinacion_laboratorios_".$coordinacion[1]."_desc'";
                                            $resultado_catedra=mysql_query($sql_catedra);
                                            $fila2=mysql_fetch_assoc($resultado_catedra);

                                            echo '<tr>
                                                    <td>Coordinaci&oacute;n:</td>
                                                    <td>'.$fila2['valores'].'</td>
                                                </tr>';
                                        }elseif($cod_coord['cod_coord']=='GESAC')
                                        {
                                            $sql_catedra="SELECT valores FROM tbl_configuraciones WHERE descripcion='coordinacion_gestion_academica_desc'";
                                            $resultado_catedra=mysql_query($sql_catedra);
                                            $fila2=mysql_fetch_assoc($resultado_catedra);

                                            echo '<tr>
                                                    <td>Coordinaci&oacute;n:</td>
                                                    <td>'.$fila2['valores'].'</td>
                                                </tr>';
                                        }else
                                        {
                                            $sql_catedra="SELECT desc_catedra FROM h_catedra WHERE cod_catedra='".$cod_coord['cod_coord']."'";
                                            $resultado_catedra=mysql_query($sql_catedra);
                                            $fila2=mysql_fetch_assoc($resultado_catedra);
                                                
                                            echo '<tr>
                                                    <td>Coordinaci&oacute;n:</td>
                                                    <td>'.$fila2['desc_catedra'].'</td>
                                                </tr>';
                                        }
                                                             
                                    }    
                                }else
                                {
                                    echo '<tr>
                                            <td>Coordinador:</td>
                                            <td>No</td>                   
                                        </tr>';
                                }
                            ?>
                        <tr>
                            <td colspan="2" style="text-align: center"><input type="submit" name="modificar" value="Modificar"></td>
                        </tr> 
                    </table>
                    </form>
                </div>
            </div>  

<?php include('lib/footer.php'); ?>


