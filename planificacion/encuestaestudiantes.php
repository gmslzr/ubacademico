<?php
include('../lib/session.php');

include('../lib/conexion.php');
$Success=false;
$Error=true;
$inicio=0;
$cedula_doc=$_POST['cedula_doc'];
$cod_esc=$_POST['escuela'];
$cod_mat=$_POST['materia'];
$sec_mat=$_POST['seccion'];
$fecha=$_POST['fecha'];
$inscritos=$_POST['inscritos'];
$encuestados=$_POST['encuestados'];
$date=explode("-", $fecha);
$materia=explode("M", $cod_mat);
$fechaactual=date("Ymd");
$fecha_sel=explode("-", $fecha);
$fecha_comp=$fecha_sel[0].$fecha_sel[1].$fecha_sel[2];

if(isset($_POST['validar']) && $_POST['validar']='Siguiente' )
{ 
    $sqlbuscar="SELECT * FROM encuesta_estudiantes WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso' AND fecha='$fecha' AND n_inscritos='$inscritos' AND n_encuestados='$encuestados'";
    $resultbuscar=mysql_query($sqlbuscar);
    $fila=mysql_fetch_assoc($resultbuscar);
    $cant=mysql_num_rows($resultbuscar);
    $e_agregadas=$fila['encuestas_agregadas'];
    $encuestados1=$fila['n_encuestados'];
    if(($cant!==0) && ($e_agregadas==$encuestados1))
    {
        header ("Location: formularioencuestaestudiantes.php?d=1");
    }
}
elseif(isset($_POST['borrar']) && $_POST['borrar']='Borrar' )
{
    if ($materia[0]=='SCO')
    {
        if(!empty($_POST['encuestas_agr']))
        {
            $sql_borrar = "DELETE FROM encuesta_estudiantes_sc WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
            $res_borrar=mysql_query($sql_borrar);    
            header ("Location: formularioencuestaestudiantes.php?e=1");
        }
        else
        {
            header ("Location: formularioencuestaestudiantes.php?l=1");
        }
    }
    elseif ($cod_mat=='AAAAAAAAAAA')
    { 
        if(!empty($_POST['encuestas_agr']))
        {
            $sql_borrar = "DELETE FROM encuesta_estudiantes_tp WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
            $res_borrar=mysql_query($sql_borrar);    
            header ("Location: formularioencuestaestudiantes.php?e=1");
        }        
        else
        {
            header ("Location: formularioencuestaestudiantes.php?l=1");
        }
    }
    else
    { 
        if(!empty($_POST['encuestas_agr']))
        {
            $sql_borrar = "DELETE FROM encuesta_estudiantes WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
            $res_borrar=mysql_query($sql_borrar);    
            header ("Location: formularioencuestaestudiantes.php?e=1");
        }
                else
        {
            header ("Location: formularioencuestaestudiantes.php?l=1");
        }
    }
}

if (isset($_POST['encuestas_agregadas'])) 
{
	$encuestas_agregadas=$_POST['encuestas_agregadas'];
}

$sql_cedula="SELECT * FROM profesores WHERE cedula='$cedula_doc'";
$res_cedula=mysql_query($sql_cedula);
$fila_cedula=mysql_fetch_assoc($res_cedula);

$sql_materia="SELECT * FROM materias WHERE cod_mat='$cod_mat'";
$res_materia=mysql_query($sql_materia);
$fila_materia=mysql_fetch_assoc($res_materia);

$sql_escuela="SELECT * FROM escuelas WHERE cod_esc='$cod_esc'";
$res_escuela=mysql_query($sql_escuela);
$fila_escuela=mysql_fetch_assoc($res_escuela);

if(isset($_POST['agregar_sc']))
{       
	if($encuestas_agregadas==1)
	{
            $Prom1=($_POST['ResA1'])/$encuestas_agregadas;
            $Prom2=($_POST['ResA2'])/$encuestas_agregadas;
            $Prom3=($_POST['ResA3'])/$encuestas_agregadas;
            $Prom4=($_POST['ResA4'])/$encuestas_agregadas;
            $Prom5=($_POST['ResA5'])/$encuestas_agregadas;
            $Prom6=($_POST['ResA6'])/$encuestas_agregadas;
            $Prom7=($_POST['ResA7'])/$encuestas_agregadas;
            $Prom8=($_POST['ResA8'])/$encuestas_agregadas;
            $Prom9=($_POST['ResA9'])/$encuestas_agregadas;
            $Prom10=($_POST['ResA10'])/$encuestas_agregadas;
            $Prom11=($_POST['ResA11'])/$encuestas_agregadas;
            $Prom12=($_POST['ResA12'])/$encuestas_agregadas;
            $Prom13=($_POST['ResA13'])/$encuestas_agregadas;
            $Prom14=($_POST['ResA14'])/$encuestas_agregadas;
            $Prom15=($_POST['ResA15'])/$encuestas_agregadas;
            $obs_es=$_POST['obs_es'];
            $Promedio=(($Prom1+$Prom2+$Prom3+$Prom4+$Prom5+$Prom6+$Prom7+$Prom8+$Prom9+$Prom10+$Prom11+$Prom12+$Prom13+$Prom14+$Prom15)/"15");
            if(!empty($obs_es)){
              $sql_es="INSERT INTO observaciones_planif (id_tipo,cedula,cod_esc,cod_mat,sec_mat,lapso,observacion) VALUES ('1',$cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$obs_es')";
              $res_es=mysql_query($sql_es);
            }
            $sql_insertar="INSERT INTO encuesta_estudiantes_sc (cedula,cod_esc,cod_mat,sec_mat,lapso,fecha,n_inscritos,n_encuestados,encuestas_agregadas,prom1,prom2,prom3,prom4,prom5,prom6,prom7,prom8,prom9,prom10,prom11,prom12,prom13,prom14,prom15,prom_total) VALUES ($cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$fecha','$inscritos','$encuestados','$encuestas_agregadas','$Prom1','$Prom2','$Prom3','$Prom4','$Prom5','$Prom6','$Prom7','$Prom8','$Prom9','$Prom10','$Prom11','$Prom12','$Prom13','$Prom14','$Prom15','$Promedio')";
            $resultado=mysql_query($sql_insertar);
    }
    else
    {
	    $sqlbuscar="SELECT * FROM encuesta_estudiantes_sc WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso' AND fecha='$fecha' AND n_inscritos='$inscritos'";
	    $resultbuscar=mysql_query($sqlbuscar);
	    $fila_buscar=mysql_fetch_assoc($resultbuscar);

	    $Prom1=($_POST['ResA1']+($fila_buscar['prom1']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom2=($_POST['ResA2']+($fila_buscar['prom2']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom3=($_POST['ResA3']+($fila_buscar['prom3']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom4=($_POST['ResA4']+($fila_buscar['prom4']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom5=($_POST['ResA5']+($fila_buscar['prom5']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom6=($_POST['ResA6']+($fila_buscar['prom6']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom7=($_POST['ResA7']+($fila_buscar['prom7']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom8=($_POST['ResA8']+($fila_buscar['prom8']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom9=($_POST['ResA9']+($fila_buscar['prom9']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom10=($_POST['ResA10']+($fila_buscar['prom10']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom11=($_POST['ResA11']+($fila_buscar['prom11']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom12=($_POST['ResA12']+($fila_buscar['prom12']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom13=($_POST['ResA13']+($fila_buscar['prom13']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom14=($_POST['ResA14']+($fila_buscar['prom14']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $Prom15=($_POST['ResA15']+($fila_buscar['prom15']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
	    $obs_es=$_POST['obs_es'];
	    $Promedio=(($Prom1+$Prom2+$Prom3+$Prom4+$Prom5+$Prom6+$Prom7+$Prom8+$Prom9+$Prom10+$Prom11+$Prom12+$Prom13+$Prom14+$Prom15)/"15");
	    $sql_update="UPDATE encuesta_estudiantes_sc SET cedula=$cedula_doc,cod_esc=$cod_esc,cod_mat='$cod_mat',sec_mat='$sec_mat',lapso=$lapso,fecha='$fecha',n_inscritos='$inscritos',n_encuestados='$encuestados',encuestas_agregadas='$encuestas_agregadas',prom1='$Prom1',prom2='$Prom2',prom3='$Prom3',prom4='$Prom4',prom5='$Prom5',prom6='$Prom6',prom7='$Prom7',prom8='$Prom8',prom9='$Prom9',prom10='$Prom10',prom11='$Prom11',prom12='$Prom12',prom13='$Prom13',prom14='$Prom14',prom15='$Prom15',prom_total='$Promedio' WHERE  cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso' AND fecha='$fecha' AND n_inscritos='$inscritos'";
	    $resultupdate=mysql_query($sql_update);
	    if(!empty($obs_es))
        {
	        $sql_es="INSERT INTO observaciones_planif (id_tipo,cedula,cod_esc,cod_mat,sec_mat,lapso,observacion) VALUES ('1',$cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$obs_es')";
	        $res_es=mysql_query($sql_es);
	    }
	}
}

if(isset($_POST['agregar_tp']))
{       
    if($encuestas_agregadas==1)
    {
            $Prom1=($_POST['ResA1'])/$encuestas_agregadas;
            $Prom2=($_POST['ResA2'])/$encuestas_agregadas;
            $Prom3=($_POST['ResA3'])/$encuestas_agregadas;
            $Prom4=($_POST['ResA4'])/$encuestas_agregadas;
            $Prom5=($_POST['ResA5'])/$encuestas_agregadas;
            $Prom6=($_POST['ResA6'])/$encuestas_agregadas;
            $Prom7=($_POST['ResA7'])/$encuestas_agregadas;
            $Prom8=($_POST['ResA8'])/$encuestas_agregadas;
            $Prom9=($_POST['ResA9'])/$encuestas_agregadas;
            $Prom10=($_POST['ResA10'])/$encuestas_agregadas;
            $obs_es=$_POST['obs_es'];
            $Promedio=(($Prom1+$Prom2+$Prom3+$Prom4+$Prom5+$Prom6+$Prom7+$Prom8+$Prom9+$Prom10)/"10");
            if(!empty($obs_es)){
              $sql_es="INSERT INTO observaciones_planif (id_tipo,cedula,cod_esc,cod_mat,sec_mat,lapso,observacion) VALUES ('1',$cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$obs_es')";
              $res_es=mysql_query($sql_es);
            }
            $sql_insertar="INSERT INTO encuesta_estudiantes_tp (cedula,cod_esc,cod_mat,sec_mat,lapso,fecha,n_inscritos,n_encuestados,encuestas_agregadas,prom1,prom2,prom3,prom4,prom5,prom6,prom7,prom8,prom9,prom10,prom_total) VALUES ($cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$fecha','$inscritos','$encuestados','$encuestas_agregadas','$Prom1','$Prom2','$Prom3','$Prom4','$Prom5','$Prom6','$Prom7','$Prom8','$Prom9','$Prom10','$Promedio')";
            $resultado=mysql_query($sql_insertar);

    }
    else
    {
        $sqlbuscar="SELECT * FROM encuesta_estudiantes_tp WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso' AND fecha='$fecha' AND n_inscritos='$inscritos'";
        $resultbuscar=mysql_query($sqlbuscar);
        $fila_buscar=mysql_fetch_assoc($resultbuscar);

        $Prom1=($_POST['ResA1']+($fila_buscar['prom1']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom2=($_POST['ResA2']+($fila_buscar['prom2']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom3=($_POST['ResA3']+($fila_buscar['prom3']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom4=($_POST['ResA4']+($fila_buscar['prom4']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom5=($_POST['ResA5']+($fila_buscar['prom5']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom6=($_POST['ResA6']+($fila_buscar['prom6']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom7=($_POST['ResA7']+($fila_buscar['prom7']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom8=($_POST['ResA8']+($fila_buscar['prom8']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom9=($_POST['ResA9']+($fila_buscar['prom9']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom10=($_POST['ResA10']+($fila_buscar['prom10']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $obs_es=$_POST['obs_es'];
        $Promedio=(($Prom1+$Prom2+$Prom3+$Prom4+$Prom5+$Prom6+$Prom7+$Prom8+$Prom9+$Prom10)/"10");
        $sql_update="UPDATE encuesta_estudiantes_tp SET cedula=$cedula_doc,cod_esc=$cod_esc,cod_mat='$cod_mat',sec_mat='$sec_mat',lapso=$lapso,fecha='$fecha',n_inscritos='$inscritos',n_encuestados='$encuestados',encuestas_agregadas='$encuestas_agregadas',prom1='$Prom1',prom2='$Prom2',prom3='$Prom3',prom4='$Prom4',prom5='$Prom5',prom6='$Prom6',prom7='$Prom7',prom8='$Prom8',prom9='$Prom9',prom10='$Prom10',prom_total='$Promedio' WHERE  cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso' AND fecha='$fecha' AND n_inscritos='$inscritos'";
        $resultupdate=mysql_query($sql_update);
        if(!empty($obs_es))
        {
            $sql_es="INSERT INTO observaciones_planif (id_tipo,cedula,cod_esc,cod_mat,sec_mat,lapso,observacion) VALUES ('1',$cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$obs_es')";
            $res_es=mysql_query($sql_es);
        }
    }
}

if(isset($_POST['agregar']))
{       
    if($encuestas_agregadas==1)
    {
            $Prom1=($_POST['ResA1'])/$encuestas_agregadas;
            $Prom2=($_POST['ResA2'])/$encuestas_agregadas;
            $Prom3=($_POST['ResA3'])/$encuestas_agregadas;
            $Prom4=($_POST['ResA4'])/$encuestas_agregadas;
            $Prom5=($_POST['ResA5'])/$encuestas_agregadas;
            $Prom6=($_POST['ResA6'])/$encuestas_agregadas;
            $Prom7=($_POST['ResA7'])/$encuestas_agregadas;
            $Prom8=($_POST['ResA8'])/$encuestas_agregadas;
            $Prom9=($_POST['ResA9'])/$encuestas_agregadas;
            $Prom10=($_POST['ResA10'])/$encuestas_agregadas;
            $Prom11=($_POST['ResA11'])/$encuestas_agregadas;
            $Prom12=($_POST['ResA12'])/$encuestas_agregadas;
            $Prom13=($_POST['ResA13'])/$encuestas_agregadas;
            $Prom14=($_POST['ResA14'])/$encuestas_agregadas;
            $Prom15=($_POST['ResA15'])/$encuestas_agregadas;
            $Prom16=($_POST['ResA16'])/$encuestas_agregadas;
            $Prom17=($_POST['ResA17'])/$encuestas_agregadas;
            $Prom18=($_POST['ResA18'])/$encuestas_agregadas;
            $Prom19=($_POST['ResA19'])/$encuestas_agregadas;
            $Prom20=($_POST['ResA20'])/$encuestas_agregadas;
            $obs_es=$_POST['obs_es'];
            $Promedio=(($Prom1+$Prom2+$Prom3+$Prom4+$Prom5+$Prom6+$Prom7+$Prom8+$Prom9+$Prom10+$Prom11+$Prom12+$Prom13+$Prom14+$Prom15+$Prom16+$Prom17+$Prom18+$Prom19+$Prom20)/"20");
            if(!empty($obs_es)){
              $sql_es="INSERT INTO observaciones_planif (id_tipo,cedula,cod_esc,cod_mat,sec_mat,lapso,observacion) VALUES ('1',$cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$obs_es')";
              $res_es=mysql_query($sql_es);
            }
            $sql_insertar="INSERT INTO encuesta_estudiantes (cedula,cod_esc,cod_mat,sec_mat,lapso,fecha,n_inscritos,n_encuestados,encuestas_agregadas,prom1,prom2,prom3,prom4,prom5,prom6,prom7,prom8,prom9,prom10,prom11,prom12,prom13,prom14,prom15,prom16,prom17,prom18,prom19,prom20,prom_total) VALUES ($cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$fecha','$inscritos','$encuestados','$encuestas_agregadas','$Prom1','$Prom2','$Prom3','$Prom4','$Prom5','$Prom6','$Prom7','$Prom8','$Prom9','$Prom10','$Prom11','$Prom12','$Prom13','$Prom14','$Prom15','$Prom16','$Prom17','$Prom18','$Prom19','$Prom20','$Promedio')";
            $resultado=mysql_query($sql_insertar);
    }
    else
    {
        $sqlbuscar="SELECT * FROM encuesta_estudiantes WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso' AND fecha='$fecha' AND n_inscritos='$inscritos'";
        $resultbuscar=mysql_query($sqlbuscar);
        $fila_buscar=mysql_fetch_assoc($resultbuscar);

        $Prom1=($_POST['ResA1']+($fila_buscar['prom1']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom2=($_POST['ResA2']+($fila_buscar['prom2']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom3=($_POST['ResA3']+($fila_buscar['prom3']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom4=($_POST['ResA4']+($fila_buscar['prom4']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom5=($_POST['ResA5']+($fila_buscar['prom5']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom6=($_POST['ResA6']+($fila_buscar['prom6']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom7=($_POST['ResA7']+($fila_buscar['prom7']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom8=($_POST['ResA8']+($fila_buscar['prom8']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom9=($_POST['ResA9']+($fila_buscar['prom9']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom10=($_POST['ResA10']+($fila_buscar['prom10']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom11=($_POST['ResA11']+($fila_buscar['prom11']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom12=($_POST['ResA12']+($fila_buscar['prom12']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom13=($_POST['ResA13']+($fila_buscar['prom13']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom14=($_POST['ResA14']+($fila_buscar['prom14']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom15=($_POST['ResA15']+($fila_buscar['prom15']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom16=($_POST['ResA16']+($fila_buscar['prom16']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom17=($_POST['ResA17']+($fila_buscar['prom17']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom18=($_POST['ResA18']+($fila_buscar['prom18']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom19=($_POST['ResA19']+($fila_buscar['prom19']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $Prom20=($_POST['ResA20']+($fila_buscar['prom20']*(($encuestas_agregadas)-1)))/$encuestas_agregadas;
        $obs_es=$_POST['obs_es'];
        $Promedio=(($Prom1+$Prom2+$Prom3+$Prom4+$Prom5+$Prom6+$Prom7+$Prom8+$Prom9+$Prom10+$Prom11+$Prom12+$Prom13+$Prom14+$Prom15+$Prom16+$Prom17+$Prom18+$Prom19+$Prom20)/"20");
        $sql_update="UPDATE encuesta_estudiantes SET cedula=$cedula_doc,cod_esc=$cod_esc,cod_mat='$cod_mat',sec_mat='$sec_mat',lapso=$lapso,fecha='$fecha',n_inscritos='$inscritos',n_encuestados='$encuestados',encuestas_agregadas='$encuestas_agregadas',prom1='$Prom1',prom2='$Prom2',prom3='$Prom3',prom4='$Prom4',prom5='$Prom5',prom6='$Prom6',prom7='$Prom7',prom8='$Prom8',prom9='$Prom9',prom10='$Prom10',prom11='$Prom11',prom12='$Prom12',prom13='$Prom13',prom14='$Prom14',prom15='$Prom15',prom16='$Prom16',prom17='$Prom17',prom18='$Prom18',prom19='$Prom19',prom20='$Prom20',prom_total='$Promedio' WHERE  cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso' AND fecha='$fecha' AND n_inscritos='$inscritos'";
        $resultupdate=mysql_query($sql_update);
        if(!empty($obs_es))
        {
            $sql_es="INSERT INTO observaciones_planif (id_tipo,cedula,cod_esc,cod_mat,sec_mat,lapso,observacion) VALUES ('1',$cedula_doc,$cod_esc,'$cod_mat','$sec_mat',$lapso,'$obs_es')";
            $res_es=mysql_query($sql_es);
        }
    }
}
/*
if (isset($_POST['encuestas_agregadas'])) 
{
    if ($_POST['encuestas_agregadas']==$encuestados) 
    {
        header("Location: formularioencuestaestudiantes.php?z=1");
    }
}*/

if ($materia[0]=='SCO')
{ 
    $sqlbuscar="SELECT * FROM encuesta_estudiantes_sc WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
    $resultbuscar=mysql_query($sqlbuscar);
    $fila=mysql_fetch_assoc($resultbuscar);
    $cant=mysql_num_rows($resultbuscar);
    if($cant!==0)
    {
        if($fila['encuestas_agregadas']==$fila['n_encuestados'])
        {
            header("Location: formularioencuestaestudiantes.php?z=1");
        }
        if($fila['encuestas_agregadas']<$fila['n_encuestados'])
        {
            $encuestas_agregadas=$fila['encuestas_agregadas'];
            $encuestas_agregadas++;
        }
        if(isset($_POST['encuestas_agr']))
        {     
            if($_POST['encuestados']==$_POST['encuestas_agr'])     
            {
                $sql_update1="UPDATE encuesta_estudiantes_sc SET n_encuestados='$encuestados' WHERE  cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
                $resultupdate1=mysql_query($sql_update1);
                header("Location: formularioencuestaestudiantes.php?f=1");
            }
            if($_POST['encuestados']<$_POST['encuestas_agr'])     
            {
                header("Location: formularioencuestaestudiantes.php?g=1");
            }
        }
    }
    else
    {
        $encuestas_agregadas=1;
    }
}
elseif ($cod_mat=='AAAAAAAAAAA')
{ 
    $sqlbuscar="SELECT * FROM encuesta_estudiantes_tp WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
    $resultbuscar=mysql_query($sqlbuscar);
    $fila=mysql_fetch_assoc($resultbuscar);
    $cant=mysql_num_rows($resultbuscar);
    if($cant!==0)
    {
        echo $sqlbuscar;
        if($fila['encuestas_agregadas']==$fila['n_encuestados'])
        {
            header("Location: formularioencuestaestudiantes.php?z=1");
        }
        if($fila['encuestas_agregadas']<$fila['n_encuestados'])
        {
            $encuestas_agregadas=$fila['encuestas_agregadas'];
            $encuestas_agregadas++;
        }        
        if(isset($_POST['encuestas_agr']))
        {     
            if($_POST['encuestados']==$_POST['encuestas_agr'])     
            {
                $sql_update1="UPDATE encuesta_estudiantes_tp SET n_encuestados='$encuestados' WHERE  cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
                $resultupdate1=mysql_query($sql_update1);
                header("Location: formularioencuestaestudiantes.php?f=1");
            }
            if($_POST['encuestados']<$_POST['encuestas_agr'])     
            {
                header("Location: formularioencuestaestudiantes.php?g=1");
            }
        }
    }
    else
    {
        $encuestas_agregadas=1;
    }
}
else
{ 
    $sqlbuscar="SELECT * FROM encuesta_estudiantes WHERE cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
    $resultbuscar=mysql_query($sqlbuscar);
    $fila=mysql_fetch_assoc($resultbuscar);
    $cant=mysql_num_rows($resultbuscar);
    if($cant!==0)
    {
        if($fila['encuestas_agregadas']==$fila['n_encuestados'])
        {
            header("Location: formularioencuestaestudiantes.php?z=1");
        }
        if($fila['encuestas_agregadas']<$fila['n_encuestados'])
        {
            $encuestas_agregadas=$fila['encuestas_agregadas'];
            $encuestas_agregadas++;
        }        
        if(isset($_POST['encuestas_agr']))
        {     
            if($_POST['encuestados']==$_POST['encuestas_agr'])     
            {
                $sql_update1="UPDATE encuesta_estudiantes SET n_encuestados='$encuestados' WHERE  cedula='$cedula_doc' AND cod_esc='$cod_esc' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND lapso='$lapso'";
                $resultupdate1=mysql_query($sql_update1);
                header("Location: formularioencuestaestudiantes.php?f=1");
            }
            if($_POST['encuestados']<$_POST['encuestas_agr'])     
            {
                header("Location: formularioencuestaestudiantes.php?g=1");
            }
        }
    }
    else
    {
    	$encuestas_agregadas=1;
    }
}


if(!is_numeric($cedula_doc) || strlen($cedula_doc)<6 || strlen($cedula_doc)>8)
{
    header("Location: formularioencuestaestudiantes.php?h=1");
}
elseif(empty($cod_mat))
{
    header("Location: formularioencuestaestudiantes.php?i=1");
}
elseif(empty($cod_esc))
{
    header("Location: formularioencuestaestudiantes.php?j=1");
}
elseif(empty($sec_mat))
{
    header("Location: formularioencuestaestudiantes.php?k=1");
}
elseif($fecha_comp>$fechaactual)
{
    header("Location: formularioencuestaestudiantes.php?a=1");
}
elseif(($encuestados>$inscritos) || ($encuestados==0))
{
    header("Location: formularioencuestaestudiantes.php?b=1");
}
elseif($inscritos<=0)
{
    header("Location: formularioencuestaestudiantes.php?c=1");
}

include('lib/header.php'); 

if ($materia[0]=='SCO')
{?>
    <form name="EncuestaEstudiantesSC" action="encuestaestudiantes.php" method="post" align="center">
        <h2 align="center">Encuesta a los Estudiantes sobre la Actuaci&oacute;n del Docente en el Servicio Comunitario</h2>
            <table align="left" width="100%">
                <tr>
                    <td align="left" width="33%"><strong>Docente: </strong><?php echo utf8_encode($fila_cedula['nombres'])?> <?php echo utf8_encode($fila_cedula['apellidos'])?></td>
                    <td align="left" width="27%"><strong>C.I.: </strong><? echo $cedula_doc ?><input type="hidden" name="cedula_doc" value="<?php echo $cedula_doc?>"/></td>
                    <td align="left" width="13%"><strong>Fecha: </strong><?php echo $date[2] ?>-<?php echo $date[1] ?>-<?php echo $date[0] ?><input type="hidden" name="fecha" value="<?php echo $fecha?>"/></td>
                    <td align="left" width="13%"><strong>N&deg; Inscritos: </strong><? echo $inscritos ?><input type="hidden" name="inscritos" value="<?php echo $inscritos?>"/></td>
                    <td align="left" width="14%"><strong>N&deg; Encuestados: </strong><?php echo $encuestados ?><input type="hidden" name="encuestados" value="<?php echo $encuestados?>"/></td>
                </tr>
                <tr>
                    <td align="left"><strong>Asignatura: </strong><?php echo $fila_materia['cod_mat']?> - <?php echo $fila_materia['des_mat'] ?><input type="hidden" name="materia" value="<?php echo $cod_mat?>"/></td>
                    <td align="left"><strong>Escuela: </strong><?php echo $fila_escuela['Facultad'] ?><input type="hidden" name="escuela" value="<?php echo $cod_esc?>"/></td>
                    <td align="left"><strong>Secci&oacute;n: </strong><? echo $sec_mat ?><input type="hidden" name="seccion" value="<?php echo $sec_mat?>"/></td>
                    <td align="left" ><strong>Lapso: </strong><? echo $lapso ?></td>
                    <td align="left" ><strong>Encuestas: </strong><? echo $encuestas_agregadas ?> de <? echo $encuestados ?><input type="hidden" name="encuestas_agregadas" value="<?php echo $encuestas_agregadas?>"/></td>
                </tr>
            </table><br><br>         

          <table class=tabla-a align="center">
            <tr class=tabla-cabecera>
                <th class=td-a>Nro.</th>
                <th class=td-a>INDICADORES</th>
                <th class=td-a width="60">Muy Deficiente<br>(1)</th>
                <th class=td-a width="60">Deficiente<br>(2)</th>
                <th class=td-a width="60">Regular<br>(3)</th>
                <th class=td-a width="60">Bueno<br>(4)</th>
                <th class=td-a width="60">Muy Bueno<br>(5)</th>
            </tr><tr height="35">
                <td class=td-a>1</td>
                <td class=td-a align="left">Aplica estrategias de sensibilizaci&oacute;n a los estudiantes</td>
                <td class=td-a><input type="radio" name="ResA1" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>2</td>
                <td class=td-a align="left">Se revisa la Ley de Servicio Comunitario con los Estudiantes</td>
                <td class=td-a><input type="radio" name="ResA2" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>3</td>
                <td class=td-a align="left">Presenta la estructura de las actividades a desarrollar durante el proyecto</td>
                <td class=td-a><input type="radio" name="ResA3" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>4</td>
                <td class=td-a align="left">Existe intercambio de experiencias entre el Tutor de Servicio Comunitario y el estudiante</td>
                <td class=td-a><input type="radio" name="ResA4" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>5</td>
                <td class=td-a align="left">La Comunicaci&oacute;n entre el Tutor y los Estudiante es cordial</td>
                <td class=td-a><input type="radio" name="ResA5" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>6</td>
                <td class=td-a align="left">Facilita el tutor herramientas para el diagn&oacute;stico</td>
                <td class=td-a><input type="radio" name="ResA6" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>7</td>
                <td class=td-a align="left">Se analizan conjuntamente las necesidades seg&uacute;n los resultados del diagn&oacute;stico</td>
                <td class=td-a><input type="radio" name="ResA7" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>8</td>
                <td class=td-a align="left">Sugiere alternativas para la satisfacci&oacute;n de las necesidades reales de la Comunidad</td>
                <td class=td-a><input type="radio" name="ResA8" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>9</td>
                <td class=td-a align="left">Recibes el conocimiento para desarrollar actividades propias del proyecto</td>
                <td class=td-a><input type="radio" name="ResA9" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="5" class="regular-radio" required="true"></td>   
            </tr><tr height="35">
                <td class=td-a>10</td>
                <td class=td-a align="left">El tutor verifica el esquema b&aacute;sico del Proyecto</td>
                <td class=td-a><input type="radio" name="ResA10" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>11</td>
                <td class=td-a align="left">Cumple con las horas de asesor&iacute;a pautadas para el desarrollo de las actividades</td>
                <td class=td-a><input type="radio" name="ResA11" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA11" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA11" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA11" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA11" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>12</td>
                <td class=td-a align="left">Manifiesta disposici&oacute;n e inter&eacute;s en las actividades desarrolladas por el estudiantes</td>
                <td class=td-a><input type="radio" name="ResA12" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA12" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA12" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA12" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA12" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>13</td>
                <td class=td-a align="left">Supervisa el cumplimiento de las actividades de Servicio Comunitario</td>
                <td class=td-a><input type="radio" name="ResA13" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA13" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA13" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA13" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA13" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>14</td>
                <td class=td-a align="left">Asume con responsabilidad su rol como asesor del Servicio Comunitario</td>
                <td class=td-a><input type="radio" name="ResA14" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA14" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA14" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA14" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA14" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35"> 
                <td class=td-a>15</td>
                <td class=td-a align="left">Eval&uacute;a el Informe Final de Servicio Comunitario</td>
                <td class=td-a><input type="radio" name="ResA15" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA15" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA15" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA15" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA15" value="5" class="regular-radio" required="true"></td>
            </tr>              
          </table><br />

            <center><textarea cols="100" rows="7" name="obs_es" placeholder="Observaciones y Recomendaciones del Supervisor:" maxlength="500"></textarea></center><br />
            <center><?php
                if($encuestas_agregadas!=$encuestados)
                {
                    echo '<input type="submit" name="agregar_sc" value="Siguiente">';
                }else
                {
                    echo '<input type="submit" name="agregar_sc" value="Finalizar">';
                }
            ?></center>
    </form>

<?php
}
elseif ($cod_mat=='AAAAAAAAAAA')
{?>

    <form name="EncuestaEstudiantesTP" action="" method="post" align="center">
        <h2 align="center">Encuesta a Los Estudiantes sobre la Actuaci&oacute;n Docente para Asignaturas Te&oacute;rico - Pr&aacute;cticas</h2>
            <table align="left" width="100%">
                <tr>
                    <td align="left" width="33%"><strong>Docente: </strong><?php echo utf8_encode($fila_cedula['nombres'])?> <?php echo utf8_encode($fila_cedula['apellidos'])?></td>
                    <td align="left" width="27%"><strong>C.I.: </strong><? echo $cedula_doc ?><input type="hidden" name="cedula_doc" value="<?php echo $cedula_doc?>"/></td>
                    <td align="left" width="13%"><strong>Fecha: </strong><?php echo $date[2] ?>-<?php echo $date[1] ?>-<?php echo $date[0] ?><input type="hidden" name="fecha" value="<?php echo $fecha?>"/></td>
                    <td align="left" width="13%"><strong>N&deg; Inscritos: </strong><? echo $inscritos ?><input type="hidden" name="inscritos" value="<?php echo $inscritos?>"/></td>
                    <td align="left" width="14%"><strong>N&deg; Encuestados: </strong><?php echo $encuestados ?><input type="hidden" name="encuestados" value="<?php echo $encuestados?>"/></td>
                </tr>
                <tr>
                    <td align="left"><strong>Asignatura: </strong><?php echo $fila_materia['cod_mat']?> - <?php echo $fila_materia['des_mat'] ?><input type="hidden" name="materia" value="<?php echo $cod_mat?>"/></td>
                    <td align="left"><strong>Escuela: </strong><?php echo $fila_escuela['Facultad'] ?><input type="hidden" name="escuela" value="<?php echo $cod_esc?>"/></td>
                    <td align="left"><strong>Secci&oacute;n: </strong><? echo $sec_mat ?><input type="hidden" name="seccion" value="<?php echo $sec_mat?>"/></td>
                    <td align="left" ><strong>Lapso: </strong><? echo $lapso ?></td>
                    <td align="left" ><strong>Encuestas: </strong><? echo $encuestas_agregadas ?> de <? echo $encuestados ?><input type="hidden" name="encuestas_agregadas" value="<?php echo $encuestas_agregadas?>"/></td>
                </tr>
            </table><br><br>             

          <table class=tabla-a align="center">
            <tr class=tabla-cabecera>
                <th class=td-a>Nro.</th>
                <th class=td-a>INDICADORES</th>
                <th class=td-a width="70">Muy Deficiente<br>(1)</th>
                <th class=td-a width="70">Deficiente<br>(2)</th>
                <th class=td-a width="70">Regular<br>(3)</th>
                <th class=td-a width="70">Bueno<br>(4)</th>
                <th class=td-a width="70">Muy Bueno<br>(5)</th>
            </tr><tr height="35">
                <td class=td-a>1</td>
                <td class=td-a align="left">Inicia la actividad en el horario establecido</td>
                <td class=td-a><input type="radio" name="ResA1" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>2</td>
                <td class=td-a align="left">En la Actividad se expresa con lenguaje t&eacute;cnico</td>
                <td class=td-a><input type="radio" name="ResA2" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>3</td>
                <td class=td-a align="left">La pr&aacute;ctica se fundamenta en los contenidos previos a la misma</td>
                <td class=td-a><input type="radio" name="ResA3" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>4</td>
                <td class=td-a align="left">Propicia el aprendizaje en la actividad pr&aacute;ctica</td>
                <td class=td-a><input type="radio" name="ResA4" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>5</td>
                <td class=td-a align="left">Estimula el an&aacute;lisis de los contenidos de las pr&aacute;cticas</td>
                <td class=td-a><input type="radio" name="ResA5" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>6</td>
                <td class=td-a align="left">Inicia la actividad pr&aacute;ctica con la presencia del estudiante</td>
                <td class=td-a><input type="radio" name="ResA6" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>7</td>
                <td class=td-a align="left">La actividad pr&aacute;ctica se desarrolla en un ambiente emp&aacute;tico</td>
                <td class=td-a><input type="radio" name="ResA7" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>8</td>
                <td align="left">Cumple lo establecido en el plan de evaluaci&oacute;n</td>
                <td class=td-a><input type="radio" name="ResA8" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>9</td>
                <td class=td-a align="left">Recibe retroinformaci&oacute;n al final de la actividad pr&aacute;ctica</td>
                <td class=td-a><input type="radio" name="ResA9" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="5" class="regular-radio" required="true"></td>  
            </tr><tr height="35">
                <td class=td-a>10</td>
                <td class=td-a align="left">Se cumple con el horario de salida establecido para la actividad pr&aacute;ctica</td>
                <td class=td-a><input type="radio" name="ResA10" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="5" class="regular-radio" required="true"></td>
            </tr>         
          </table><br />

            <center><textarea cols="100" rows="7" name="obs_es" placeholder="Observaciones y Recomendaciones del Supervisor:" maxlength="500"></textarea></center><br />
            <center><?php
                if($encuestas_agregadas!=$encuestados)
                {
                    echo '<input type="submit" name="agregar_tp" value="Siguiente">';
                }else
                {
                    echo '<input type="submit" name="agregar_tp" value="Finalizar">';
                }
            ?></center>
    </form>

<?php
}
else
{?>

   <form name="EncuestaEstudiantes" action="" method="post">
        <h2 align="center">Encuesta a los Estudiantes sobre la Actuaci&oacute;n del Docente</h2>
            <table align="left" width="100%">
                <tr>
                    <td align="left" width="33%"><strong>Docente: </strong><?php echo utf8_encode($fila_cedula['nombres'])?> <?php echo utf8_encode($fila_cedula['apellidos'])?></td>
                    <td align="left" width="27%"><strong>C.I.: </strong><? echo $cedula_doc ?><input type="hidden" name="cedula_doc" value="<?php echo $cedula_doc?>"/></td>
                    <td align="left" width="13%"><strong>Fecha: </strong><?php echo $date[2] ?>-<?php echo $date[1] ?>-<?php echo $date[0] ?><input type="hidden" name="fecha" value="<?php echo $fecha?>"/></td>
                    <td align="left" width="13%"><strong>N&deg; Inscritos: </strong><? echo $inscritos ?><input type="hidden" name="inscritos" value="<?php echo $inscritos?>"/></td>
                    <td align="left" width="14%"><strong>N&deg; Encuestados: </strong><?php echo $encuestados ?><input type="hidden" name="encuestados" value="<?php echo $encuestados?>"/></td>
                </tr>
                <tr>
                    <td align="left"><strong>Asignatura: </strong><?php echo $fila_materia['cod_mat']?> - <?php echo $fila_materia['des_mat'] ?><input type="hidden" name="materia" value="<?php echo $cod_mat?>"/></td>
                    <td align="left"><strong>Escuela: </strong><?php echo $fila_escuela['Facultad'] ?><input type="hidden" name="escuela" value="<?php echo $cod_esc?>"/></td>
                    <td align="left"><strong>Secci&oacute;n: </strong><? echo $sec_mat ?><input type="hidden" name="seccion" value="<?php echo $sec_mat?>"/></td>
                    <td align="left" ><strong>Lapso: </strong><? echo $lapso ?></td>
                    <td align="left" ><strong>Encuestas: </strong><? echo $encuestas_agregadas ?> de <? echo $encuestados ?><input type="hidden" name="encuestas_agregadas" value="<?php echo $encuestas_agregadas?>"/></td>
                </tr>
            </table><br><br> 

          <table class=tabla-a align="center">
            <tr class=tabla-cabecera>
                <th class=td-a>Nro.</th>
                <th class=td-a>INDICADORES</th>
                <th class=td-a width="70">Muy Deficiente<br>(1)</th>
                <th class=td-a width="70">Deficiente<br>(2)</th>
                <th class=td-a width="70">Regular<br>(3)</th>
                <th class=td-a width="70">Bueno<br>(4)</th>
                <th class=td-a width="70">Muy Bueno<br>(5)</th>
            </tr><tr height="35">
                <td class=td-a>1</td>
                <td class=td-a align="left">Es Puntual en la llegada al aula o sitio de desarrollo de la clase</td>
                <td class=td-a><input type="radio" name="ResA1" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA1" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>2</td>
                <td class=td-a align="left">Cumple con la hora de salida seg&uacute;n el horario de clases</td>
                <td class=td-a><input type="radio" name="ResA2" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA2" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>3</td>
                <td class=td-a align="left">Cumple con las actividades acad&eacute;micas seg&uacute;n el horario establecido</td>
                <td class=td-a><input type="radio" name="ResA3" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA3" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>4</td>
                <td class=td-a align="left">Desarrolla el contenido program&aacute;tico con lenguaje claro y preciso</td>
                <td class=td-a><input type="radio" name="ResA4" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA4" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>5</td>
                <td class=td-a align="left">Emplea diversas t&eacute;cnicas de aprendizaje para desarrollar el contenido planificado</td>
                <td class=td-a><input type="radio" name="ResA5" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA5" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>6</td>
                <td class=td-a align="left">Usa t&eacute;cnicas para propiciar la participaci&oacute;n de los estudiantes</td>
                <td class=td-a><input type="radio" name="ResA6" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA6" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>7</td>
                <td class=td-a align="left">Posee habilidades en el manejo de los recursos did&aacute;cticos</td>
                <td class=td-a><input type="radio" name="ResA7" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA7" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>8</td>
                <td align="left">Evidencia habilidades y destrezas para presentar y desarrollar la clase</td>
                <td class=td-a><input type="radio" name="ResA8" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA8" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>9</td>
                <td class=td-a align="left">Demuestra conocimiento y dominio sobre el contenido de la asignatura</td>
                <td class=td-a><input type="radio" name="ResA9" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA9" value="5" class="regular-radio" required="true"></td>  
            </tr><tr height="35">
                <td class=td-a>10</td>
                <td class=td-a align="left">Responde, atiende y aclara dudas e interrogantes</td>
                <td class=td-a><input type="radio" name="ResA10" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA10" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>11</td>
                <td class=td-a align="left">Cumple con lo establecido en el Plan de Evaluaci&oacute;n</td>
                <td class=td-a><input type="radio" name="ResA11" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA11" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA11" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA11" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA11" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>12</td>
                <td class=td-a align="left">Usa diferentes t&eacute;cnicas o estrategias para evaluar el aprendizaje</td>
                <td class=td-a><input type="radio" name="ResA12" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA12" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA12" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA12" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA12" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>13</td>
                <td class=td-a align="left">Retroinformaci&oacute;n despu&eacute;s de corregida cada estrategia de evaluaci&oacute;n</td>
                <td class=td-a><input type="radio" name="ResA13" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA13" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA13" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA13" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA13" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>14</td>
                <td class=td-a align="left">Efect&uacute;a la entrega de los soportes desp&uacute;es de corregidas las estrategias de evaluaci&oacute;n</td>
                <td class=td-a><input type="radio" name="ResA14" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA14" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA14" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA14" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA14" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35"> 
                <td class=td-a>15</td>
                <td class=td-a align="left">Sugiere actividades de investigaci&oacute;n para desarrollo de clases futuras</td>
                <td class=td-a><input type="radio" name="ResA15" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA15" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA15" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA15" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA15" value="5" class="regular-radio" required="true"></td>
            </tr><tr height="35">
                <td class=td-a>16</td>
                <td class=td-a align="left">Registra la asistencia de los estudios</td>
                <td class=td-a><input type="radio" name="ResA16" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA16" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA16" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA16" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA16" value="5" class="regular-radio" required="true"></td> 
            </tr><tr height="35">
                <td class=td-a>17</td>
                <td class=td-a align="left">Controla la disciplina del grupo</td>
                <td class=td-a><input type="radio" name="ResA17" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA17" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA17" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA17" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA17" value="5" class="regular-radio" required="true"></td> 
            </tr><tr height="35">
                <td class=td-a>18</td>
                <td class=td-a align="left">Su presentaci&oacute;n personal est&aacute; acorde con el rol de facilitador</td>
                <td class=td-a><input type="radio" name="ResA18" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA18" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA18" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA18" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA18" value="5" class="regular-radio" required="true"></td>    
            </tr><tr height="35">
                <td class=td-a>19</td>
                <td class=td-a align="left">El trato es respetuoso con los estudiantes</td>
                <td class=td-a><input type="radio" name="ResA19" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA19" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA19" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA19" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA19" value="5" class="regular-radio" required="true"></td>  
            </tr><tr  height="35">
                <td class=td-a>20</td>
                <td class=td-a align="left">Ejecuta la retroinformaci&oacute;n del corte seg&uacute;n lo establecido en el plan de evaluaci&oacute;n (En el caso que la Encuesta sea aplicada desp&uacute;es del primer corte)</td>
                <td class=td-a><input type="radio" name="ResA20" value="1" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA20" value="2" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA20" value="3" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA20" value="4" class="regular-radio" required="true"></td>
                <td class=td-a><input type="radio" name="ResA20" value="5" class="regular-radio" required="true"></td>
            </tr>                 
          </table><br />

            <center><textarea cols="100" rows="7" name="obs_es" placeholder="Observaciones y Recomendaciones del Supervisor:" maxlength="500"></textarea></center><br />
            <center><?php
                if($encuestas_agregadas!=$encuestados)
                {
                    echo '<input type="submit" name="agregar" value="Siguiente">';
                }else
                {
                    echo '<input type="submit" name="agregar" value="Finalizar">';
                }
            ?></center>
    </form>

<?php } ?>
<?php include('../lib/footer.php'); ?>