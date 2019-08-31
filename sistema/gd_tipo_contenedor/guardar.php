<?php
//require_once("../../conexion.php");
try {
if(ValidaUsuario()==false){echo "<script>mensaje('Por favor inicie sesion');</script>"; return false;}
if(f_valida_acceso_rol('gd_tipo_contenedor',$conn)==false){
	echo "<script type=''> mensaje('El usuario no tiene privilegios suficientes...');</script>"; return false;
}
	$modulo=$_POST["opcion_contenido"];
	unset($campos);
		$campos[0]="codigo";
		$campos[1]="codigo2";
		$campos[2]="nombre";
		$campos[3]="imagen";
		$campos[4]="hijos";
		$campos[5]="borrable";
		$campos[6]="tipo_empresa";
		$campos[7]="empresa_padre";

	if(f_valida_objetos($campos)==false){
		$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
		echo "<script>mensaje('".$msg."');</script>";
		return false;
	}
	if ($_POST["codigo2"]==''){$msg_error="Ingrese el codigo.<br>";}
	if ($_POST["nombre"]==''){$msg_error=$msg_error."Ingrese el Nombre.<br>";}
	if ($_POST["imagen"]==''){$msg_error=$msg_error."Ingrese Imagen.<br>";}
	//if ($_POST["nomenclatura"]==''){$msg_error=$msg_error."Ingrese La Abreviatura.<br>";}
	//if ($_POST["hijos"]==''){$msg_error=$msg_error."Ingrese los hijos.<br>";}
	
	if($msg_error==""){
	//echo f_genera_parametros("reg_persona",$campos,$valores,14);
		unset($campos);
			$campos[0]="codigo=codigo";
			$campos[1]="modulo=".$modulo;
    		$campos[2]="gd_usuario=secion";
			$campos[3]="codigo2=codigo2";
			$campos[4]="nombre=nombre";
			$campos[5]="imagen=imagen";
			$campos[6]="nivel=0";
			$campos[7]="hijos=hijos";
			$campos[8]="borrable=borrable";
    		$campos[9]="tipo_empresa=tipo_empresa";
    		$campos[10]="empresa_padre=empresa_padre";
    
			$sql="select * from ".f_genera_parametros_v("sis_reg_tipo_contendor",$campos);
    		//echo $sql;
			$res=pg_query($conn,$sql);
			$reg=pg_fetch_array($res);
    		$cerrar_ventana="";
    		//$cerrar_ventana="$('#principal_windows').window('close');";
			if($reg["res"]=='NUEVO'){$msg="Registro Ingresado Correctammente";}
			if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
			if($reg["res"]=='ERROR'){$cerrar_ventana="";$msg="Error : ".$reg["cod"];}                     
			echo "<script>".$cerrar_ventana."mensaje('".$msg."');MuestraDatos_contenido();</script>";
		}else{
			$msg="Para continuar realice lo siguiente:<br>".$msg_error;
			echo "<script>mensaje('".$msg."');</script>";
		}//FIN if($msg_error==""){
} catch (Exception $e) {
    $msg=$e->getMessage();
	echo "<script>mensaje('".$msg."');</script>";
}


?>