<?php
include('../lib/session.php');
include('../lib/conexion.php');
$Error=false;
$Success =false;
	


$sqlAreas = "SELECT * FROM perfiles";
//Ejecutar la consulta
$areas = mysql_query($sqlAreas);

$sqldireccion = "SELECT * FROM regiones";
//Ejecutar la consulta
$result_direc = mysql_query($sqldireccion);

$sqlestados = "SELECT * FROM estados";
				//Ejecutar la consulta
$result_estados = mysql_query($sqlestados);

$sqlmunicipios = "SELECT * FROM municipios";
				//Ejecutar la consulta
$result_municipios = mysql_query($sqlmunicipios);

$sqlparroquias = "SELECT * FROM parroquias";
				//Ejecutar la consulta
$result_parroquias = mysql_query($sqlparroquias);

$sqltutores = "SELECT * FROM tutorindustrial";
//Ejecutar la consulta
$tutores = mysql_query($sqltutores);

$codEmp = $_GET['codEmp'];

//consulto la bd para ver si existe el registro
$sql="SELECT * FROM empresas WHERE codEmp='$codEmp' ";
//ejecuto consulta
$resultado = mysql_query($sql);

$fila = mysql_fetch_assoc($resultado);

$nom_emp=$fila['nom_emp'];
$direc_emp=$fila['direc_emp'];
$estados=$fila['cod_estado'];
$municipios=$fila['cod_municipio'];
$parroquia=$fila['cod_parroquia'];
$zona=$fila['zona'];
$telf_emp=$fila['telf_emp'];

$tipoempresa=$fila['tipoempresa'];
$vacantes=$fila['vacantes'];

$sqlselectarea="SELECT codPer FROM empresas_area WHERE codEmp='$codEmp'";
$resultarea = mysql_query($sqlselectarea);
$fila1 = mysql_fetch_assoc($resultarea);
$area=$fila1['codPer'];
	
	$sqlselectTutor="SELECT codTutor FROM empresas_tutor WHERE codEmp='$codEmp'";
	$resultadotutor = mysql_query($sqlselectTutor);
	$fila2 = mysql_fetch_assoc($resultadotutor);
	$tutorindustrial=$fila2['codTutor'];

if(isset($_POST['validar']))
{ 

						$nom_emp=$_POST['nom_emp'];
						$direc_emp=$_POST['direc_emp'];
						$estados=$_POST['cod_estado'];
						$municipios=$_POST['cod_municipio'];
						$parroquia=$_POST['cod_parroquia'];
						$zona=$_POST['codReg'];
						
						$telf_emp=$_POST['telf_emp'];
						$tutorindustrial=$_POST['codTutor'];
						$area=$_POST['codPer'];
						$tipoempresa=$_POST['tipoempresa'];
						$vacantes=$_POST['vacantes'];
		//si la validacion es correcta guardamos
	
		$sql ="UPDATE empresas SET nom_emp='$nom_emp',direc_emp='$direc_emp',cod_estado='$estados', cod_municipio='$municipios', cod_parroquia='$parroquia', zona='$zona', telf_emp='$telf_emp',tipoempresa='$tipoempresa', vacantes='$vacantes' WHERE codEmp='$codEmp'";
		$sql_insertarArea = "UPDATE empresas_area SET codPer= '$area' WHERE codEmp = $codEmp";
		$sql_insertarTutor ="UPDATE  empresas_tutor SET codTutor = '$tutorindustrial' WHERE codEmp = $codEmp";

		//ejecutar consulta
		$resultado = mysql_query($sql);
		$resultadotutor = mysql_query($sql_insertarTutor);
		$resultadoarea = mysql_query($sql_insertarArea);
		$Error=false;
                  $Success=true;
                    if($resultado){
                            $msgSuccess="Los datos de la Empresa fueron actualizados correctamente.";
                    }
                    else{
                      echo mysql_error();
                    }
			
}

$tipoEmpresa1 = "";
$tipoEmpresa2 = "";

	if($tipoempresa == 'Privada')
		{
			$tipoEmpresa1 ='selected';
		}
		else
			{
				$tipoEmpresa2 ='selected';
			}
			
include('lib/header.php');?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#cod_estado").change(function(){
            var estado = $("#cod_estado").val();
            var busqueda = "cod_municipio,nombre_municipio";
                $.ajax({
                    type: "GET",
                    url: "lib/procesamiento.php?dato="+estado+"&busqueda="+busqueda+"&cond=cod_estado&tabla=municipios&multiple=nombre_municipio",
                    cache: false,
                    success: function(html)
                    {
                        $("#nombre_municipio").html(html);
                    } 
                });
            }); 
		
        $("#nombre_municipio").change(function(){
            var municipios = $("#nombre_municipio").val();
           	var busqueda = "cod_parroquia,nombre_parroquia";
                $.ajax({
                    type: "GET",
                    url: "lib/procesamiento.php?dato="+municipios+"&busqueda="+busqueda+"&cond=cod_municipio&tabla=parroquias&multiple=nombre_parroquia",
                    cache: false,
                    success: function(html)
                    {
                        $("#nombre_parroquia").html(html);
                      
                    } 
                });
            }); 
	});

</script>
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
<h2>Actualizar Datos de la Empresa</h2>
<form name="actualizardatos" action="" method="post">
		<table>
			<?php 
                if($Success==true && isset($Success)){ ?>
                <tr>
                  <td colspan="2">
                    <div class="success"><?php echo $msgSuccess ?></div>
                  </td>
                </tr> 
            <?php } ?>
		   		<td>Nombre</td>
				<td><input type="text" name="nom_emp" value="<?php echo $nom_emp;?>" placeholder="Nombre de la Empresa" title="Se necesita un nombre." required></td>
			</tr>
			<tr>
				<td>Direccion</td>
				<td><input name="direc_emp" type="text" value="<?php echo $direc_emp;?>" size="50" required></td>
			</tr>
			<tr>
				<td>Estado</td>
				<td>	
					<select name="cod_estado" id="cod_estado" required>
						<option value ="">Seleccione un estado</option>
						<?php while($fila = mysql_fetch_assoc($result_estados)): ?>
							<option value="<?php echo $fila['cod_estado']?>" <?php echo ($estados == $fila['cod_estado'])?"selected='selected'":""; ?> ><?php echo $fila['nombre_estado'] ?> </option>
						<?php endwhile ?>
					</select> 
				</td>
			</tr>
			<tr>
				<td>Municipio</td>
				<td><select name="cod_municipio" id="nombre_municipio" required>
						<option value ="">Seleccione un municipio</option>
						<?php while($fila = mysql_fetch_assoc($result_municipios)): ?>
							<option value="<?php echo $fila['cod_municipio']?>" <?php echo ($municipios == $fila['cod_municipio'])?"selected='selected'":""; ?> ><?php echo $fila['nombre_municipio'] ?> </option>
						<?php endwhile ?></td>
			</tr>
			<tr>
				<td>Parroquia</td>
				<td><select name="cod_parroquia" id="nombre_parroquia" required>
						<option value ="">Seleccione una parroquia</option>
						<?php while($fila = mysql_fetch_assoc($result_parroquias)):  ?>

							<option value="<?php echo $fila['cod_parroquia']?>" <?php echo ($parroquia == $fila['cod_parroquia'])?"selected='selected'":""; ?> ><?php echo $fila['nombre_parroquia']?> </option>
						<?php endwhile ?></td>
			</tr>
			<tr>
				<td>Zona</td>
				<td>
						<select name="codReg" title="Por favor Seleccione una zona" required>
							<option value ="">Seleccione un zona</option>
								<?php while($fila = mysql_fetch_assoc($result_direc)): ?>
							<option value="<?php echo $fila['codReg']?>" <?php echo ($zona == $fila['codReg'])?"selected='selected'":""; ?> ><?php echo $fila['region'] ?> </option>						<?php endwhile ?>
						</select>
				</td>
			</tr>
			<tr>
				<td>Telefono</td>
				<td><input type="text" name="telf_emp" value="<?php echo $telf_emp;?>"  size="11" pattern="[0-9]{11}" title="El numero debe tener 11 valores  ej.12345678910." required></td>
			</tr>
			<tr>
				<td>Tutor Industrial</td>
				<td><select name="codTutor" title="Por favor Seleccione un tutor" required>
						<option value ="">Seleccione un Tutor</option>
						<?php while($fila2 = mysql_fetch_assoc($tutores)): ?>
						<option value="<?php echo $fila2['codTutor']?>" <?php echo ($tutorindustrial == $fila2['codTutor'])?"selected='selected'":""; ?> ><?php echo $fila2['nombre'] ?> </option>						<?php endwhile ?>
				</select></td>
			</tr>
			<tr>
				<td>Area</td>			
				<td>
					
					<select name="codPer" required>
						<option value ="">Seleccione un area</option>
						<?php while($fila1 = mysql_fetch_assoc($areas)): ?>
							<option value="<?php echo $fila1['codPer']?>" <?php echo ($area == $fila1['codPer'])?"selected='selected'":""; ?> ><?php echo $fila1['perfil'] ?> </option>
						<?php endwhile ?>
				</select> </td>
			</tr>
            <tr>
				<td>Tipo de Empresa</td>
				<td><select name="tipoempresa" title="No ha seleccionado un tipo." required>
					<option value="">Seleccione un tipo</option>
					<option value="Privada" <?php echo $tipoEmpresa1 ?> >Privada</option>
					<option value="Publica" <?php echo $tipoEmpresa2 ?> >Publica</option></select></td>
			</tr>
			<tr>
				<td>Vacantes</td>
				<td><input type="text" name="vacantes" value="<?php echo $vacantes;?>"  title="No ha introducido los puestos disponibles"required></td>
			</tr>
			<td colspan="2" style="text-align: center"></td>
		</table>
		<input type="submit" name="validar" value="Actualizar"> <a href="listempresa.php">Ir al Listado</a>
	</form>
</div>