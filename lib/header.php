<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="google-site-verification" content="6w9FrEF8LRQPaIIOjQE2Fb1erDJQhmZuKgZJ2u0Jekg" />
		<title>Universidad Bicentenaria de Aragua date</title>
		<link src="css/estilo.css" type="text/css"/>
		<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" /> 
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="modernizr-latest.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$( "#fechanac,#fechaingreso" ).datepicker({
      				changeMonth: true,
      				changeYear: true,
      				dateFormat: "yy-mm-dd"
    			});
    			$("#fechanac,#fechaingreso").keyup(function (){
    				var vacio = '';
    				$("#fechanac").val(vacio);
    			});
				$("select").change(function () {
	    			if($(this).val() == "") $(this).addClass("empty");
	    			else $(this).removeClass("empty")
					});
				$("select").change();

  				$("#Coord_Catedra").click(function(){
    				$(".menucoordinadorcat").toggle("slide",250);
    			return false;
  				});
				$("#Coord_Planificacion").click(function(){
    				$(".menucoordinadorpla").toggle("slide",250);
    			return false;
  				});
  				$("#Coord_Pasantia").click(function(){
    				$(".menucoordinadorpas").toggle("slide",250);
    			return false;
  				});
  				$("#Coord_CentroInv").click(function(){
    				$(".menucoordinadorcinv").toggle("slide",250);
    			return false;
  				});
  				$("#Coord_GesAc").click(function(){
    				$(".menucoordinadorgesac").toggle("slide",250);
    			return false;
  				});

  				$("#ced_prof").blur(function(){
		            var cedula = $("#ced_prof").val();
		            var busqueda = "nombres";
		                $.ajax({
		                    type: "GET",
		                    url: "lib/procesamiento.php?dato="+cedula+"&busqueda="+busqueda+"&cond=cedula&tabla=profesores",
		                    cache: false,
		                    success: function(html)
		                    {
		                        $("#nombres").val(html);

		                            var cedula = $("#ced_prof").val();
		                            var busqueda = "apellidos";
		                                $.ajax({
		                                    type: "GET",
		                                    url: "lib/procesamiento.php?dato="+cedula+"&busqueda="+busqueda+"&cond=cedula&tabla=profesores",
		                                    cache: false,
		                                    success: function(html)
		                                    {
		                                        $("#apellidos").val(html);
		                                    } 
		                                });
		                    } 
		                });
		        });

  				$("#cod_cat").change(function(){

		            var catedra = $("#cod_cat").val();
		            var busqueda = "cod_mat";
		            $.ajax({
		                type: "GET",
		                url: "lib/procesamiento.php?dato="+catedra+"&busqueda="+busqueda+"&cond=cod_catedra&tabla=h_catemate&multiple=cod_mat",
		                cache: false,
		                success: function(html)
		                {
		                   $("#cod_mat").html(html);
		                } 
		            });

        		 });


			});
			
		</script>
</head>

<body>
	<div class="marco">
		<div class="cabecera">
			<div class="columna_derecha_cabecera">
			</div>
			<div class="columna_izquierda_cabecera">
			</div>
			<div class="columna_central_cabecera">
				<div id="link_logo"><a href="menu.php"><img src="images/logo.jpg" alt="UBA"/></a></div>
			</div>
		</div>
		<div class="cuerpo">
			<div class="columna_derecha">
				<?php
					if(isset($coord_cat) && $coord_cat>=1)
						{?>
						<div class="favorito2 menucoordinadorcat" style="display: none"><table><tr><td><div class="favorito" id="AsignarProfesor"></div></td><td><a href="asignarprofesor.php">Asignaci&oacute;n de Profesores</a></td></tr></table></div>
    					<div class="favorito2 menucoordinadorcat" style="display: none"><table><tr><td><div class="favorito" id="AgregarProfesor"></div></td><td><a href="agregarprofesor.php">Agregar Profesor</a></td></tr></table></div>
    					<div class="favorito2 menucoordinadorcat" style="display: none"><table><tr><td><div class="favorito" id="BuscarProfesor"></div></td><td><a href="buscarprofesor.php">Buscar Profesor</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorcat" style="display: none"><table><tr><td><div class="favorito" id="ReporteProfesoresAsignados"></div></td><td><a href="reportes.php">Reportes de Profesores Asignados</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorcat" style="display: none"><table><tr><td><div class="favorito" id="ConsultaEncuestaEstudiantes"></div></td><td><a href="planificacion/seleccionencuestaestudiantes.php">Consulta Encuesta Estudiantes</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorcat" style="display: none"><table><tr><td><div class="favorito" id="ConsultaEvaluacionDocente"></div></td><td><a href="planificacion/seleccionevaluaciondocente.php">Consulta Evaluaci&oacute;n Docente</a></td></tr></table></div>						
				<?php }?>
				<?php
					if(isset($coord_pla) && $coord_pla==1)
						{?>
						<div class="favorito2 menucoordinadorpla" style="display: none"><table><tr><td><div class="favorito" id="EncuestaEstudiantes"></div></td><td><a href="planificacion/formularioencuestaestudiantes.php">Agregar Encuesta Estudiantes</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpla" style="display: none"><table><tr><td><div class="favorito" id="EvaluacionDocente"></div></td><td><a href="planificacion/formularioevaluaciondocente.php">Agregar Evaluaci&oacute;n Docente</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpla" style="display: none"><table><tr><td><div class="favorito" id="ConsultaEncuestaEstudiantes"></div></td><td><a href="planificacion/seleccionencuestaestudiantes.php">Consultar Encuesta Estudiantes</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpla" style="display: none"><table><tr><td><div class="favorito" id="ConsultaEvaluacionDocente"></div></td><td><a href="planificacion/seleccionevaluaciondocente.php">Consultar Evaluaci&oacute;n Docente</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpla" style="display: none"><table><tr><td><div class="favorito" id="GraficasPlanificacion"></div></td><td><a href="planificacion/graficasplanificacion.php">Gr&aacute;ficas</a></td></tr></table></div>
						<?php }?>
				<?php
					if(isset($coord_pas) && $coord_pas==1)
						{?>
						<div class="favorito2 menucoordinadorpas" style="display: none"><table><tr><td><div class="favorito" id="RegistroEmpresa"></div></td><td><a href="pasantias/registroempresa.php">Agregar Empresa</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpas" style="display: none"><table><tr><td><div class="favorito" id="ListadoEmpresa"></div></td><td><a href="pasantias/listempresa.php">Ver Listado de Empresa</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpas" style="display: none"><table><tr><td><div class="favorito" id="SolicitudPasantias"></div></td><td><a href="pasantias/solicitudpasantias.php">Agregar Solicitud de Alumno</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpas" style="display: none"><table><tr><td><div class="favorito" id="ListaAlumnos"></div></td><td><a href="pasantias/listaalumnos.php">Ver Listado de Alumno</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpas" style="display: none"><table><tr><td><div class="favorito" id="FormularioActaEvaluacion"></div></td><td><a href="pasantias/formularioactaevaluacion.php">Acta de Evaluaci&oacute;n del Pasante</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorpas" style="display: none"><table><tr><td><div class="favorito" id="Reportes"></div></td><td><a href="pasantias/seleccionarlapso.php">Informe de Gesti&oacute;n</a></td></tr></table></div>
						<?php }?>
				<?php
					if(isset($coord_inv) && $coord_inv==1)
						{?>
						<div class="favorito2 menucoordinadorcinv" style="display: none"><table><tr><td><div class="favorito" id="ListaAlumnoscinv"></div></td><td><a href="centrodeinvestigacion/index.php">Alumnos</td></tr></table></a></div>
						<div class="favorito2 menucoordinadorcinv" style="display: none"><table><tr><td><div class="favorito" id="AgregarProfesor"></div></td><td><a href="centrodeinvestigacion/agregarprofesor.php">Agregar Profesor</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorcinv" style="display: none"><table><tr><td><div class="favorito" id="ListadoProfesores"></div></td><td><a href="centrodeinvestigacion/profesores.php">Profesores</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorcinv" style="display: none"><table><tr><td><div class="favorito" id="Reportescinv"></div></td><td><a href="centrodeinvestigacion/reportespersonalizados.php">Reportes Personalizados</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorcinv" style="display: none"><table><tr><td><div class="favorito" id="Reportes"></div></td><td><a href="centrodeinvestigacion/reportesdinamicos.php">Reportes Din&aacute;micos</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorcinv" style="display: none"><table><tr><td><div class="favorito" id="graficoscinv"></div></td><td><a href="centrodeinvestigacion/graficos.php">Gr&aacute;ficos</a></td></tr></table></div>
						<div class="favorito2 menucoordinadorcinv" style="display: none"><table><tr><td><div class="favorito" id="Entregas"></div></td><td><a href="centrodeinvestigacion/entregas.php">Entregas</a></td></tr></table></div>
						<?php }?>
				<?php
					if(isset($coord_scom) && $coord_scom==1)
						{?>
					
						<?php }?>
				<?php
					if(isset($coord_gesac) && $coord_gesac==1)
						{?>
						<div class="favorito2 menucoordinadorgesac" style="display: none"><table><tr><td><div class="favorito" id="ReporteProfesoresAsignados"></div></td><td><a href="reportes.php">Reportes de Profesores Asignados</a></td></tr></table></div>
						<?php }?>					
			</div>
			<div class="columna_izquierda">
					<div class="favorito2"><table><tr><td><div class="favorito" id="CargaAcademica"></div></td><td><a href="cargaacademicaprofesor.php">Carga Acad&eacute;mica</a></td></tr></table></div>
    				<div class="favorito2"><table><tr><td><div class="favorito" id="HorarioProfesor"></div></td><td><a href="horario.php">Horario Materias</a></td></tr></table></div>
    				<?php
    				if(isset($coord_cat) && $coord_cat>=1)
	    			{
	    				echo '<div class="favorito2"><table><tr><td><div class="favorito" id="Coordinadores"></div></td><td><a href="#" id="Coord_Catedra">Coordinadores</a></td></tr></table></div>';
	    			}
	    			if(isset($coord_pla) && $coord_pla==1)
	    			{
	    				echo '<div class="favorito2"><table><tr><td><div class="favorito" id="Planificacion"></div></td><td><a href="#" id="Coord_Planificacion">Planificaci&oacute;n</a></td></tr></table></div>';
	    			}
	    			if(isset($coord_pas) && $coord_pas==1)
	    			{
	    				echo '<div class="favorito2"><table><tr><td><div class="favorito" id="Pasantia"></div></td><td><a href="#" id="Coord_Pasantia">Pasant&iacute;a</a></td></tr></table></div>';
	    			}
	    			if(isset($coord_inv) && $coord_inv==1)
	    			{
	    				echo '<div class="favorito2"><table><tr><td><div class="favorito" id="ListadoEmpresa"></div></td><td><a href="#" id="Coord_CentroInv">Centro de Investigaci&oacute;n</a></td></tr></table></div>';
	    			}
	    			if(isset($coord_gesac) && $coord_gesac==1)
	    			{
	    				echo '<div class="favorito2"><table><tr><td><div class="favorito" id="gestionacademica"></div></td><td><a href="#" id="Coord_GesAc">Gesti&oacute;n Acad&eacute;mica</a></td></tr></table></div>';
	    			}
	    			if(isset($coord_scom) && $coord_scom==1)
	    			{
	    			}  
    				?>
    				<div class="favorito2"><table><tr><td><div class="favorito" id="Clave"></div></td><td><a href="clave.php">Cambiar Password</a></td></tr></table></div>
					<div class="favorito2"><table><tr><td><div class="favorito" id="Salir"></div></td><td><a href="salir.php">Cerrar Sesi&oacute;n</a></td></tr></table></div>			
			</div>
