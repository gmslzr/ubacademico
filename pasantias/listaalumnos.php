<?php 
include('../lib/session.php');
include('../lib/conexion.php');

    $sqlBuscar = "SELECT *,(SELECT NOM_APE FROM estudiantes WHERE cedula=listaalumnos.cedula) as NOM_APE ,(SELECT nom_emp FROM empresas WHERE codEmp=listaalumnos.codEmp) as nom_emp, (SELECT codPer FROM empresas_area WHERE codEmp= listaalumnos.codEmp) as codPer, (SELECT codTutor FROM empresas_tutor WHERE codEmp= listaalumnos.codEmp) as codTutor FROM listaalumnos WHERE cod_escuela =$cod_pas_escu and lapso = $lapso";
    //ejecuto la consulta

    $resultado = mysql_query($sqlBuscar);
    echo mysql_error();
    //verifico si hay registros
    $cant = mysql_num_rows($resultado);

        function mostrarArea($codPer){
        if($codPer == ""){
            return "Esta empresa aun no tiene area.";
        }
            include('../lib/conexion.php');

        $sqlAreas = "SELECT perfil FROM perfiles WHERE codPer = $codPer";
        //Ejecutar la consulta
        $areas = mysql_fetch_array(mysql_query($sqlAreas));
        return $areas['perfil'];
        }

function mostrarTutor($codTutor){
        if($codTutor == ""){
            return "Esta empresa aun no tiene un tutor asignado.";
        }
        include('../lib/conexion.php');

        $sqlTutor = "SELECT nombre FROM tutorindustrial WHERE codTutor = $codTutor";
        //Ejecutar la consulta
        $tutor = mysql_fetch_array(mysql_query($sqlTutor));
        return $tutor['nombre'];
        }

function mostrarEstatus($cod_estatus){
        if($cod_estatus == "1"){
            return "En Solicitud";
        }
        elseif($cod_estatus == "2"){
            return "En Proceso";
        }
        elseif($cod_estatus == "3"){
            return "Visita realizada";
        }
        elseif($cod_estatus == "4"){
            return "Culminado";
        }
        elseif($cod_estatus == "5"){
            return "Aprobado";
        }
    }

include('lib/header.php');?>

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
                    "aaSorting":[[1, "asc"]],

                   
                    "bJQueryUI":true
                });
            })

function confirmDel(url){
//var agree = confirm("¿Realmente desea eliminarlo?");
if(confirm(String.fromCharCode(191)+"Desea realmente eliminar el alumno seleccionado?"))
    window.location.href = url;
else
    return false ;
}

        </script>
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
</style>
<h2 align="center">Listado de Estudiantes en el sistema</h2>
<form align="center" style="width:90%;"> 
    <table id ="datatable" class="display" align="center" >
            <thead>
        <tr>
            <th>Cedula</th>
            <th>Alumnos Inscritos</th>
            <th>Empresa</th>
            <th>Tutor Industrial</th>
            <th>Perfil Requerido</th>
            <th>Estatus</th>
            <th>Opciones</th>
        </tr>
            </thead>
                    <tbody>
                        <?php if ($cant>0) : ?>
                        <?php while($fila = mysql_fetch_assoc($resultado)) : ?> 
                            <tr>
                                
                                <td><?php echo  $fila['cedula']; ?></td>
                                <td><?php echo utf8_encode ($fila['NOM_APE']); ?></td>
                                <td><?php echo ($fila['nom_emp']); ?></td>
                                <td><?php echo (mostrarTutor($fila['codTutor'])); ?></td>
                                <td><?php echo (mostrarArea($fila['codPer'])); ?></td>
                                <td><?php echo (mostrarEstatus($fila['cod_estatus'])); ?> </td>
                                <td><a href="solicitudpasantias.php">Agregar</a>|<a href="eliminarsolicitud.php?cedula=<?php echo $fila['cedula'];?>" onclick="if(confirmDel() == false){return false;}">Eliminar</a>|<a href="editarsolicitud.php?cedulaest=<?php echo $fila['cedula']; ?>">Editar</a> </td>
                            </tr>
                        <?php endwhile; ?>
                            <? else: ?>
                                <tr><td colspan="6">No se encontraron registros</td></tr>
                            <?php endif; ?>
             
                    </tbody>
    </table>
</form>

<div class="pie">
            <hr width="90%"/>
            <strong>Una Universidad para la Creatividad</strong><br/>
            <strong>Todos los Derechos Reservados Universidad Bicentenaria de Aragua 2013</strong><br />
            Av. Intercomunal Santiago Mari&ntilde;o c/c Av. Universidad, Sector la Providencia, San Joaqu&iacute;n de Turmero - Estado Aragua - Venezuela<br />
            <strong>Sistema realizado por los Estudiantes de UBA Acad&eacute;mico | 2013</strong>
        </div>
       </div>
        </body>
</html>