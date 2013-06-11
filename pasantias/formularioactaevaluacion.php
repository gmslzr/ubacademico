<?php 
include('../lib/session.php');
include('../lib/conexion.php');
$Error=false;

if(isset($_GET['a']) && $_GET['a'] == 1)
{
  $Error=True;
  $msgError="La Nota del Tutor Industrial debe estar entre 01 y no puede ser mayor a 100 pts.";
}
if(isset($_GET['b']) && $_GET['b'] == 1)
{
  $Error=True;
  $msgError="La Nota del Tutor Academico debe estar entre 01 y no puede ser mayor a 100 pts.";
}
if(isset($_GET['c']) && $_GET['c'] == 1)
{
  $Error=True;
  $msgError="La Nota del Informe debe estar entre 01 y no puede ser mayor a 100 pts.";
}

    /* if(isset($_POST['generar']) && $_POST['generar']='Generar PDF')
        { 
          $cedulaest=$_POST['cedulaest'];
          $nombreest=$_POST['nombreest'];
          $escuela=$_POST['escuela'];
          $nom_emp=$_POST['nom_emp'];
          $nota_indus=$_POST['nota_indus'];
          $nota_acad=$_POST['nota_acad'];
          $nota_info=$_POST['nota_info'];
          if (($nota_indus>100) || ($nota_indus<=0)){
            $Error=True;
            $msgError="La Nota del Tutor Industrial debe estar entre 01 y no puede ser mayor a 100 pts.";
          }elseif (($nota_acad>100) || ($nota_acad<=0)){
            $Error=True;
            $msgError="La Nota del Tutor Academico debe estar entre 01 y no puede ser mayor a 100 pts.";
          }
          elseif (($nota_info>100) || ($nota_info<=0)){
            $Error=True;
            $msgError="La Nota del Informe debe estar entre 01 y no puede ser mayor a 100 pts.";
          } 
          else{
              header("Location: actaevaluacionpasantetopdf.php?cedulaest=$cedulaest&nombreest=$nombreest&escuela=$escuela&nom_emp=$nom_emp&nota_indus=$nota_indus&nota_acad=$nota_acad&nota_info=$nota_info");
            }           
        }
*/
    include('lib/header.php');
  ?>

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

                            $("#nombreest").val(html);

                            var cedulaest = $("#cedulaest").val();
                            var busqueda = "COD_ESC";
                            $.ajax({
                                    type: "GET",
                                    url: "lib/procesamiento.php?dato="+cedulaest+"&busqueda="+busqueda+"&cond=cedula&tabla=estudiantes",
                                    cache: false,
                                    success: function(html)
                                          {

                                            $("#escuela").val(html);

                                            var cedulaest = $("#cedulaest").val();
                                            var busqueda = "codEmp";
                                            $.ajax({
                                                    type: "GET",
                                                    url: "lib/procesamiento.php?dato="+cedulaest+"&busqueda="+busqueda+"&cond=cedula&tabla=listaalumnos",
                                                    cache: false,
                                                    success: function(html)
                                                          {
                                                            $("#nom_emp").val(html);
                                                                
                                                    }     
                                                });
                                    } 
                            });
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

<h2 align="center"> Datos para la Acta de Evaluaci&oacute;n del Pasante</h2>
<form name="notas" action="actaevaluacionpasantetopdf.php" method="post">
		<table align="center" >  
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
            <td><strong>C&eacute;dula de Identidad:</strong></td>
            <td><input type="text" auto_complete="cedulaest" name="cedulaest" id="cedulaest" value="<?php if(isset($cedulaest)){echo $cedulaest;}?>" placeholder="C&eacute;dula del Estudiante" title="Se necesita una Cedula." required></td>
          </tr> 
            <tr>
                <td><strong>Nombres y Apellidos:</strong></td>
                <td><input type="text" size="50" name="nombreest" id="nombreest" value="<?php if(isset($nombreest)){echo $nombreest;}?>"  placeholder="Nombre del Estudiante" readonly></td>
            </tr>          
          <tr>
            <td><strong>Escuela:</strong></td>
            <td><input type="text" size="50" name="escuela" id="escuela" value="<?php if(isset($escuela)){echo $escuela;}?>"  placeholder="Nombre de la Facultad" readonly></td>
          </tr>
  <tr>
    <td><strong>Empresa:</strong></td>
    <td><input type="text" size="50" name="nom_emp" id="nom_emp" value="<?php if(isset($nom_emp)){echo $nom_emp;}?>"  placeholder="Nombre del Empresa" readonly ></td>
  </tr> 
  <tr><td></td><td>Las notas ingresadas a continuaci&oacute;n son en base al 100%</td></tr>
  <tr>
    <td><strong>Evaluacion del Tutor Industrial</strong></td>
    <td><input type="text" name="nota_indus" id="nota_indus" value="<?php if(isset($nota_indus)){echo $nota_indus;}?>" size="2" maxlength="3" placeholder="Nota" title="Se necesita una nota Ej:90 pts." required></td>
  </tr>
  <tr>
    <td><strong>Evaluacion del Tutor Academico</strong></td>
    <td><input type="text" name="nota_acad" id="nota_acad" value="<?php if(isset($nota_acad)){echo $nota_acad;}?>" size="2" maxlength="3" placeholder="Nota" title="Se necesita una nota Ej:90 pts." required></td>
  </tr>
  <tr>
    <td><strong>Evaluacion del Informe</strong></td>
    <td><input type="text" name="nota_info" id="nota_info" value="<?php if(isset($nota_info)){echo $nota_info;}?>" size="2" maxlength="3" placeholder="Nota" title="Se necesita una nota Ej:90 pts." required></td>
  </tr>
  <td colspan="2" style="text-align: center"><input type="submit" name="generar" value="Generar PDF" ></td>

</table><br /><br />
</form>
</div>
<?php include('../lib/footer.php'); ?>