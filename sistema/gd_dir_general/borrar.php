<?php
	if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}
    unset($campos);
	$campos[0]="item_contenido=item_contenido";
	$campos[1]="gd_usuario=secion";
	$campos[2]="gd_empresa_act=codigo";
	$sql="select * from ".f_genera_parametros_v("gd_borra_contenedor",$campos);
	$res=pg_query($conn,$sql);
	$reg=pg_fetch_array($res);
	if($reg["res"]=='ok'){$msg="Registro Borrado Exitozamente....";echo "<script>mensaje('".$msg."');RefrescaDatos_contenido();</script>";}
	else{$msg=$reg["res"];echo "<script>mensaje('".$msg."');</script>";}

?>