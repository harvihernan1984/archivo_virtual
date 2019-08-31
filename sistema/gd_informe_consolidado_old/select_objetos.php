<?php 	
	if($_GET["op"]=="bodega"){//cuando se selcciona parroquia
	$zona=$_POST["zona"];
	$distrito=$_POST["distrito"];
	$unidad_operativa=$_POST["unidad_operativa"];
	$bodega=$_POST["bodega"];
 		if($_GET["hijo"]=="cajas"){//llenamos unidad_operativa
				include("listado_cajas.php");
		 	} //fin de if($_GET["hijo"]=="cajas")
		if($_GET["hijo"]=="limpiar"){//llenamos unidad_operativa
				echo"<script>limpia_form(new Array('div=folder','div=documentos'));limpia_titulos();</script>";
		} //fin de if($_GET["hijo"]=="limpiar")
	}//fin de if($_GET["op"]=="distrito")
	if($_GET["op"]=="cajas"){//cuando se selcciona parroquia
		$zona=$_POST["zona"];
		$distrito=$_POST["distrito"];
		$unidad_operativa=$_POST["unidad_operativa"];
		$bodega=$_POST["bodega"];
		$caja=$_POST["caja_act"];
		if($_GET["hijo"]=="folder"){ 
		include("listado_folder.php");
			} //fin de if($_GET["folder"]=="cajas")
		if($_GET["hijo"]=="documentos"){  echo "<script>$('#folder_act').attr('value','');$('#txt_documentos').html('DOCUMENTOS');</script>";	} //fin de if($_GET["hijo"]=="documentos")
	} // FIN if($_GET["op"]=="cajas"){
	if($_GET["op"]=="folder"){//cuando se selcciona parroquia
		$zona=$_POST["zona"];
		$distrito=$_POST["distrito"];
		$unidad_operativa=$_POST["unidad_operativa"];
		$bodega=$_POST["bodega"];
		$caja=$_POST["caja_act"];
		if($_GET["hijo"]=="documentos"){
			include("listado_documentos.php");
		} //	fin  if($_GET["hijo"]=="documentos"){
 	} //FIN 	if($_GET["op"]=="folder"){//cuando se selcciona parroquia
?> 