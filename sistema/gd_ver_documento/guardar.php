<?php
//require_once("conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}
if(!isset($_GET["op"])){//se guardan los datos del documento
	//extraer los datos de los atributos
	//sabemos que la cantidad de atributos esta almacenada en num_atributos	
	$num_at=$_POST["num_atributos"];
	$val_datos=""; //aqui alamcenaremos los datos en el formato atributo;valor|atributo;valor|atributo;valor
	$coma="";
	$msg_error="";
	$msg_br="";
	for($i=1;$i<=$num_at;$i++){
		if($_POST["tdato".$i]=='FE'){$dato_valor=$_POST["fecha_val".$i];}
		else{$dato_valor=$_POST["valor".$i];}
		if($dato_valor==''){
				if($_POST["tforzar".$i]=='S'){ $msg_error=$msg_error.$msg_br.$_POST["tnombre".$i]; $msg_br="<br>"; }
		}
		else{
			if($_POST["tdato".$i]=='FE'){
				if(f_valida_fecha_formato($dato_valor)!=''){ 
					$msg_error=$msg_error.$msg_br.$_POST["tnombre".$i]." Fecha invalida".f_valida_fecha_formato($dato_valor); $msg_br="<br>"; 
				}
			}
		}
		$val_datos=$val_datos.$barra.$_POST["objeto".$i].";".$dato_valor;
		$barra="|";
	}
	if($msg_error!=""){
			$msg_error="Para continuar ingrese los siguientes campos:<br>".$msg_error;
			$msg="<script>mensaje('".$msg_error."');</script>";	
			echo $msg;
			return false;		
	}
	else{
		unset($campos);
		$campos[0]="codigo_docu=codigo_docu";
		$campos[1]="gd_usuario=secion";
		$campos[2]="gd_empresa_act=secion";
		$campos[3]="contenedor=contenedor";
		$campos[4]="tipo_doc=tipo_doc";
		$campos[5]="estado=A";
		$campos[6]="datos=".$val_datos;
		$sql="select * from ".f_genera_parametros_v("gd_reg_documento",$campos);
		//echo $sql;
		$res=pg_query($conn,$sql);
		//if(!){echo "Error"; return false;}
		$reg=pg_fetch_array($res);
		$nuevo_codigo="";
		$msg=$reg["res"];
		if($reg["res"]=='NUEVO'){
			$msg="Registro Ingresado Correctammente";
			$nuevo_codigo="editar_contenido('gd_documento','".$reg["cod"]."')";
		}
		if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
		echo "<script>mensaje('".$msg."');RefrescaDatos_contenido();".$nuevo_codigo."</script>";

	}
}else{ //if(!isset($_GET["op"])){
		$item=$_POST["item_anexo"];
		$accion=$_GET["op"];
		$documento=$_POST["codigo_docu"];
		unset($campos);
		
		$campos[0]="codigo=".$_POST["codigo_doc".$item];
		$campos[1]="gd_usuario=secion";
		$campos[2]="gd_empresa_act=secion";
		$campos[3]="codigo_docu=codigo_docu";
		$campos[4]="accion=".$accion;
		$campos[5]="dir=";
		$campos[6]="nombre_doc=";
		$campos[7]="referencia=".$_POST["referencia_doc".$item];
		$sql="select * from ".f_genera_parametros_v("gd_reg_anexo_documento",$campos);
		$res=pg_query($conn,$sql);
		//$msg=$sql;
		$reg=pg_fetch_array($res);
		$nuevo_codigo="";
		$msg=$reg["res"].$sql;
		if($reg["res"]=='ok'){
			$msg="Registro actualizado Correctammente";
		}
		if($reg["res"]=='ok'){$msg="Registro actualizado Correctammente";}
		echo "<script>mensaje('".$msg."');editar_contenido('gd_documento','".$documento."')</script>";
}//FIN if(!isset($_GET["op"])){ 

?>