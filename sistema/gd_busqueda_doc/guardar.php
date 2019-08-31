<?php
if(ValidaUsuario()==false){echo "<script>mensaje('Por favor inicie sesion');</script>"; return false;}
$modulo=$_POST["opcion_contenido"];
$item=$_POST["item_anexo"];
		unset($campos);
		$campos[0]="modulo=".$modulo;
		$campos[1]="gd_usuario=secion";
		$campos[2]="codigo_docu=codigo_docu";
		$campos[3]="codigo=".$_POST["codigo_anexo".$item];
		$sql="select * from ".f_genera_parametros_v("gd_reg_registro_consulta",$campos);
		//echo $sql;
		$res=pg_query($conn,$sql);
		//if(!){echo "Error"; return false;}
		$reg=pg_fetch_array($res);
		echo "";
/////////////////////////////////////////********************************************///////////////////////////////////////////
?>