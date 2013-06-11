<?php 
include('config/conexion.php');

include('config/header.php');

?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#cedula").blur(function(){
            var cedula = $("#cedula").val();
            var busqueda = "NOM_APE";
                $.ajax({
                    type: "GET",
                    url: "config/procesamiento.php?dato="+cedula+"&busqueda="+busqueda+"&cond=cedula&tabla=estudiantes",
                    cache: false,
                    success: function(html)
                    {
                        $("#nombre").val(html);

                        var cedula = $("#cedula").val();
                        var busqueda = "COD_ESC";
                            $.ajax({
                                type: "GET",
                                url: "config/procesamiento.php?dato="+cedula+"&busqueda="+busqueda+"&cond=cedula&tabla=estudiantes",
                                cache: false,
                                success: function(html)
                                {
                                    $("#escuela").val(html);
                                } 
                            });
                    } 
                });
            });
    });

</script>

 <BODY>
 	<form name="registrartesis" method="post" action="">
 		<table>
 			<tr>
 				<td>C&eacute;dula del Autor: </td>
 				<td><input name="cedula"  id="cedula" type="text" value="" placeholder="C.I. del Autor" required></td>
 			</tr>
 			<tr>
 				<td>Nombre del Autor: </td>
 				<td><input name="nombre"  id="nombre" type="text" value="" placeholder="Nombre del Autor" readonly></td>
 			</tr>	
 			<tr>
				<td>Escuela: </td>
				<td><input name="escuela" id="escuela" type="text" value="" placeholder="Escuela"></td>
 			</tr> 			
 			<tr>
 				<td>N&uacute;cleo: </td>
 				<td><input name="nucleo" id="nucleo" type="text" value="" placeholder="N&uacute;cleo" readonly></td>
 			</tr>
 			<tr>
 				<td>T&iacute;tulo de la T&eacute;sis: </td>
 				<td><input name="titulo"  id="titulo" type="text" value="" placeholder="T&iacute;tulo de la T&eacute;sis" required></td>
 			</tr>	
 			
 			<tr>
 				<td>A&ntilde;o: </td>
 				<td><input name="anio" id="anio" type="text" value="" placeholder="A&ntilde;o" required></td>
 			</tr>
 			<tr>
 				<td>Promoci&oacute;n: </td>
 				<td><input name="promocion" id="promocion" type="text" value="" placeholder="Ej: XXXX" required></td>
 			</tr>
			<tr>
 				<td>Cutter: </td>
 				<td><input name="cutter"  id="cutter" type="text" value="" placeholder="N&deg; de Cutter" required></td>
 			</tr>		
 			<tr>
 				<td>Formato: </td>
 				<td><input name="formato_fisico" id="formato_fisico" value="" type="checkbox">F&iacute;sico - <input name="formato_pdf" id="formato_pdf" value="" type="checkbox">Pdf</td> 			
 			</tr>
 			<tr>
 				<td>Nivel de Estudio: </td>
 				<td><select name="nivel" id="nivel" value="" type=""></select></td>
 			</tr>
 		</table>
 	</form>

 </BODY> 
 </html>