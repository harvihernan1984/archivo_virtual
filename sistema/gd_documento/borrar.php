<?php
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}
	unset($campos);
	$campos[0]="item_contenido=item_contenido";
	$campos[1]="gd_usuario=secion";
	$campos[2]="gd_empresa_act=secion";
	$campos[3]="txt_padre=txt_padre";
	$sql="select * from ".f_genera_parametros_v("gd_borra_documento",$campos);
	$res=pg_query($conn,$sql);
	//if(!){echo "Error"; return false;}
	$reg=pg_fetch_array($res);
	if($reg["res"]=='ok'){$msg="Registro Borrado Exitozamente....";echo "<script>mensaje('".$msg."');RefrescaDatos_contenido();</script>";}
	else{$msg=$reg["res"];echo "<script>mensaje('".$msg."');</script>";}


?>