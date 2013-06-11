<?php 
include('../lib/session.php');
include('../lib/conexion.php');
$Error=false;
$Success=false;


		$sqlAreas = "SELECT * FROM perfiles WHERE cod_escuela= $cod_pas_escu ";
		//Ejecutar la consulta
		$areas = mysql_query($sqlAreas);

			$sqldireccion = "SELECT * FROM regiones";
			//Ejecutar la consulta
			$result_direc = mysql_query($sqldireccion);

				$sqltutores = "SELECT * FROM tutorindustrial";
				//Ejecutar la consulta
				$tutores = mysql_query($sqltutores);

				$sqlestados = "SELECT * FROM estados";
				//Ejecutar la consulta
				$result_estados = mysql_query($sqlestados);

/*Validaciones PHP */
if(isset($_GET['x']) && $_GET['x'] == 1){
	$Error=true;
	$msgError="El nombre de la empresa no puede estar vacio.";
}

if(isset($_GET['b']) && $_GET['b'] == 1){
	$Error=true;
	$msgError="La direccion no puede estar vacia.";
}

if(isset($_GET['z']) && $_GET['z'] == 1){
	$Error=true;
	$msgError="Debe seleccionar un Estado.";
}

if(isset($_GET['w']) && $_GET['w'] == 1){
	$Error=true;
	$msgError="Debe Seleccionar un Municipio.";
}

if(isset($_GET['y']) && $_GET['y'] == 1){
	$Error=true;
	$msgError="Debe Seleccionar una Parroquia.";
}

if(isset($_GET['c']) && $_GET['c'] == 1){
	$Error=true;
	$msgError="Debe seleccionar una Zona";
}

if(isset($_GET['h']) && $_GET['h'] == 1){
	$Error=true;
	$msgError="El telefono de la empresa debe tener 11 digitos.";
}

if(isset($_GET['k']) && $_GET['k'] == 1){
	$Error=true;
	$msgError="Debe asignar un nombre a Tutor Industrial. ";
}

if(isset($_GET['l']) && $_GET['l'] == 1){
	$Error=true;
	$msgError="Debe seleccionar un area.";
}

if(isset($_GET['v']) && $_GET['v'] == 1){
	$Error=true;
	$msgError="Debe seleccionar un tipo de Empresa.";
}
   
if(isset($_GET['i']) && $_GET['i'] == 1){
	$Error=true;
	$msgError="El Numero de vacantes debe ser mayor a 0.";
}



if(isset($_POST['validar'])&& $_POST['validar']=='Guardar')
			{ 
						$nom_emp=$_POST['nom_emp'];
						$direc_emp=$_POST['direc_emp'];
						$estados=$_POST['cod_estado'];
						$municipios=$_POST['nombre_municipio'];
						$parroquia=$_POST['nombre_parroquia'];
						$zona=$_POST['zona'];
						/*$agr_zona =$_POST['agr_zona'];*/
						$telf_emp=$_POST['telf_emp'];
						$tutorindustrial=$_POST['tutorindustrial'];
						$area=$_POST['area'];
						$tipoempresa=$_POST['tipoempresa'];
						$vacantes=$_POST['vacantes'];

if(empty($nom_emp) ){
		header("Location: registroempresa.php?x=1");
}

elseif(empty($direc_emp) ){
		header("Location: registroempresa.php?b=1");
}

elseif(empty($estados)){
		header("Location: registroempresa.php?z=1");
}

elseif(empty($municipios) ){
		header("Location: registroempresa.php?w=1");
}

elseif(empty($parroquia) ){
		header("Location: registroempresa.php?y=1");
}

elseif(empty($zona) ){
		header("Location: registroempresa.php?c=1");
}

elseif(!is_numeric($telf_emp) || strlen($telf_emp)<11 || strlen($telf_emp)>12){
		header("Location: registroempresa.php?h=1");
}

elseif(empty($tutorindustrial) ){
		header("Location: registroempresa.php?k=1");
}

elseif(empty($area) ){
		header("Location: registroempresa.php?l=1");
}
elseif(empty($tipoempresa) ){
		header("Location: registroempresa.php?m=1");
}
elseif(empty($vacantes) || !is_numeric($vacantes) || ($vacantes <= 0) ){
		header("Location: registroempresa.php?i=1");
}
						
	/*$sql_insertarArea = "INSERT INTO empresas_area (codEmp,codPer) VALUES ('$area')";
	$result_insertArea=mysql_query($sql_insertarArea);*/


		if ($tutorindustrial !="" ) {
			$sql_insertarTutor= "INSERT INTO tutorindustrial (nombre) VALUES ('$tutorindustrial')";
			$result_insertTutor=mysql_query($sql_insertarTutor);
		}

		$sql_insertar="INSERT INTO empresas (nom_emp,direc_emp,cod_estado,cod_municipio,cod_parroquia,zona,telf_emp,tipoempresa,vacantes) 
		VALUES ('$nom_emp','$direc_emp','$estados','$municipios','$parroquia','$zona','$telf_emp','$tipoempresa','$vacantes')";

		$result_insert=mysql_query($sql_insertar);
		if($result_insert){
			$Success=True;
			$Error=false;
            $msgSuccess="La Empresa fue agregada satisfactoriamente.";
		}
		else{
			$Success=false;
			$Error=true;
			$msgError="Los datos de la empresa no fueron agregados.";
		}

		$buscarmaxcodEmp="SELECT MAX(codEmp) as codEmp FROM empresas";
		$maxcodEmp = mysql_query($buscarmaxcodEmp);
		$resultadomaxcodemp = mysql_fetch_assoc($maxcodEmp);

		$sql_buscarmax = "SELECT MAX(codTutor) as codTutor FROM tutorindustrial";
		$resultadomax = mysql_query($sql_buscarmax);
		$resultadomaxcodtutor = mysql_fetch_assoc($resultadomax);	

		$sql_codTutor="INSERT INTO empresas_tutor (codEmp, codTutor) VALUES ('".$resultadomaxcodemp['codEmp']."','".$resultadomaxcodtutor['codTutor']."')";
		$result_insertcodTutor=mysql_query($sql_codTutor);
						
		/* $sql_buscarmaxarea = "SELECT MAX(codPer) as codPer FROM empresas_area ";
		$resultadomaxarea = mysql_query($sql_buscarmaxarea);
		$resultadomaxcodarea = mysql_fetch_assoc($resultadomaxarea);	*/

		$sql_codArea="INSERT INTO empresas_area(codEmp, codPer) VALUES ('".$resultadomaxcodemp['codEmp']."','$area')";	
		$result_insertcodArea=mysql_query($sql_codArea);
}

include('lib/header.php');

?>

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
<h2>Registro de empresas</h2>
<form name="registro" action="registroempresa.php" method="post">
		<table>
			<?php 
                if($Success==true && isset($Success)){ ?>
                <tr>
                  <td colspan="2">
                    <div class="success"><?php echo $msgSuccess ?></div>
                  </td>
                </tr> 
            <?php } ?>
            <?php 
                if($Error==true && isset($Error)){ ?>
                <tr>
                  <td colspan="2">
                    <div class="warning"><?php echo $msgError ?></div>
                  </td>
                </tr> 
            <?php } ?>

			<tr>
		   		<td>Nombre</td>
				<td><input type="text" name="nom_emp" value="" placeholder="Nombre de la Empresa" title="Se necesita un nombre."></td>
			</tr>
			<tr>
				<td>Direcci&oacute;n</td>
				<td> <input type="text" name="direc_emp" size="50" value="" placeholder="Direccion Completa" title="Coloque una direccion" required> </td>
			</tr>
			<tr>
				<td>Estado</td>
					<td><select name="cod_estado" id="cod_estado" title="Aun no ha seleccionado un estado" >
						<option value ="">Seleccione un Estado</option>
						<?php while($fila = mysql_fetch_assoc($result_estados)): ?>
							<option value="<?php echo $fila['cod_estado']?>"><?php echo $fila['nombre_estado'] ?> </option>
						<?php endwhile ?>
					</td>
			</tr>
			<tr>
				<td>Municipio</td>
					<td id="nom_municipio">
					<select name="nombre_municipio" id="nombre_municipio" title="Aun no ha seleccionado un municipio" >
						<option value="">Seleccione...</option>
					</select></td>
			</tr>
			<tr>
				<td>Parroquia</td>
					<td id="nom_parroquia"><select name="nombre_parroquia" id="nombre_parroquia"  title="Aun no ha seleccionado una parroquia" >
						<option value="">Seleccione...</option>
					</select></td>
			</tr>
			<tr><td>Zona</td>
				<td> 
					<select name="zona" required>
						<option value ="">Seleccione una Zona </option>
						<?php while($fila = mysql_fetch_assoc($result_direc)): ?>
							<option value="<?php echo $fila['codReg']?>"><?php echo $fila['region'] ?> </option>
						<?php endwhile ?>
						
					</select>
				</td>
			</tr>	
			<tr>
				<td>Telefono</td>
				<td><input type="text" id="telf_emp "name="telf_emp" value="" placeholder="Ej:02433456543" size="11"  ></td>
			</tr>
			<tr>
				<td>Tutor Industrial</td>
				<td><input type="text" id="tutorindustrial "name="tutorindustrial" value="" placeholder="Nombre del Tutor Academico" >

					<!-- <select name="tutorindustrial" title="Por favor Seleccione un tutor" required>
						<option value ="">Seleccione un Tutor</option>
						<?php while($fila = mysql_fetch_assoc($tutores)): ?>
							<option value="<?php echo $fila['codTutor']?>"><?php echo $fila['nombre'] ?> </option>
						<?php endwhile ?>
				</select>--></td>
			</tr>
			<tr>
				<td>Area</td>			
				<td>
					<select name="area" title="Se necesita un area." >
						<option value ="">Seleccione un area</option>
						<?php while($fila = mysql_fetch_assoc($areas)): ?>
							<option value="<?php echo $fila['codPer']?>"><?php echo $fila['perfil'] ?> </option>
						<?php endwhile ?>
				</select> </td>
			</tr>
            <tr>
				<td>Tipo de Empresa</td>
				<td><select name="tipoempresa" title="No ha seleccionado un tipo." >
					<option value="">Seleccione un tipo</option>
					<option value="Privada">Privada</option>
					<option value="Publica">Publica</option></select></td>
			</tr>
			<tr>
				<td>Vacantes</td>
				<td><input type="text" name="vacantes" value=""  placeholder="# de Puestos disponibles"  title="No ha introducido los puestos disponibles"></td>
			</tr>

		</table>
		<input type="submit" name="validar" value="Guardar"> <a href="listempresa.php">Ir al Listado</a>
</form>
<tr><div id="map_canvas" style="height:400px;width:600px"></div></tr>
</div>	
<?php include('../lib/footer.php'); ?>