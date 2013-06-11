<?php 
include('../lib/session.php');
include('../lib/conexion.php');

	$sqlBuscar = "SELECT codEmp,nom_emp,direc_emp,cod_estado,cod_municipio,cod_parroquia,zona,telf_emp,tipoempresa,vacantes FROM empresas ORDER BY codEmp ";
	//ejecuto la consulta
	$resultado = mysql_query($sqlBuscar);
	echo mysql_error();
	//verifico si hay registros
	$cant = mysql_num_rows($resultado);


	function mostrarEstado($cod_estado)
		{
			if($cod_estado == ""){
				return "Esta empresa aun no tiene un Estado Asignado.";
			}
			include('../lib/conexion.php');

			$sqlestados = "SELECT nombre_estado FROM estados WHERE cod_estado = $cod_estado";
			//Ejecutar la consulta
			$estados = mysql_fetch_array(mysql_query($sqlestados));
			return $estados['nombre_estado'];
		}

		function mostrarMunicipio($cod_municipio)
		{
			if($cod_municipio == ""){
				return "Esta empresa aun no tiene un Municipio Asignado.";
			}
			include('../lib/conexion.php');

			$sqlmunicipio = "SELECT nombre_municipio FROM municipios WHERE cod_municipio = $cod_municipio";
			//Ejecutar la consulta
			$municipios = mysql_fetch_array(mysql_query($sqlmunicipio));
			return $municipios['nombre_municipio'];
		}

		function mostrarParroquia($cod_parroquia)
		{
			if($cod_parroquia == ""){
				return "Esta empresa aun no tiene una Parroquia Asignada.";
			}
			include('../lib/conexion.php');

			$sqlparroquia = "SELECT nombre_parroquia FROM parroquias WHERE cod_parroquia = $cod_parroquia";
			//Ejecutar la consulta
			$parroquia = mysql_fetch_array(mysql_query($sqlparroquia));
			return $parroquia['nombre_parroquia'];
		}
		

	function mostrarArea($codEmp)
	{
			include('../lib/conexion.php');

		$sqlareas = "SELECT codPer FROM empresas_area WHERE codEmp = $codEmp";

		$idarea = mysql_fetch_array(mysql_query($sqlareas));

			if(!$idarea){
					return 'Esta empresa no cuenta con un area asignada.';
						}

		$sqlareas = "SELECT perfil FROM perfiles WHERE codPer = ".$idarea['codPer'];

			if(!$areas = mysql_fetch_array(mysql_query($sqlareas))){
					return 'Esta empresa no cuenta con un area asignada.';
				}
				return $areas['perfil'];
	}
		

		function mostrarZona($codReg)
		{
			if($codReg == ""){
				return "Esta empresa aun no tiene Zona Asignada.";
			}
			include('../lib/conexion.php');

			$sqlDireccion = "SELECT region FROM regiones WHERE codReg = $codReg";
			//Ejecutar la consulta
			$regiones = mysql_fetch_array(mysql_query($sqlDireccion));
			return $regiones['region'];
		}

		function mostrarTutor($codEmp)
		{
				include('../lib/conexion.php');
				
				$sqltutor = "SELECT codTutor FROM empresas_tutor WHERE codEmp = $codEmp";

				$idtutor = mysql_fetch_array(mysql_query($sqltutor));

				if(!$idtutor){
					return 'Esta empresa no cuenta con un tutor.';
				}
			
				$sqltutor = "SELECT nombre FROM tutorindustrial WHERE codTutor = ".$idtutor['codTutor'];

				if(!$tutor = mysql_fetch_array(mysql_query($sqltutor))){
					return 'Esta empresa no cuenta con un tutor.';
				}
				return $tutor['nombre'];
		}
	
include('lib/header.php');?>

<style type="text/css">
.marco {
	margin:auto 25px 25px 100px; /* Centrado horizontal */
}
.cuerpo {
    padding:0px 0px 0;
    height: 1500px;
    width: 1299px;
}
    </style>

<script src="js/jquery.dataTables.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.css" />

<style type="text/css">
            @import "css/demo_table_jui.css";
            @import "css/themes/smoothness/jquery-ui-1.8.4.custom.css";
        </style>
        
        <style>
            *{
                font-family: "Times New Roman";
            }
        </style>
        <script type="text/javascript" >
            $(document).ready(function(){
              $('#datatable').dataTable({
                   "sPaginationType":"full_numbers",
                    "aaSorting":[[0, "asc"]],
                    /*"sScrollY": "350px",*/
                    "bJQueryUI":true

                });
   new FixedHeader(document.getElementById('datatable'));
            })

function confirmDel(url){
//var agree = confirm("¿Realmente desea eliminarlo?");
if(confirm(String.fromCharCode(191)+"Desea realmente eliminar la empresa seleccionado?"))
	window.location.href = url;
else
	return false ;
}
</script>

<h2 style="text-align: center;">Listado de Empresas en el Sistema</h2>
<form align="center" style="width:90%;"> 
	<table id ="datatable" class="display">

	<thead>
  <tr>
    <th>Numero</th>
    <th>Nombre de la Empresa</th>
    <th>Direccion</th>
    <th>Estado</th>
    <th>Municipio</th>
    <th>Parroquia</th>
    <th>Zona</th>
    <th>Telefono</th>
    <th>Tutor Industrial</th> 
    <th>Area</th>
    <th>Tipo de Empresa</th>
    <th>Vacantes</th>
    <th>Opciones</th>
  </tr>
</thead>
<tbody>
  <?php if ($cant>0) : ?>
	<?php while($fila = mysql_fetch_assoc($resultado)) : ?>
		<tr>
			<td><?php echo $fila['codEmp']; ?></td>
			<td><?php echo $fila['nom_emp']; ?></td>
			<td><?php echo $fila['direc_emp']; ?></td>
			<td><?php echo mostrarEstado($fila['cod_estado']); ?></td>
			<td><?php echo mostrarMunicipio($fila['cod_municipio']); ?></td>
			<td><?php echo mostrarParroquia($fila['cod_parroquia']); ?></td>
			<td><?php echo mostrarZona($fila['zona']); ?></td>
			<td><?php echo $fila['telf_emp']; ?></td>
			<td><?php echo mostrarTutor($fila['codEmp']); ?> </br></td>
			<td><?php echo mostrarArea($fila['codEmp']); ?></td>
			<td><?php echo $fila['tipoempresa']; ?></td>
			<td><?php echo $fila['vacantes']; ?></td>
			<td><a href="registroempresa.php">Agregar</a> |<a href="deleteempresa.php?codEmp=<?php echo $fila['codEmp'];?>" onclick="if(confirmDel() == false){return false;}">Eliminar</a> | <a href="actualizarempresa.php?codEmp=<?php echo $fila['codEmp']; ?>">Editar</a></td>
		</tr>
	<?php endwhile; ?>
		<? else: ?>
			<tr><td colspan="4">No se encontraron registros</td></tr>
		<?php endif; ?>
	</tbody>
	</table>


</form>

<div class="pie">
            <hr/>
            <strong>Una Universidad para la Creatividad</strong><br/>
            <strong>Todos los Derechos Reservados Universidad Bicentenaria de Aragua 2013</strong><br />
            Av. Intercomunal Santiago Mari&ntilde;o c/c Av. Universidad, Sector la Providencia, San Joaqu&iacute;n de Turmero - Estado Aragua - Venezuela<br />
            <strong>Sistema realizado por los Estudiantes de UBA Acad&eacute;mico | 2013</strong>
        </div>
       </div>
        </body>
</html>