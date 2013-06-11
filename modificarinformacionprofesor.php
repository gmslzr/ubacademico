<?php
include('lib/session.php');

$ced_prof=$_GET['ced_prof'];

include('lib/conexion.php');
$Success=false;
$Error=true;


$sql="SELECT * FROM profesores WHERE cedula='".$ced_prof."'";
$resultado=mysql_query($sql);
$fila=mysql_fetch_assoc($resultado);
$ced_prof=$fila['cedula'];
$nombres_prof=$fila['nombres'];
$apellidos_prof=$fila['apellidos'];
$telefono=$fila['telefono'];
$direccion=$fila['direccion'];
$titulo_pregrado=$fila['titulo_pregrado'];
$anio_titulo_pregrado=$fila['ano_titulo_pregrado'];
$titulo_postgrado=$fila['titulo_postgrado'];
$anio_titulo_postgrado=$fila['ano_titulo_postgrado'];
$area_investigacion=$fila['area_investigacion'];
$curso_comp_docente=$fila['curso_comp_docente'];
$curso_formacion_tutores=$fila['curso_formacion_tutores'];
$info_relevante=$fila['info_relevante'];
$correo_electronico=$fila['correo_electronico'];
$nucleo_prof=$fila['cod_nuc'];
$activo_prof=$fila['activo_prof'];
$fecha_nacimiento=$fila['fecha_nacimiento'];
$fecha_ingreso=$fila['fecha_ingreso'];
$carnet_prof=$fila['carnet'];
$escuela_prof=$fila['escuela'];

if(isset($_POST['guardar']) && $_POST['guardar']=='Guardar')
{
    $Error=false;
	$ced_prof=$_POST['ced_prof'];
	$nombres_prof=strtoupper($_POST['nombres_prof']);
	$apellidos_prof=strtoupper($_POST['apellidos_prof']);
	$telefono=$_POST['telefono'];
	$direccion=strtoupper($_POST['direccion']);
	$titulo_pregrado=strtoupper(utf8_decode($_POST['titulo_pregrado']));
	$anio_titulo_pregrado=$_POST['anio_titulo_pregrado'];
	$titulo_postgrado=strtoupper(utf8_decode($_POST['titulo_postgrado']));
	$anio_titulo_postgrado=$_POST['anio_titulo_postgrado'];
	$area_investigacion=strtoupper($_POST['area_investigacion']);
	$curso_comp_docente=strtoupper($_POST['curso_comp_docente']);
	$curso_formacion_tutores=$_POST['curso_formacion_tutores'];
	$info_relevante=strtoupper($_POST['info_relevante']);
	$correo_electronico=$_POST['correo_electronico'];
    $fecha_nacimiento=$_POST['fecha_nacimiento'];
    $fecha_ingreso=$_POST['fecha_ingreso'];;
	$nucleo_prof=$_POST['nucleo_prof'];
	$activo_prof=$_POST['activo_prof'];
    $carnet_prof=$_POST['carnet_prof'];
    $escuela_prof=$_POST['escuela_prof'];

    $nacimiento=explode("-",$fecha_nacimiento);
    $nacimientovalidacion=$nacimiento[0];
    $nacimientovalidacion.=$nacimiento[1];
    $nacimientovalidacion.=$nacimiento[2];

    $ingreso=explode("-",$fecha_ingreso);
    $ingresovalidacion=$ingreso[0];
    $ingresovalidacion.=$ingreso[1];
    $ingresovalidacion.=$ingreso[2];

	if(empty($nombres_prof) || strlen($nombres_prof)<2)
	{
        $msgError='Debe Escribir los Nombres del Profesor';

	}elseif(empty($apellidos_prof) || strlen($apellidos_prof)<2)
	{
        $msgError='Debe Escribir los Apellidos del Profesor';

    }elseif(empty($carnet_prof) || !is_numeric($carnet_prof))
    {
        $msgError='Debe Escribir el N&uacute;mero de Carnet del Profesor, si no posee carnet a&uacute;n debe asignarle un n&uacute;mero temporal';

    }elseif (empty($telefono)) 
    {
        $msgError='Debe Escribir el N&uacute;mero de Tel&eacute;fono del Profesor';

	}elseif(!is_numeric($telefono) || strlen($telefono)!=11)
	{
        $msgError='Error al Escribir el N&uacute;mero de Tel&eacute;fono, Por Favor Verifique';

	}elseif(empty($direccion))
	{
        $msgError='Debe Escribir una Direcci&oacute;n de Residencia para el Profesor';

	}elseif(empty($titulo_pregrado))
    {
        $msgError='Debe Escribir el T&iacute;tulo de Pregrado obtenido por el Profesor';
        
    }elseif(empty($anio_titulo_pregrado))
    {
        $msgError='Debe Escribir el A&ntilde;o en el que obtuvo el T&iacute;tulo de Pregrado el Profesor';

    }elseif(!is_numeric($anio_titulo_pregrado) || strlen($anio_titulo_pregrado)!=4)
    {
        $msgError='Debe Escribir correctamente el A&ntilde;o en el que obtuvo el T&iacute;tulo de Postgrado el Profesor';

	}elseif($anio_titulo_pregrado>=date("Y"))
    {
        $msgError='El A&ntilde;o en el que obtuvo el T&iacute;tulo de Pregrado el Profesor no puede ser mayor al a&ntilde;o actual';        
    }elseif(!empty($anio_titulo_postgrado) && (!is_numeric($anio_titulo_postgrado) || strlen($anio_titulo_postgrado)!=4))
    {
        $msgError='Debe Escribir correctamente el A&ntilde;o en el que obtuvo el T&iacute;tulo de Postgrado el Profesor';
    }elseif($anio_titulo_postgrado>=date("Y"))
    {
        $msgError='El A&ntilde;o en el que obtuvo el T&iacute;tulo de Postgrado el Profesor no puede ser mayor al a&ntilde;o actual';        
    }elseif(empty($fecha_nacimiento))
    {
        $msgError='Debe Escribir la Fecha de Nacimiento del Profesor';
        
    }elseif($nacimientovalidacion>=date("Ymd"))
    {
        $msgError='La Fecha de Nacimiento no puede ser posterior a la fecha actual';
    }elseif(empty($fecha_ingreso))
    {
        $msgError='Debe Escribir la Fecha de Ingreso del Profesor a la Instituci&oacute;n';
	}elseif($ingresovalidacion>=date("Ymd"))
    {
        $msgError='La Fecha de Ingreso a la Instituci&oacute;n no puede ser posterior a la fecha actual';
    }else
	{
		$sql_update="UPDATE profesores SET nombres='$nombres_prof', apellidos='$apellidos_prof', carnet='$carnet_prof', telefono='$telefono', direccion='$direccion', titulo_pregrado='$titulo_pregrado', ano_titulo_pregrado='$anio_titulo_pregrado', titulo_postgrado='$titulo_postgrado', ano_titulo_postgrado='$anio_titulo_postgrado', area_investigacion='$area_investigacion', curso_comp_docente='$curso_comp_docente', curso_formacion_tutores='$curso_formacion_tutores', info_relevante='$info_relevante', correo_electronico='$correo_electronico', fecha_ingreso='$fecha_ingreso', fecha_nacimiento='$fecha_nacimiento', cod_nuc='$nucleo_prof', activo_prof='$activo_prof', escuela='$escuela_prof' WHERE cedula='$ced_prof'";
		$resultado_update=mysql_query($sql_update);
		$Success=true;
        $Error=true;
        $msgSuccess='Informaci&oacute;n Actualizada Correctamente';
	}
}

include('lib/header.php');
?>
            <div class="columna_central">
                <h2>Informaci&oacute;n General</h2>
                <div class='msgAlerta'><h4>Todos los Campos Marcados con (*) son obligatorios</h4></div>
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
                </table>  
                            <?php }else{ ?>
                <form name="ModificarProfesor" action="" method="post">
                    <table>
                        <tr>
                            <td>C&eacute;dula:</td>
                            <td><div class='msgAlerta'><input type="text" name="ced_prof" readonly="readonly" size="10" value="<?php if (isset($ced_prof)){echo $ced_prof;}?>" />*</td></div>
                        </tr>
                        <tr>
                            <td>Nombres:</td>
                            <td><div class='msgAlerta'><input type="text" name="nombres_prof" size="40" value="<?php if (isset($nombres_prof)){echo $nombres_prof;}?>" />*</td></div>
                        </tr>
                        <tr>
                            <td>Apellidos:</td>
                            <td><div class='msgAlerta'><input type="text" name="apellidos_prof" size="40" value="<?php if (isset($apellidos_prof)){echo $apellidos_prof;}?>" />*</td></div>
                        </tr>
                        <tr>
                            <td width="150px">Carnet: </td>
                            <td><div class='msgAlerta'><input type="text" name="carnet_prof" title="Carnet del Profesor" placeholder="" size="10" maxlength="5"  pattern="[0-9]{5}" value="<?php if (isset($carnet_prof)){echo $carnet_prof;}?>" required/>*</td></div>
                        </tr>
                        <tr>
                            <td>Tel&eacute;fono:</td>
                            <td><div class='msgAlerta'><input type="text" name="telefono" size="11" value="<?php if (isset($telefono)){echo $telefono;}?>" />*</td></div>
                        </tr>
                        <tr>
                            <td>Direcci&oacute;n:</td>
                            <td><div class='msgAlerta'><input type="text" name="direccion" size="45" value="<?php if (isset($direccion)){echo $direccion;}?>"/>*</td></div>
                        </tr>
                        <tr>
                            <td>Correo Electr&oacute;nico:</td>
                            <td><input type="text" name="correo_electronico" id="lower" size="49" value="<?php if (isset($correo_electronico)){echo $correo_electronico;}?>" /></td>
                        </tr>
                        <tr>
                            <td>Escuela: </td>
                            <td>
                                <div class='msgAlerta'>
                                <select name="escuela_prof" required>
                                    <option value="">Elegir Escuela...</option>
                                    <?php
                                        include('procesos\conexion.php');
                                        $sqlesc="SELECT DISTINCT cod_esc, Facultad FROM escuelas";
                                        $resultadoesc=mysql_query($sqlesc);
                                        while($fila2=mysql_fetch_assoc($resultadoesc))
                                        {
                                            echo '<option value='.$fila2['cod_esc'].'>'.$fila2['Facultad'].'</option>';
                                        }
                                    ?>
                                </select>*
                            </div></td>
                        </tr>
                        <tr>
                            <td>T&iacute;tulo de Pregrado:</td>
                            <td><input type="text" name="titulo_pregrado" size="49" value="<?php if (isset($titulo_pregrado)){echo $titulo_pregrado;}?>" /></td>
                            <td>A&ntilde;o:</td>
                            <td><div class='msgAlerta'><input type="text" name="anio_titulo_pregrado" size="1" maxlength="4" value="<?php if (isset($anio_titulo_pregrado)){echo $anio_titulo_pregrado;}?>" />*</td></div>
                        </tr>
                        <tr>
                            <td>T&iacute;tulo de Postgrado:</td>
                            <td><input type="text" name="titulo_postgrado" size="49" value="<?php if (isset($titulo_postgrado)){echo $titulo_postgrado;}?>" /></td>
                            <td>A&ntilde;o:</td>
                            <td><div class='msgAlerta'><input type="text" name="anio_titulo_postgrado" size="1" maxlength="4" value="<?php if (isset($anio_titulo_postgrado)){echo $anio_titulo_postgrado;}?>" /></td></div>
                        </tr>
                        <tr>
                            <td>&Aacute;rea de Investigaci&oacute;n:</td>
                            <td><input name="area_investigacion" type="text" size="49" value="<?php if (isset($area_investigacion)){echo $area_investigacion;}?>"/></td>
                        </tr>
                        <tr>
                            <td>Curso Componente Docente:</td>
                            <td>
                                <select name="curso_comp_docente">
                                    <option value="">Elegir...</option>
                                    <option value="SI">S&iacute;</option>
                                    <option value="NO">No</option>     
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Curso Formaci&oacute;n Tutores: </td>
                            <td>
                                <select name="curso_formacion_tutores">
                                    <option value="">Elegir...</option>
                                    <option value="SI">S&iacute;</option>
                                    <option value="NO">No</option>     
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Otra Informaci&oacute;n Relevante:</td>
                            <td><input name="info_relevante" type="text" size="49" value="<?php if (isset($info_relevante)){echo $info_relevante;}?>"/></td>
                        </tr>
                        <tr>
                            <td>Fecha de Nacimiento:</td>
                            <td><div class='msgAlerta'><input type="text" name="fecha_nacimiento" id="fechanac" placeholder="Ej: AAAA-MM-DD" required value="<?php if (isset($fecha_nacimiento)){echo $fecha_nacimiento;}?>"/>*</td></div>
                        </tr>
                        <tr>
                            <td>Fecha Ingreso a la Instituci&oacute;n:</td>
                            <td><div class='msgAlerta'><input type="text" name="fecha_ingreso" id="fechaingreso" placeholder="Ej: AAAA-MM-DD" required value="<?php if (isset($fecha_ingreso)){echo $fecha_ingreso;}?>"/>*</td></div>
                        </tr>
                        <tr>
                            <td>N&uacute;cleo:</td>
                            <td><div class='msgAlerta'>
                                <select name="nucleo_prof">
                                    <?php
                                        include('procesos\conexion.php');
                                        $sqlnuc="SELECT ID, des_nucleo FROM nucleos ";
                                        $resultadonuc=mysql_query($sqlnuc);
                                        while($fila=mysql_fetch_assoc($resultadonuc))
                                        {
                                            echo '<option value='.$fila['ID'].'>'.$fila['des_nucleo'].'</option>';
                                        }
                                    ?>       
                                </select>*</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Estatus Profesor:</td>
                            <td><div class='msgAlerta'>
                                <select name="activo_prof">
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                </select>*</div>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center"><input type="submit" name="guardar" value="Guardar"></td>
                        </tr>
                    </table>
                </form>
                <?php } ?>    
            </div>  

<?php include('lib/footer.php'); ?>

<script>
document.ModificarProfesor.nucleo_prof.value='<?php if(isset($nucleo_prof)){ echo $nucleo_prof;}?>';
document.ModificarProfesor.fecha_nacimiento.value='<?php if(isset($fecha_nacimiento)){ echo $fecha_nacimiento;}?>';
document.ModificarProfesor.fecha_ingreso.value='<?php if(isset($fecha_ingreso)){ echo $fecha_ingreso;}?>';
document.ModificarProfesor.activo_prof.value='<?php if(isset($activo_prof)){ echo $activo_prof;}?>';
document.ModificarProfesor.curso_comp_docente.value='<?php if(isset($curso_comp_docente)){ echo $curso_comp_docente;}?>';
document.ModificarProfesor.curso_formacion_tutores.value='<?php if(isset($curso_formacion_tutores)){ echo $curso_formacion_tutores;}?>';
document.ModificarProfesor.escuela_prof.value='<?php if(isset($escuela_prof)){ echo $escuela_prof;}?>';
</script>
