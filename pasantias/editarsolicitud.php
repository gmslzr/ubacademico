<?php  
include('../lib/session.php');
include('../lib/conexion.php');
$Success=False;
$Error=False;


include('lib/header.php');

$sqlAreas = "SELECT * FROM perfiles";
//Ejecutar la consulta
$areas = mysql_query($sqlAreas);
    

    $sqlEmpresas = "SELECT * FROM empresas";
    //Ejecutar la consulta
    $empresasQ = mysql_query($sqlEmpresas);

$cedulaest = $_GET['cedulaest'];

//consulto la bd para ver si existe el registro
$sqlBuscar = "SELECT *,(SELECT NOM_APE FROM estudiantes WHERE cedula=listaalumnos.cedula) as NOM_APE ,(SELECT nom_emp FROM empresas WHERE codEmp=listaalumnos.codEmp) as nom_emp, (SELECT codPer FROM empresas_area WHERE codEmp= listaalumnos.codEmp) as codPer, (SELECT codTutor FROM empresas_tutor WHERE codEmp= listaalumnos.codEmp) as codTutor FROM listaalumnos WHERE cedula= $cedulaest";
    //ejecuto la consulta

$resultado = mysql_query($sqlBuscar);

$fila = mysql_fetch_assoc($resultado);

$codEmp=$fila['codEmp'];
$nombre=$fila['NOM_APE'];
$telefono=$fila['telf_emp'];
$area=$fila['area'];
$vacantes=$fila['vacantes'];
$cod_estatus=$fila['cod_estatus'];

$cod_estatus1="";  
$cod_estatus2="";
$cod_estatus3="";
$cod_estatus4="";
$cod_estatus5="";
if($cod_estatus == '1')
    {
      $cod_estatus1 ='selected';
    }
    elseif($cod_estatus == '2')
      {
        $cod_estatus2 ='selected';
      }
      elseif($cod_estatus == '3')
      {
        $cod_estatus3 ='selected';
      }  
      elseif($cod_estatus == '4')
      {
        $cod_estatus4 ='selected';
      }     
      elseif($cod_estatus == '5')
      {
        $cod_estatus5 ='selected';
      }   
    
if(isset($_POST['validar']))
  { 
            $cedulaest=$_POST['cedulaest'];
            $codEmp=$_POST['codEmp'];
            $area=$_POST['area'];
            $vacantes=$_POST['vacantes'];
            $cod_estatus=$_POST['cod_estatus'];
            $Error=true;
            if ($vacantes == "0")
            { 
                $msgError="La empresa seleccionada no tiene vacantes disponibles. Por favor seleccione otra.";
            }
            elseif ($codEmp == $fila['codEmp']) 
            {
                  $sqlActualizar ="UPDATE listaalumnos SET cod_estatus = '$cod_estatus' WHERE cedula ='$cedulaest' and $codEmp = '$codEmp' and lapso = '$lapso'";
                  $result_insert=mysql_query($sqlActualizar);
                  $Error=false;
                  $Success=true;
                  if($result_insert)
                  {
                      $msgSuccess="El alumno fue actualizado a una empresa satisfactoriamente.";
                  }
                  else
                  {
                      echo mysql_error();
                  }
            }
            else
            {
                  $sqlActualizar="UPDATE listaalumnos SET codEmp='$codEmp', cod_estatus='$cod_estatus',lapso='$lapso' WHERE cedula='$cedulaest'";
                  $vacantes--;
                  $actualizarvacantes="UPDATE empresas SET vacantes = $vacantes WHERE codEmp = $codEmp";
                  $result_vacantes= mysql_query($actualizarvacantes);
                  $result_insert=mysql_query($sqlActualizar);
                  $Error=false;
                  $Success=true;
                  if($result_insert)
                  {
                      $msgSuccess="El alumno fue actualizado a una empresa satisfactoriamente.";
                  }
                  else
                  {
                      echo mysql_error();
                  }
            }
            
  }
?>
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


<script type="text/javascript">

  $(document).ready(function(){

      $("#cedulaest").blur(function(){
            var cedulaest = $("#cedulaest").val();
            var busqueda = "NOM_APE";
            $.ajax({
              type: "GET",
              url: "lib/procesamiento.php?dato="+cedulaest+"&busqueda="+busqueda+"&cond=cedula&tabla=estudiantes",
              cache: false,
              success: function(html)
              {
                $("#nombre").val(html);
              } 
            });
          }); 

      $("#empresas").change(function(){
            var empresa = $("#empresas").val();
            var busqueda = 'telf_emp';
            $.ajax({
              type: "GET",
              url: "lib/procesamiento.php?dato="+empresa+"&busqueda="+busqueda+"&cond=codEmp&tabla=empresas",
              cache: false,
              success: function(html)
              {
                $("#telf_emp").val(html);
              } 
            });
          });

        $("#empresas").change(function(){
            var empresa = $("#empresas").val();
            var busqueda = 'vacantes';
            $.ajax({
              type: "GET",
              url: "lib/procesamiento.php?dato="+empresa+"&busqueda="+busqueda+"&cond=codEmp&tabla=empresas",
              cache: false,
              success: function(html)
              {
                $("#vacantes").val(html);
              } 
            });
          });
        $("#empresas").change(function(){
            var empresa = $("#empresas").val();
            var busqueda = "codPer";
                $.ajax({
                    type: "GET",
                    url: "lib/procesamiento.php?dato="+empresa+"&busqueda="+busqueda+"&cond=codEmp&tabla=empresas_area&multiple=area",
                    cache: false,
                    success: function(html)
                    {
                        $("#area").html(html);
                    } 
                });
            }); 
    


  });
</script>

<h2>Editar Solicitud</h2> 
<form name="registroAlumno" action="" method="post">
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
          if ($Error !=False && isset($Error)){
        ?>
        <tr>
          <td colspan="2" >
            <div class ="warning"> <?php echo $msgError ?></div>
          </td>
        </tr>
        <?php } ?>
         <tr>
        <td colspan="2" >Lapso: <?php echo $lapso ?></td>        
      </tr>
    <tr>
        <td>Cedula</td>
        <td><input type="text" auto_complete="cedulaest" name="cedulaest" id="cedulaest" pattern="[0-9]{7,9}" value="<?php echo $cedulaest ?>"  title="El campo debe tener al menos 7 numeros y debe ir sin puntos Ej.1234567"required/></td>
      </tr>

      <tr>
        <td>Nombre</td>
        <td><input name="nombre_alumno" size="70" id="nombre" type="text" name="nombre" value="<?php echo $nombre; ?>" readonly/></td>
      </tr>
      <tr>
        <td>Empresas</td>     
        <td>
          <select id="empresas" name="codEmp" title="Seleccione una empresa por favor." required>
            <option value ="">Seleccione un empresa</option>
            <?php while($fila = mysql_fetch_assoc($empresasQ)): ?>
              <option value="<?php echo $fila['codEmp']?>"<?php echo ($codEmp == $fila['codEmp'])?"selected='selected'":""; ?> ><?php echo $fila['nom_emp'] ?> </option>
            <?php endwhile ?>
        </select> </td>
      </tr>
      <tr>
        <td>Vacantes</td>
        <td><input type="text" name="vacantes" id="vacantes" readonly size="2" readonly></td>
      </tr>
      <tr>
        <td>Telefono</td>
        <td><input id="telf_emp" type="text" name="telf_emp" value="" readonly> </input></td>
      </tr>
      <tr>
        <td>Area</td>     
        <td>
          <select id="area" name="area" title="Se necesita un area." required>
            <option value ="">Seleccione un area</option>
            <?php while($fila = mysql_fetch_assoc($areas)): ?>
              <option value="<?php echo $fila['codPer']?>"><?php echo  $fila['perfil'] ?> </option>
            <?php endwhile ?>
          </select> 
      </td>
      </tr>
      <tr>
        <td>Estatus</td>     
        <td>
          <select id="cod_estatus" name="cod_estatus" title="Se necesita un estatus" required>
            <option value ="">Seleccione un estatus</option>
            <option value ="1" <?php echo $cod_estatus1 ?> >En Solicitud</option>
            <option value ="2" <?php echo $cod_estatus2 ?> >En Proceso</option>
            <option value ="3" <?php echo $cod_estatus3 ?>>Visitado</option>
            <option value ="4" <?php echo $cod_estatus4 ?>>Culminado</option>
            <option value ="5" <?php echo $cod_estatus5 ?>>Aprobado</option>


            </select> 
      </td>
      </tr>
     

  <td colspan="2" style="text-align: center"><input type="submit" name="validar" value="Guardar" /></td>
  </table></td>

</form>
</div>  
<?php include('../lib/footer.php'); ?>
