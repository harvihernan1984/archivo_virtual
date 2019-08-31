<?php
require_once("../../valida.php");
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> alert('Por favor inicie sesion');	window.location='../vacio.php';</script>"; return false;}
$carpeta="nombramientos";
?>
<html>
<head>
<title>

</title>
<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.6.min.js"></script>
<script type="text/javascript" src="../../js/jquery.ui.datepicker-es.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/ajax.js"></script>	
<script language="JavaScript" type="text/javascript" src="../../js/jquery.form.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/funciones.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/ajax.js"></script>	
<link href="../../css/HVestilo.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript">
    	
	function mostrar(id){
		MostrarConsulta('consulta.php?op=CC&codigo=' + id ,'datos' );
		document.getElementById("frm").style.visibility="visible";
	}
	
	function ocultar(){
		document.getElementById("principal").style.visibility="hidden";
		document.getElementById("frm").style.visibility="hidden";
	}
	function validar()
		{   var clave1=document.getElementById("clave").value;
			var clave2=document.getElementById("clave2").value;
  			if (clave1!= clave2) {
     			alert("Las claves no son iguales");
     			return false;
  				}
		
  		}
	function guardar_u(idFormulario){
		if(validar()!=false)
			{ $.ajax ({
					type: 'POST',
					async: false,
					data: $('#form').serialize(),
					url: 'guardar.php',
					success: function(data){
						if(data!="ok"){ alert(data); }
						else{alert("Datos registrados correctamente.");}
						window.location.reload();
					}

				});
			}
	}
</script>

<style type="text/css">
<!--
-->
</style>
</head>
<body style="overflow:auto;" onLoad="mostrar('<?php echo $_SESSION["usuario"]; ?>')">
<div id="principal"  class="fondoTransparente"  > 
</div>
<form  action='guardar.php'  method='post' name='form' id="form">
<div id="frm" class="center">
	<div id="encabezad" >
		<table class='tableestilo'>
			<tr>
				<td width="40" align='left'>
					<a href='javascript:void(0)' title='Guardar' onClick="guardar_u('form')">
					<img src='../../ima/guardar.png' width='36' height='33'  border='0'></a>				</td>
				<td width='365' align='right'>&nbsp;</td>
				<td width='67' align='right'>
				<a href='javascript:void(0)' title='Cerrar' onClick='ocultar()'>
				<img src='../../ima/boton_cerrar.gif' width='64' height='13'  border='0'></a>				</td>
			</tr>
		</table>
	</div>
	<div id="datos" >	</div> 
</div>
</form>
</body>
</html>