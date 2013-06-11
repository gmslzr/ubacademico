<?php
include('lib/session.php');

include('lib/conexion.php');
$Success=false;
$Error=true;


if(isset($_POST['agregar']) && $_POST['agregar']=='Agregar')
{
    $Error=false;
	$ced_prof=$_POST['ced_prof'];
	$nombres_prof=strtoupper($_POST['nombres_prof']);
	$apellidos_prof=strtoupper($_POST['apellidos_prof']);
    $genero=$_POST['genero'];
	$telefono=$_POST['telefono'];
	$direccion=strtoupper($_POST['direccion']);
	$correo=$_POST['correo'];
    $fechanac=$_POST['fechanac'];
	$fechaingreso=$_POST['fechaingreso'];
	$pregrado=strtoupper($_POST['pregrado']);
	$aniopregrado=$_POST['aniopregrado'];
	$postgrado=strtoupper($_POST['postgrado']);
	$aniopostgrado=$_POST['aniopostgrado'];
	$areainvestigacion=strtoupper($_POST['areainvestigacion']);
	$cursocompdocente=strtoupper($_POST['cursocompdocente']);
	$cursoformtutores=$_POST['cursoformtutores'];
	$inforelevante=strtoupper($_POST['inforelevante']);
	$nucleo_prof=$_POST['nucleo_prof'];
    $carnet_prof=$_POST['carnet_prof'];
    $escuela_prof=$_POST['escuela_prof'];

    $nacimiento=explode("-",$fechanac);
    $nacimientovalidacion=$nacimiento[0];
    $nacimientovalidacion.=$nacimiento[1];
    $nacimientovalidacion.=$nacimiento[2];

    $ingreso=explode("-",$fechaingreso);
    $ingresovalidacion=$ingreso[0];
    $ingresovalidacion.=$ingreso[1];
    $ingresovalidacion.=$ingreso[2];

	$sql="SELECT * FROM profesores WHERE cedula='$ced_prof'";
	$resultado=mysql_query($sql);
	$cant=mysql_num_rows($resultado);

	if(!is_numeric($ced_prof) || strlen($ced_prof)<6 || strlen($ced_prof)>8)
	{
        $msgError='Error al Escribir la C&eacute;dula';

	}elseif($cant>=1)
	{
         $msgError='Ya Existe un Registro en la Base de Datos con este N&uacute;mero de C&eacute;dula';
     
	}elseif(empty($nombres_prof) || strlen($nombres_prof)<2)
	{
        $msgError='Debe Escribir los Nombres del Profesor';

	}elseif(empty($apellidos_prof) || strlen($apellidos_prof)<2)
	{
        $msgError='Debe Escribir los Apellidos del Profesor';
    
    }elseif(empty($carnet_prof) || !is_numeric($carnet_prof))
    {
        $msgError='Debe Escribir el N&uacute;mero de Carnet del Profesor, si no posee carnet a&uacute;n debe asignarle un n&uacute;mero temporal';

    }elseif($genero=="")
    {
        $msgError='Debe Elegir el sexo del Profesor a agregar';

    }elseif(empty($telefono)) 
    {
        $msgError='Debe Escribir el N&uacute;mero de Tel&eacute;fono del Profesor';

	}elseif(!is_numeric($telefono) || strlen($telefono)!=11)
	{
        $msgError='Error al Escribir el N&uacute;mero de Tel&eacute;fono, Por Favor Verifique';

	}elseif(empty($direccion))
	{
        $msgError='Debe Escribir una Direcci&oacute;n de Residencia para el Profesor';

	}elseif($escuela_prof=="")
    {
        $msgError='Debe Elegir a que escuela est&aacute; asigando el Profesor';

    }elseif(empty($pregrado))
	{
        $msgError='Debe Escribir el T&iacute;tulo de Pregrado obtenido por el Profesor';
        
	}elseif(empty($aniopregrado))
	{
        $msgError='Debe Escribir el A&ntilde;o en el que obtuvo el T&iacute;tulo de Pregrado el Profesor';

	}elseif(!is_numeric($aniopregrado) || strlen($aniopregrado)!=4)
	{
        $msgError='Debe Escribir correctamente el A&ntilde;o en el que obtuvo el T&iacute;tulo de Pregrado el Profesor';

	}elseif($aniopregrado>=date("Y"))
    {
        $msgError='El A&ntilde;o en el que obtuvo el T&iacute;tulo de Pregrado el Profesor no puede ser mayor al a&ntilde;o actual';        
    }elseif(!empty($aniopostgrado) && (!is_numeric($aniopostgrado) || strlen($aniopostgrado)!=4))
    {
        $msgError='Debe Escribir correctamente el A&ntilde;o en el que obtuvo el T&iacute;tulo de Postgrado el Profesor';
    }elseif($aniopostgrado>=date("Y"))
    {
        $msgError='El A&ntilde;o en el que obtuvo el T&iacute;tulo de Postgrado el Profesor no puede ser mayor al a&ntilde;o actual';        

    }elseif(empty($fechanac))
	{
        $msgError='Debe Escribir la Fecha de Nacimiento del Profesor';
        
	}elseif($nacimientovalidacion>=date("Ymd"))
    {
        $msgError='La Fecha de Nacimiento no puede ser posterior a la fecha actual';
    }elseif(empty($fechaingreso))
	{
        $msgError='Debe Escribir la Fecha de Ingreso del Profesor a la Instituci&oacute;n';
    
	}elseif($ingresovalidacion>=date("Ymd"))
    {
        $msgError='La Fecha de Ingreso a la Instituci&oacute;n no puede ser posterior a la fecha actual';
    }elseif($nucleo_prof=="")
	{
        $msgError='Debe Elegir un N&uacute;cleo de la Universidad';
     
	}else
	{
		$sql_insert="INSERT INTO profesores (cedula, nombres, apellidos, carnet, password, genero, telefono, direccion, titulo_pregrado, ano_titulo_pregrado, titulo_postgrado, ano_titulo_postgrado, area_investigacion, curso_comp_docente, curso_formacion_tutores, info_relevante, correo_electronico, fecha_ingreso, fecha_nacimiento, cod_nuc, escuela)VALUES ('$ced_prof','$nombres_prof','$apellidos_prof', '$carnet_prof', '$ced_prof', '$genero','$telefono','$direccion','$pregrado','$aniopregrado','$postgrado','$aniopostgrado','$areainvestigacion','$cursocompdocente','$cursoformtutores','$inforelevante','$correo','$fechaingreso','$fechanac','$nucleo_prof','$escuela_prof')";
		if(!$resultado=mysql_query($sql_insert)){

            echo 'hay un error';
            echo mysql_error();
        }

		$Success=true;
        $Error=true;
        $msgSuccess='Registro Agregado Correctamente';
		
	}
}
include('lib/header.php');
?>
                            <div class="columna_central">
                                <h2>Agregar Profesor</h2>
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
                                    <form name="AgregarProfesor" action="" method="post">
                                        <table>
                                            <tr>
                                                <td width="150px">C&eacute;dula: </td>
                                                <td><div class='msgAlerta'><input type="text" name="ced_prof" title="C&eacute;dula del Profesor" placeholder="" size="10" maxlength="8"  pattern="[0-9]{6,9}" value="<?php if (isset($ced_prof)){echo $ced_prof;}?>" required/>*</td></div>
                                            </tr>
                                            <tr>
                                                <td>Nombres: </td>
                                                <td><div class='msgAlerta'><input type="text" name="nombres_prof" title="Nombres del Profesor" placeholder="" size="40" value="<?php if (isset($nombres_prof)){echo $nombres_prof;}?>" required/>*</td></div>
                                            </tr>
                                            <tr>
                                                <td>Apellidos: </td>
                                                <td><div class='msgAlerta'><input type="text" name="apellidos_prof" title="Apellidos del Profesor" placeholder="" size="40" value="<?php if (isset($apellidos_prof)){echo $apellidos_prof;}?>" required/>*</td></div>
                                            </tr>
                                            <tr>
                                                <td width="150px">Carnet: </td>
                                                <td><div class='msgAlerta'><input type="text" name="carnet_prof" title="Carnet del Profesor" placeholder="" size="10" maxlength="5"  pattern="[0-9]{5}" value="<?php if (isset($carnet_prof)){echo $carnet_prof;}?>" required/>*</td></div>
                                            </tr>
                                            <tr>
                                                <td>G&eacute;nero: </td>
                                                <td>
                                                    <div class='msgAlerta'>
                                                    <select name="genero" required>
                                                    <option value="">Elegir Sexo...</option>
                                                    <option value="F">Femenino</option>
                                                    <option value="M">Masculino</option>     
                                                    </select>*</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tel&eacute;fono: </td>
                                                <td><div class='msgAlerta'><input type="text" name="telefono" title="N&uacute;mero de Tel&eacute;fono del Profesor" placeholder="" maxlength="11" size="11" pattern="[0-9]{11}" value="<?php if (isset($telefono)){echo $telefono;}?>" required/>*</td></div>
                                            </tr>
                                            <tr>
                                                <td>Direcci&oacute;n: </td>
                                                <td><div class='msgAlerta'><input type="text" name="direccion" title="Direcci&oacute;n de Vivienda" placeholder="" size="45" value="<?php if (isset($direccion)){echo $direccion;}?>" required/>*</td></div>
                                            </tr>
                                            <tr>
                                                <td>Correo Electr&oacute;nico: </td>
                                                <td><input type="text" name="correo" id="lower" title="Correo Electr&oacute;nico del Profesor" placeholder="" size="45" value="<?php if (isset($correo)){echo $correo;}?>" /></td>
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
                                                <td>T&iacute;tulo de Pregrado: </td>
                                                <td><input type="text" name="pregrado" title="T&iacute;tulo de Pregrado del Profesor" placeholder="" size="45"  value="<?php if (isset($pregrado)){echo $pregrado;}?>" required/></td>
                                                <td>A&ntilde;o: </td>
                                                <td><div class='msgAlerta'><input type="text" name="aniopregrado" title="A&ntilde;o de Obtenci&oacute;n del T&iacute;tulo de Pregrado" placeholder="A&ntilde;o" size="4" maxlength="4" pattern="[0-9]{4}" value="<?php if (isset($aniopregrado)){echo $aniopregrado;}?>" required/>*</div></td>
                                            </tr>
                                            </tr>
                                            <tr>
                                                <td>T&iacute;tulo de Postgrado: </td>
                                                <td><input type="text" name="postgrado" title="T&iacute;tulo de Postgrado del Profesor" placeholder="" size="45" value="<?php if (isset($postgrado)){echo $postgrado;}?>" /></td>
                                                <td>A&ntilde;o: </td>
                                                <td><input type="text" name="aniopostgrado" title="A&ntilde;o de Obtenci&oacute;n del T&iacute;tulo de Postgrado" placeholder="A&ntilde;o" size="4" maxlength="4" pattern="[0-9]{4}" value="<?php if (isset($aniopostgrado)){echo $aniopostgrado;}?>" /></td>
                                            </tr>
                                            <tr>
                                                <td>&Aacute;rea de Investigaci&oacute;n: </td>
                                                <td><input name="areainvestigacion" type="text" title="&Aacute;rea de Investigaci&oacute;n del Profesor" placeholder="" size="45" value="<?php if (isset($areainvestigacion)){echo $areainvestigacion;}?>"/></td>
                                            </tr>
                                            <tr>
                                                <td>Curso Componente Docente: </td>
                                                <td>
                                                    <select name="cursocompdocente">
                                                        <option value="">Elegir...</option>
                                                        <option value="SI">S&iacute;</option>
                                                        <option value="NO">No</option>     
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Curso Formaci&oacute;n Tutores: </td>
                                                <td>
                                                    <select name="cursoformtutores">
                                                        <option value="">Elegir...</option>
                                                        <option value="SI">S&iacute;</option>
                                                        <option value="NO">No</option>     
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Otra Informaci&oacute;n Relevante: </td>
                                                <td><input name="inforelevante" type="text" title="Otra Informaci&oacute;n Relevante del Profesor" placeholder="" size="45" value="<?php if (isset($inforelevante)){echo $inforelevante;}?>"/></td>
                                            </tr>
                                            <tr>
                                                <td>Fecha de Nacimiento: </td>
                                                <td><div class='msgAlerta'><input type="text" name="fechanac" id="fechanac" placeholder="Ej: AAAA-MM-DD" required />*</td></div>
                                            </tr>
                                                <td>Fecha Ingreso Instituci&oacute;n: </td>
                                                <td><div class='msgAlerta'><input type="text" name="fechaingreso" id="fechaingreso" placeholder="Ej: AAAA-MM-DD" required />*</td></div>
                                            </tr>
                                            <tr>
                                                <td>N&uacute;cleo: </td>
                                                <td><div class='msgAlerta'>
                                                    <select name="nucleo_prof" required>
                                                        <option value="">Elegir N&uacute;cleo...</option>
                                                        <?php
                                                            include('procesos\conexion.php');
                                                            $sqlnuc="SELECT ID, des_nucleo FROM nucleos ";
                                                            $resultadonuc=mysql_query($sqlnuc);
                                                            while($fila=mysql_fetch_assoc($resultadonuc))
                                                            {
                                                                echo '<option value='.$fila['ID'].'>'.$fila['des_nucleo'].'</option>';
                                                            }
                                                        ?>
                                                        </select>*
                                                </div></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center"><input type="submit" name="agregar" value="Agregar"></td>
                                            </tr>
                                            
                                        </table>
                                    </form>
                                <?php } ?>
                            </div>
<?php include('lib/footer.php'); ?> 
<script>
document.AgregarProfesor.fechanac.value='<?php if(isset($fechanac)){ echo $fechanac;}?>';
document.AgregarProfesor.fechaingreso.value='<?php if(isset($fechaingreso)){ echo $fechaingreso;}?>';
document.AgregarProfesor.nucleo_prof.value='<?php if(isset($nucleo_prof)){ echo $nucleo_prof;}?>';
document.AgregarProfesor.genero.value='<?php if(isset($genero)){ echo $genero;}?>';
document.AgregarProfesor.cursocompdocente.value='<?php if(isset($cursocompdocente)){ echo $cursocompdocente;}?>';
document.AgregarProfesor.cursoformtutores.value='<?php if(isset($cursoformtutores)){ echo $cursoformtutores;}?>';
document.AgregarProfesor.escuela_prof.value='<?php if(isset($escuela_prof)){ echo $escuela_prof;}?>';
</script>