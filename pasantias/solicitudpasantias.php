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

if(isset($_POST['validar']))
      { 
            $cedulaest=$_POST['cedulaest'];
            $codEmp=$_POST['codEmp'];
            $nombre=$_POST['nombre'];
            $cod_escu_est=$_POST['cod_escu_est'];
            $telefono=$_POST['telf_emp'];
            $area=$_POST['area'];
            $vacantes=$_POST['vacantes'];
            $cod_estatus=$_POST['cod_estatus'];
            $Error=true;
            if ($vacantes == "0")
              { 
                $msgError="La empresa seleccionada no tiene vacantes disponibles. Por favor seleccione otra.";
              }
              else
              {
                  $sql_insertar="INSERT INTO listaalumnos (cedula, codEmp, cod_escuela,cod_estatus,lapso)
                  VALUES ('$cedulaest', '$codEmp', '$cod_escu_est','$cod_estatus','$lapso')";
                  $vacantes--;
                  $actualizarvacantes="UPDATE empresas SET vacantes = $vacantes WHERE codEmp = $codEmp";
                  $result_vacantes= mysql_query($actualizarvacantes);
                  $result_insert=mysql_query($sql_insertar);
                  $Error=false;
                  $Success=true;
                    if($result_insert){
                            $msgSuccess="El alumno fue asignado a una empresa satisfactoriamente.";
                    }
                    else{
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

          $("#cedulaest").blur(function(){
            var cedulaest = $("#cedulaest").val();
            var busqueda = "COD_ESC";
            $.ajax({
              type: "GET",
              url: "lib/procesamiento.php?dato="+cedulaest+"&busqueda="+busqueda+"&cond=cedula&tabla=estudiantes",
              cache: false,
              success: function(html)
              {
                $("#cod_escu_est").val(html);
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

<h2>Solicitud de Pasantias</h2> 
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
        <td><input type="text" auto_complete="cedulaest" name="cedulaest" id="cedulaest" pattern="[0-9]{7,9}" value="" title="El campo debe tener al menos 7 numeros y debe ir sin puntos Ej.1234567"required/></td>
      </tr>

      <tr>
        <td>Nombre</td>
        <td><input size="70" id="nombre" type="text" name="nombre" value="" readonly/></td>
      </tr>
      <tr>
        <td>Escuela</td>
        <td><input name="cod_escu_est" size="40" id="cod_escu_est" type="text"  value="" readonly/></td>
      </tr>
      <tr>
        <td>Empresas</td>     
        <td>
          <select id="empresas" name="codEmp" title="Seleccione una empresa por favor.">
            <option value ="">Seleccione un empresa</option>
            <?php while($fila = mysql_fetch_assoc($empresasQ)): ?>
              <option value="<?php echo $fila['codEmp']?>"><?php echo $fila['nom_emp'] ?> </option>
            <?php endwhile ?>
        </select> </td>
      </tr>
      <tr>
        <td>Vacantes</td>
        <td><input type="text" name="vacantes" id="vacantes" readonly size="2"></td>
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
            <option value ="1">En Solicitud</option>
            <option value ="2">En Proceso</option>
            <option value ="3">Visitado</option>
            <option value ="3">Culminado</option>
            <option value ="4">Aprobado</option>
            </select> 
      </td>
      </tr>
     

  <td colspan="2" style="text-align: center"><input type="submit" name="validar" value="Guardar" /></td>
  </table></td>

</form>
</div>  
<?php include('../lib/footer.php'); ?>
