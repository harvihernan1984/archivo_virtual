<?php session_start(); 
require_once("../../conexion.php");
$empresa=$_GET["empresa"] ;
$codigo=$_GET["codigo"] ;
$documento=$_GET["documento"] ;
$error=$_GET["error"] ;
$msg="";
if($error!=""){
	$msg="<script>mensaje('".$error."2332');</script>";
}

//if(isset($_GET["error"])){ 
	//if($_GET["error"]='0'){ $msg="<script>window.parent.mensage('erro:Documento borrado correctamente')<script>";
		//if($_GET["error"]=='0'){$msg="<script>window.parent.mensage('erro: esta intentando subir un archivo de mas de 0MB.')<script>";}
		//if($_GET["error"]=='1'){$msg="<script>window.parent.mensage('erro: esta intentando subir un archivo de mas de 20MB.')<script>";}
		//if($_GET["error"]=='2'){$msg="<script>window.parent.mensage('erro: esta intentando subir un archivo de mas de 20MB.')<script>";}
	
	//}
//} 
$existe=false;
if(isset($_GET["codigo"])){//documento existe
	$sql="select * from gd_documento_anexo where codigo='".$codigo."' and documento='".$documento."' and empresa='".$empresa."'  ";
	echo $sql;
	if($res=pg_query($conn,$sql)){
		if($reg=pg_fetch_array($res)){
			$referencia=$reg["referencia_doc"];
			$dir=$reg["dir_fisica_documento"];
			$nombre=$reg["nombre_doc"];
			$ext='pdf';	
		}
	}
}
$img="no_image.png";
$funcion="dercagar";
switch (strtolower($ext)){
	case 'rar' : $img="winrar.png"; break;
	case 'zip' : $img="winrar.png";break;
	case 'pdf' : $img="pdf.png";$funcion="mostrar";break;
	case 'doc' : $img="word.png";$funcion="mostrar";break;
	case 'docx' : $img="word.png";$funcion="mostrar";break;
	case 'xls' : $img="excel.png";break;
	case 'xlsx' : $img="excel.png";break;
	case 'ppt' : $img="powerpoint.png";break;
	case 'pptx' : $img="powerpoint.png";break;
	case 'jpg' : $img="imagen2.png";$funcion="mostrar";break;
	case 'jpeg' : $img="imagen2.png";$funcion="mostrar";break;
	case 'png' : $img="imagen2.png";$funcion="mostrar";break;
	case 'bmp' : $img="imagen2.png";$funcion="mostrar";break;
	case 'txt' : $img="imagen2.png";$funcion="mostrar";break;

}
$href="javascript:void(0)";
$target="";
$funcion="descargar";
$onClick="";
if($dir!=''){
	$existe=true;
	$dire="/".$directorio2."/documentos/gestion_documental/".$nombre."";
	$href=$dire;
	$target="target='_blank'";
}
else{$img="no_image.png";$existe=false;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
<meta http-equiv="Content-Type"  content="text/html" charset="UTF-8" />
<script src="../../js/jquery-1.6.2.js"></script>
	<script src="../../js/jquery-1.4.2.min.js"></script>
<script>
	function guardar_doc(op){
		var prin=document.getElementById('principal');
		var proc=document.getElementById('barra');
		var txt_ref=document.getElementById('referencia').value;
		var codigo_docu=window.parent.get_cod_docu();
		if(codigo_docu!=''){	
				document.getElementById('documento').value=codigo_docu;
				if(txt_ref!=''){		
					if (prin!=null){
						prin.style.visibility='visible';
						proc.style.visibility='visible';
					}
					document.forms['miform'].submit();
				}
				else{window.parent.mensaje('Por Favor ingrese la referencia del Documento anexo...');}
		}
		else{window.parent.mensaje('Por Favor guarde el documento <br>Luego podra guardar el anexo...');}
	}
	function borrar_doc(op){
		if(op!=''){	window.parent.remover_doc(op);}
	}
	function mostrar(dir){
		window.parent.mostrar_doc(dir);
	}
	function mensaje(txt){
		window.parent.mensjge(txt);
	}
	function ver_doc_select(){
		var doc=document.getElementById('doc_select');
		doc.style.visibility='visible';
	}
	
</script>
<script>
$(document).keypress(function(e) {
 	if(e.which==39){return false;} //anulamos apostrofe
	 //if(e.which==47){return false;} //anulamos eslas /
	 if(e.which==92){return false;} //anulamos eslas \
})

</script>
<?php echo $msg;?>
<style>
div.upload {
   position: relative;
   width: 20px;
   height: 20px;
   overflow:hidden;
   border:#DDDDDD solid;
   border:none;
   background: #FFFFFF;
   clip:rect(0px, 140px, 30px, 0px );
}  
div.upload input {
   position: absolute;
   left: auto;
   right: 0px;
   top: 0px;
   margin:0;
   padding:0;
   filter: Alpha(Opacity=0);
   -moz-opacity: 0;
   opacity: 0;
}
.EstilofondoTransparente { /*Div que ocupa toda la pantalla*/
	position:fixed; top:0px; left:0px; width:500px;  height:300px; background-color:#666666; float:inherit;
	filter: alpha(opacity=80); opacity: .3; z-index:0; visibility:hidden;
}
</style>
</head>
<body  >
<div id="principal"  class="EstilofondoTransparente"  style="z-index:80;" > </div>
<form id="miform" name="miform" action="guardar_doc.php" method="post" accept-charset='utf-8'  enctype='multipart/form-data' style="z-index:1;" >
<input type="hidden" name="dir_image" id="dir_image" value="<?php echo $ext;?>"/>

<table id="tabla_doc" width="91%" style="z-index:10; top:-11px; position:relative;">
		<tr valign="top">
		  <td width="28" valign="top">
		  		<a id="cmd_descargar"  title='Ver o descargar documento' href="<?php echo $href;?>" <?php echo $target  ;?>>
				<img style=""  src='../../img/botones/<?php echo $img ?>' width='24px' height='24px' >				</a>		  </td>
		  <td width="24" height="60">
			<a id="cmd_nuevo_file"  href='javascript:void(0)'   title='Guardar' onClick="guardar_doc()" >
			<img  src='../../img/botones/guardar.png' width='20px' height='20px'></a>		   </td>
	      <td width="20" align="left">
		  <div  align="left" class="upload"  id="divimage"   
			<?php if($existe==true){echo "style='visibility:hidden;'";}?>  >
			<!--<input type="hidden" name="MAX_FILE_SIZE" value="9000000" />-->
			<input id="imagen" type="file" class="file" name="imagen" onchange="ver_doc_select();"  title="Buscar documento"
			onMouseOver="this.style.cursor='pointer';" onMouseOut="this.style.cursor='default';" >
			<img src='../../img/botones/buscar2.png' width='20px' height='20px' >		    </div>					  </td>
          <td width="755" align="left">
		  <input id="referencia" name="referencia" style="width:90%"  value="<?php echo $referencia;?>"/>
		  <input type="hidden" id="empresa" name="empresa" value="<?php echo $empresa;?>" />
		  <input type="hidden" id="documento" name="documento" value="<?php echo $documento;?>" />
		  <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo;?>" />
		  <input type="hidden" id="nombre_doc" name="nombre_doc" value="<?php echo $nombre_doc;?>" />		  </td>
	      <td width="24" align="left">
		  <img id="doc_select" style='visibility:hidden;'  src='../../img/botones/listo.png' width='24px' height='24px' title="Documento Seleccionado">		  </td>
	      <td width="21" align="left">
		  <div id="barra" style="visibility:hidden;">	<img  src='../../img/botones/cargando.gif' width='24px' height='24px'></div>
		  </td>
	</tr>
  </table>
</form>

</body>
</html>
