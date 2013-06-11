<?php
	include('procesos/conexion.php');


if(isset($_POST['validar']))
					{

					$regiones=$_POST['region'];
					$sql_insertar="INSERT INTO regiones (region) VALUES ('$regiones')";
											
						$result_insert = mysql_query($sql_insertar);
								if($result_insert)
										{
									echo 'Su direccion ha sido guardada.';
										}
										else{
											echo mysql_error();
											}
					}
?>
<form name="registro" action="" method="post">
<table><td>
<input type="text" name="region" value="" placeholder="Direccion de la Empresa" title="Aun no ha escrito la direccion." required> 
<input type="submit" name="validar" value="Guardar"></td>
	</form>
</table>