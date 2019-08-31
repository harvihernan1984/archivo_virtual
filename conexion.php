<?php
session_start();
function randomText($length) {
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    for($i=0;$i<$length;$i++) {
      $key .= $pattern{rand(0,35)};
    }
    return $key;
}

$_SESSION["secureKey"] = randomText(6);
date_default_timezone_set("America/Guayaquil");
$directorio="../archivo_virtual";
$directorio2="archivo_virtual";
$conn = pg_connect("host=localhost port=5432 dbname=TU_DB user=TU_USUARIO password=LA_CLAVE");
function chao_tilde($entra)
{
$traduce=array( 'Á' => '&aacute;' , 'É' => '&eacute;' , 'Í' => '&iacute;' , 'Ó' => '&oacute;' , 'Ú' => '&uacute;' , 'ñ' => '&ntilde;' , 'Ñ' => '&Ntilde;' , 'Ã¯Â¿Â½' => '&auml;' , 'Ã¯Â¿Â½' => '&euml;' , 'Ã¯Â¿Â½' => '&iuml;' , 'Ã¯Â¿Â½' => '&ouml;' , 'Ã¯Â¿Â½' => '&uuml;');
$sale=strtr( $entra , $traduce );
return $sale;
}
function truncateFloat($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($number, $digitos,'.','');

}
function truncar($number, $digitos)
{    return number_format($number, $digitos,'.','');}  
function getHora()
{   $resul="";
	$hora = getdate(time());
	if($hora["hours"]<10){$resul="0".$hora["hours"].":";}else{$resul=$hora["hours"].":";}
	if($hora["minutes"]<10){$resul=$resul."0".$hora["minutes"].":";}else{$resul=$resul.$hora["minutes"].":";}
	if($hora["seconds"]<10){$resul=$resul."0".$hora["seconds"];}else{$resul=$resul.$hora["seconds"];}
	//return $hora[0] ;
	//return date("r");
	return $resul;
}
function ValidaUsuario()
{	if($_SESSION["gd_autenticado"]!="SI"){return false;}
	else{return true;}
}
function f_concatena($campos){
	$cadena="";
	$coma="";
	for($i=0;$i<count($campos);$i++){$cadena=$cadena.$coma.$campos[$i]; $coma=" || ";}
	return $cadena;
}

function f_valida_fecha_formato($fecha){
	// 00/00/0000 len =10 
	
	if(strlen($fecha)==10){
		if(!is_numeric(substr($fecha, 0, 2))){return ' Formato Invalido dd';}
		if(!is_numeric(substr($fecha, 3, 2))){return ' Formato Invalido mm';}
		if(!is_numeric(substr($fecha, 6, 4))){return ' Formato Invalido yyyy';}
		if(substr($fecha, 2, 1)!='/'){return ' Formato Invalido /1';}
		if(substr($fecha, 5, 1)!='/'){return ' Formato Invalido /2';}
		$ndia=intval(substr($fecha, 0, 2));
		if($ndia<1 or $ndia>31){return ' Dias invalidos';}	
		$nmes=intval(substr($fecha, 3, 2));
		if($nmes<1 or $nmes>12){return ' Mes invalidos';}	
		if($nmes==4 or $nmes==6 or $nmes==9 or $nmes==11){if($ndia>30){return ' Dias invalidos x mes';}}
		$nano=intval(substr($fecha, 6, 4));
		if($nmes==2){
			if($ndia>29){return ' Dias invalidos x mes';}
			if($ndia==29 and $nano%4 !=0){return ' Dias invalidos x bisiesto';}
		}
		return '';
	}
	else{ return strlen($fecha).'fl';}
}
function f_validateDateEs($date)
{
    $pattern="/^(0?[1-9]|[12][0-9]|3[01])[\/|-](0?[1-9]|[1][012])[\/|-]((19|20)?[0-9]{2})$/";
    if(preg_match($pattern,$date))
    {   $values=preg_split("[\/|-]",$date);
        if(checkdate($values[1],$values[0],$values[2]))
            return true;
    }
    return false;
}
function f_genera_parametros($tabla,$campos,$valores,$n_campos){
	$cadena=$tabla."(";
	$coma="";
	for($i=0;$i<$n_campos;$i++){
		if($campos[$i]==$valores[$i]){//se trata de un objeto por post
			$cadena=$cadena.$coma."'".utf8_encode(f_sin_sql($_POST[$campos[$i]]))."'";		
			$coma=",";
		}elseif($valores[$i]=="secion"){//se trara de un objeto de secion
			$cadena=$cadena.$coma."'".utf8_encode($_SESSION[$campos[$i]])."'";		
			$coma=",";
		}elseif($valores[$i]=="chk"){//se trara de un objeto checkbox
			if(isset($_POST[$campos[$i]])){$cadena=$cadena.$coma."'".$_POST[$campos[$i]]."'";}
			else{$cadena=$cadena.$coma."'0'";}
			$coma=",";
		}else{//se trata de un valor defido el sistema
				$cadena=$cadena.$coma."'".$valores[$i]."'";		
				$coma=",";
		}
		
	}
	$cadena=$cadena.")";
	return $cadena;
}
function f_genera_parametros_v($tabla,$datos){
	$cadena=$tabla."(";
	$coma="";
	
	for($i=0;$i<count($datos);$i++){
		$campos=explode("=",$datos[$i]);
		$campo=$campos[0];
		$valor=$campos[1];
		if($campo==$valor){//se trata de un objeto por post
			$cadena=$cadena.$coma."'".utf8_encode(f_sin_sql($_POST[$campo]))."'";		
			$coma=",";
		}elseif($valor=="secion"){//se trara de un objeto de secion
			$cadena=$cadena.$coma."'".$_SESSION[$campo]."'";		
			$coma=",";
		}elseif($valor=="chk"){//se trara de un objeto checkbox
			if(isset($_POST[$campo])){$cadena=$cadena.$coma."'".$_POST[$campo]."'";}
			else{$cadena=$cadena.$coma."'0'";}
			$coma=",";
		}else{//se trata de un valor defido el sistema
				$cadena=$cadena.$coma."'".$valor."'";		
				$coma=",";
		}
		
	}//fin for($i=0;$i<$n_campos;$i++){
	$cadena=$cadena.")";
	return $cadena;
}
function f_genera_parametros_conid($tabla,$campos,$valores,$n_campos,$id){
	$cadena=$tabla."(";
	$coma="";
	for($i=0;$i<$n_campos;$i++){
		if($campos[$i]==$valores[$i]){//se trata de un objeto por post
			$cadena=$cadena.$coma."'".utf8_encode(f_sin_sql($_POST[$campos[$i].$id]))."'";		
			$coma=",";
		}elseif($valores[$i]=="secion"){//se trara de un objeto de secion
			$cadena=$cadena.$coma."'".$_SESSION[$campos[$i]]."'";		
			$coma=",";
		}elseif($valores[$i]=="chk"){//se trara de un objeto checkbox
			if(isset($_POST[$campos[$i]])){$cadena=$cadena.$coma."'".$_POST[$campos[$i].$id]."'";}
			else{$cadena=$cadena.$coma."'0'";}
			$coma=",";
		}else{//se trata de un valor defido el sistema
				$cadena=$cadena.$coma."'".$valores[$i]."'";		
				$coma=",";
		}
		
	}
	$cadena=$cadena.")";
	return $cadena;
}
function f_genera_filtro($direc,$codigo,$where,$campo=" codigo "){
$filtro="";
//calcelar o buscado
if($codigo==""){if($direc=="2"){$direc="1";}if($direc=="3"){$direc="1";}}
if($direc=="0"){if($codigo==""){$direc="1";}  $filtro= $where." cast(".$campo." as integer)=".$codigo." order by cast(".$campo." as integer) LIMIT 1";}
//primero
if($direc=="1"){$filtro= " order by cast(".$campo." as integer) LIMIT 1";}
//anterior
if($direc=="2"){$filtro= $where." cast(".$campo." as integer)<".$codigo." order by cast(".$campo." as integer) desc LIMIT 1";}
//siguiente
if($direc=="3"){$filtro= $where." cast(".$campo." as integer)>".$codigo." order by cast(".$campo." as integer)  LIMIT 1";}
//ultimo
if($direc=="4"){$filtro= " order by cast(".$campo." as integer) desc LIMIT 1";}

return $filtro;
}
function f_sin_acento($texto){
$buscar  = array("Ã¡","Ã ","Ã¨", "Ã©","Ã­","Ã¬","Ã³","Ã²","Ãº","Ã¹","Ã","Ã€","Ã‰","Ãˆ","Ã","ÃŒ","Ã“","Ã’","Ãš","Ã™");
$reemplazar = array("a","a","e","e","i","i","o","o","u","u","A","A","E","E","I","I","O","O","U","U");
$resul=str_replace($buscar,$reemplazar,$texto);
return $resul;
}
function f_sin_sql($texto){
	$buscar  = array("'", " insert ", " delete ", " update ", " select "," into ", " or ","'", " drop ");
	$reemplazar = array(" ", " ", " ", " ", " "," "," "," "," ");
	$resul=str_ireplace($buscar,$reemplazar,$texto);
	return $resul;
}
function numeroPaginasPdf($archivoPDF){
	$stream = fopen($archivoPDF, "r");
	$content = fread ($stream, filesize($archivoPDF));
	if(!$stream || !$content)
		return 0;
	$count = 0;
	$regex  = "/\/Count\s+(\d+)/";
	$regex2 = "/\/Page\W*(\d+)/";
	$regex3 = "/\/N\s+(\d+)/";
	if(preg_match_all($regex, $content, $matches))
		$count = max($matches);
	return $count[0];
}
function f_valida_cedula($ced){
	$numero=$ced;
	if(strlen($numero)!=10){return false;}//la cadena not tiene 10 digitos
	if(!is_numeric($numero)){return false;} //los datos no son numericos
	$impares=0;
    $pares=0;
    $ultimo_digito=intval($numero[9]);
    $digito_validador=0;
    $suma_total=0;
	for ($i = 0; $i <= 8; $i++) {
    		if(is_int(intval($numero[$i]))==false){return false;} // un digito no es numero int
    		if( $i == 0 || $i == 2 || $i== 4 || $i == 6 || $i == 8 ){ //son todos los impares	
        		$d=intval($numero[$i]);
            	$d=$d*2;
            	if($d>9){$d=$d - 9;}
            	$impares=$impares + $d;
            
			}else{//todos los pares
         	   $pares=$pares + intval($numero[$i]);
            }//FIN else
    }
	$suma_total=$impares + $pares;
    while ($suma_total > 0) {
    		$suma_total=$suma_total - 10;
	}
	$digito_validador=abs($suma_total);
    if($digito_validador!=$ultimo_digito){return false;}
    return true;
}
function f_valida_cedula_ruc($ced,$tp){
	//var ced=$("#"+obj).val();
	$numero=$ced;
    if($tp=='PN'){if(strlen($numero)!=13 && strlen($numero)!=10){return false;}}//personas naturales
    if($tp=='PJ'){if(strlen($numero)!=13){return false;}}//personas juridicas
    if($tp=='PP'){if(strlen($numero)!=13){return false;}}//Sector publico
    if($tp=='PN'){	$multiplicador="2,1,2,1,2,1,2,1,2"; $veri=10; $divi=10;}//personas naturales
    if($tp=='PJ'){	$multiplicador="4,3,2,7,6,5,4,3,2"; $veri=10; $divi=11;}//personas juridicas
    if($tp=='PP'){	$multiplicador="3,2,7,6,5,4,3,2,0"; $veri=9; $divi=11;}//Sector publico
	$multi=$campos=explode(",",$multiplicador);
    $ultimo_digito=intval($numero[($veri - 1)]);
    $suma_total=0;
    
    if(!is_numeric($numero)){return false;}//el dato no es numerico	
    for($i=0;$i<($veri-1);$i++){
    	$d= intval($numero[$i]) *  intval($multi[$i]);
        if($tp=='PN'){if($d>9){$d=$d-9;}}
        $suma_total=$suma_total + $d;
    }
	$verificador= $suma_total % $divi;
	if ($verificador!=0){ $verificador=$divi - $verificador;}
    //$verificador = $divi - $verificador;
    if($verificador!=$ultimo_digito){return false;}
    return true;
}
function f_valida_objetos($objs){
	for($i=0;$i<count($objs);$i++){
		if(isset($_POST[$objs[$i]])==false){return false;}
	}//fin for($i=0;$i<$n_campos;$i++){
	return true;
}
function f_valida_acceso_rol($tabla, $conec){
	$sql_1="select * from sis_accesos_rol_usuario('".$_SESSION["gd_usuario"]."','".$tabla."','')";
	$res_1=pg_query($conec,$sql_1);
	//if(!){echo "Error"; return false;}
	$reg_1=pg_fetch_array($res_1);
	if($reg_1["res"]=='NO'){return false;}
    return true;
}
?>
