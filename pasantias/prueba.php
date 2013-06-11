<?php
include('procesos/conexion.php');


$sqlBuscar = "SELECT *,(SELECT NOM_APE FROM estudiantes WHERE cedula=listaalumnos.cedula) as NOM_APE ,(SELECT nom_emp FROM empresas WHERE codEmp=listaalumnos.codEmp) as nom_emp, (SELECT codPer FROM empresas_area WHERE codEmp= listaalumnos.codEmp) as codPer, (SELECT codTutor FROM empresas_tutor WHERE codEmp= listaalumnos.codEmp) as codTutor FROM listaalumnos ";
    //ejecuto la consulta
$resultado = mysql_query($sqlBuscar);

$sqlareas = "SELECT codPer FROM perfiles";
$resultadoareas= mysql_query($sqlareas);
$cant= mysql_num_rows($resultadoareas);

 function mostrarArea($codPer){
        if($codPer == ""){
            return "Esta empresa aun no tiene area.";
        }
        include('procesos/conexion.php');

        $sqlAreas = "SELECT perfil FROM perfiles WHERE codPer = $codPer";
        //Ejecutar la consulta
        $areas = mysql_fetch_array(mysql_query($sqlAreas));
        return $areas['perfil'];
        }


while ($fila=mysql_fetch_assoc($resultado))
{
	for ($i=1;$i<=$cant;$i++)
	{
		if ($i == $fila['codPer'])
		{
			${'area'.$i}++;
			
		}
	}
}
for ($i=1;$i<=$cant;$i++)
	{
		echo ${'area'.$i};
	}

?>