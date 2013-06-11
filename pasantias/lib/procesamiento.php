<?php
	include('../../lib/conexion.php');

	function nombreEscuela($id){
		include('../../lib/conexion.php');

		$query = "SELECT Facultad FROM escuelas WHERE cod_esc = '$id'";
		$rs = mysql_fetch_array(mysql_query($query));
		return $rs["Facultad"];
	}

	function nombreArea($id){
		include('../../lib/conexion.php');

		$query = "SELECT perfil FROM perfiles WHERE codPer = '$id'";
		$rs = mysql_fetch_array(mysql_query($query));
		return $rs["perfil"];
	}

	function nombreEmpresa($id){
		include('../../lib/conexion.php');

		$query = "SELECT nom_emp FROM empresas WHERE codEmp = '$id'";
		$rs = mysql_fetch_array(mysql_query($query));
		return $rs["nom_emp"];
	}

	$dato = $_GET['dato'];
	$tabla = $_GET['tabla'];
	$cond = $_GET['cond'];
	$busqueda = $_GET['busqueda'];
	$caracter   = ',';

	$pos = strpos($busqueda, $caracter);

	$query = "SELECT $busqueda FROM $tabla WHERE $cond = '$dato'";

	$resultado = mysql_query($query) or die(mysql_error());
	if($resultado){
		if(isset($_GET['multiple'])){ ?>
                    <option value ="">Seleccionar...</option>
                    <?php  while($row = mysql_fetch_assoc($resultado)): ?>

    	                <?php if ($pos != false) : ?>
    
							<?php $partes = explode($caracter, $busqueda); ?>

	                    	<option value="<?php echo $row[$partes[0]]?>"><?php echo utf8_encode($row[$partes[1]]) ?> </option>
	                    
	                    <?php else: ?>

	                    	<?php if($busqueda == 'codPer'): ?>

	                    		<option value="<?php echo $row[$busqueda]?>"><?php echo utf8_encode(nombreArea($row[$busqueda])); ?></option>

	                    	<?php else: ?>

	                    	<option value="<?php echo $row[$busqueda]?>"><?php echo utf8_encode($row[$busqueda]) ?> </option>
                    	
                    	 <?php endif; ?>
                    	
                    	<?php endif; ?>

                    <?php endwhile ?>
		<?php
		}else{
			if ($busqueda == 'COD_ESC') {
				$rs = mysql_fetch_array(mysql_query($query));
				 echo utf8_encode(nombreEscuela($rs[$busqueda]));
			}
			elseif ($busqueda == 'codEmp') {
				$rs = mysql_fetch_array(mysql_query($query));
				 echo utf8_encode(nombreEmpresa($rs[$busqueda]));		
			}
			else{
			$row = mysql_fetch_array($resultado);
			echo $row[$busqueda];	
			}
			
		}
	}