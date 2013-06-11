<?php include('config/conexion.php'); 
$query= mysql_query("SELECT * FROM tbl_area");


?>

 <HEAD>
  <TITLE>biblioteca</TITLE>
 </HEAD>
 <BODY>
 	 <form name="registrodelibros" method="post" action="guardarlibro.php">
	 	<table width="100%" aling="center">
	 		<tr align="center"> 
	 			<td>
	 				<div id="logo"> <a href="#"><img src="images/logo.jpg" alt="uba"></a></div>
	 			</td>
	 			<td>
	 				<strong>Universidad Bicentenaria de Aragua</strong><br>
	 				<strong>Vicerrectorado Acad&eacute;mico</strong><br>
	 				<strong>Biblioteca "Dr. Emilio Medina"</strong><br>
	 				<strong>Departamento de Procesos T&eacute;cnicos</strong>
	 			</td>
	 			<td><strong>Cota</strong><br>
	 				<input type="text" id="primero" name="primero" value=""/><br>
	 				<input type="text" id="segundo" name="segundo" value=""/><br>
	 				<input type="text" id="tercero" name="tercero" value=""/>
	 			</td>
	 		</tr>
	  	</table>
	 	<h4 align="center">FORMATO PARA FICHAS CATALOGR&Aacute;FICAS</h4>
	  	<table width="100%">
	  		<tr>
	  			<td>Autor Principal: 
	  				<input type="text" id="autor_pr" name="autor_pr" value=""/>
	  			</td>
	  		</tr>
	  		<tr>
	  			<td>Autor(es) Secundario(s): 
	  				<input type="text" id="autor_se" name="autor_se" value=""/>
	  			</td>
	  		</tr>
	  		<tr>
	  			<td>Autor Corporativo: 
	  				<input type="text" id="autor_corp" name="autor_corp" value=""/>
	  			</td>
	  		</tr>
	  		<tr>
	  			<td>T&iacute;tulo: 
	  				<textarea rows="7" name="titulo" id="titulo" value=""></textarea>
	  			</td>
	  		</tr>
	  		<tr>
	  			<td>T&iacute;tulo Original: 
	  				<input type="text" id="titulo_or" name="titulo_or" value=""/>
	  			</td>
	  		</tr>
	  		<tr>
	  			<td>Idioma Original: 
	  				<input type="text" id="idioma" name="idioma" value=""/>
	  			</td>
	  		</tr>
	  		<tr>
	  			<td>Editorial: 
	  				<input type="text" id="editorial" name="editorial" value=""/>
	  			</td>
	  			<td>Origen:
	  				<input type="text" id="origen" name="origen" value=""/>
	  			</td>
	  			<td>Compra
	  				<input type="text" id="compra" name="compra" value=""/>
	  			</td>
	  			<td>Canje
	  				<input type="text" id="canje" name="canje" value=""/>
	  			</td>
	  			<td>Donacio&oacute;n
	  				<input type="text" id="donacion" name="donacion" value=""/>
	  			</td>
	  		</tr>

	  		<tr>
	  			<td>Cuidad:
	  				<input type="text" id="ciudad" name="cuidad" value=""/>
	  			</td>	
	  			<td>ISBN:
	  				<input type="text" id="isbn" name="isbn" value=""/>
	  			</td>
	  			<td>Anio:
	  				<input type="text" id="anio" name="anio" value=""/>
	  			</td>

	  		</tr>

	  		<tr>
	  			<td>Pa&iacute;s:
	  				<input type="text" id="pais" name="pais" value=""/>
	  			</td>

	  		</tr>





	  	</table>
	  </form>	
  	<input type="submit" value="Guardar">	

 </BODY>
</HTML>