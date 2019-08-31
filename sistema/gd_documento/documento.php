<?php session_start(); 
require_once("../../conexion.php");
$empresa=$_GET["empresa"] ;
$codigo=$_GET["codigo"] ;
$documento=$_GET["documento"] ;
$error=$_GET["error"] ;
$msg="";
if($error!=""){
	$msg="<script>window.parent.mensaje('".$error."');</script>";
}
$max_size=20; // por defecto se aceptan archivos de hasta 20 MB
$tp_ext=".png,.pdf,.jpg,.zip"; // son las extenciones admitidas por defecto
$sql="select (select valor from sis_configuracion where codigo='MAX_SIZE' and tipo='CONF') as max_size,
	(select valor from sis_configuracion where codigo='FORMAT_FILE' and tipo='CONF') as tp_ext;";
$res=pg_query($conn,$sql);
if($reg=pg_fetch_array($res)){
	$max_size=$reg["max_size"];
	$tp_ext=$reg["tp_ext"];
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
	if($codigo!=''){echo "<script>window.parent.editar_contenido('gd_documento','".$documento."');</script>";}
}
$img="pdf.png";$funcion="mostrar";
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
    	var archi=document.getElementById("imagen").value;
    	if(archi==''){
        	window.parent.mensaje('No se ha seleccionado ningun archivo valido...');
        	return false;
        }
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
		window.parent.mensaje(txt);
	}
	function ver_doc_select(){
    	var doc=document.getElementById('doc_select');
    	if(ValidateSize()==true){
        	if(valida_extencion()==true){doc.style.visibility='visible';}
        	else{doc.style.visibility='hidden';}
        }
    	else{doc.style.visibility='hidden'; }
	}
	function RefrescaDatos_contenido(){
		var doc=document.getElementById('doc_select');
		doc.style.visibility='visible';
	}
	function ValidateSize() { 
        var FileSize = document.getElementById('imagen').files[0].size / 1024 / 1024; // in MB
    	var result=Math.round(FileSize*100)/100;
    	var max_size=<?php echo $max_size;?>;
        if (result > max_size ) {
            //alert('File size exceeds 2 MB');
        	window.parent.mensaje('El archivo tiene un tama&ntilde;o de '+ result+'MB superior a los '+max_size+'MB que estan permitidos.');
        	document.getElementById("imagen").value='';
            return false;
        	// $(file).val(''); //for clearing with Jquery
        } else {return true;}
    }
	function valida_extencion() {
    	var x = document.getElementById("imagen").value;
    	x=x.slice((x.lastIndexOf(".") -2 >>> 0) + 2);
    	var extenciones = "<?php echo $tp_ext;?>";
    	ext=extenciones.split(",");
    	for(i=0; i < ext.length ; i++){
    		if(ext[i]==x){return true;}
    	}
    	window.parent.mensaje('El archivo tiene una extencion '+x+' la cual no es admitida.');
    	document.getElementById("imagen").value='';
    	return false;
    //document.getElementById("myFile").value='';
	}
</script>
<script>
$(document).keypress(function(e) {
 	if(e.which==39){return false;} //anulamos apostrofe
	 //if(e.which==47){return false;} //anulamos eslas /
	 if(e.which==92){return false;} //anulamos eslas \
})

</script>
<?php 
if($error!=""){
	echo "<script>window.parent.mensaje('".$error."');</script>";
}
?>
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
<style>
.divgrid{ width:99%; height:99%; overflow:auto;}
.divgrid table{
	 border:#CCCCCC dotted 1px;
}
.divgrid table input{
	 height:18px; font-size:9px; border:#999999 solid 1px;
}
.divgrid table select{
	 border:none; height:24px; font-size:9px; width:99%;
}
.divgrid  table  tbody > tr > td{
border-bottom:#CCCCCC dotted 1px;
border-right:#CCCCCC dotted 1px;
font-size:9px;
height:20px;
}
.divgrid table thead > tr > th{ 
border-bottom:#CCCCCC dotted 1px;
border-right:#CCCCCC dotted 1px;
font-size:9px;
height:20px;
background:#999999;
}
.divgrid table tbody > tr:hover {
background:#CDCDCD;
}
</style>
</head>
<body  >
<div id="principal"  class="EstilofondoTransparente"  style="z-index:80;" > </div>
<div class="divgrid">
<form id="miform" name="miform" action="guardar_doc.php" method="post" accept-charset='utf-8'  enctype='multipart/form-data' style="z-index:1;" >
<input type="hidden" name="dir_image" id="dir_image" value="<?php echo $ext;?>"/>

<table id="tabla_doc" width="100%" style="z-index:10; top:-2px; left:-2px; position:relative;">
		<tr valign="top">
		  <td width="61" valign="middle">Referencia :</td>
	      <td  align="left">
		  <input id="referencia" name="referencia" style="width:98%"  value="<?php echo $referencia;?>"/>
		  <input type="hidden" id="empresa" name="empresa" value="<?php echo $empresa;?>" />
		  <input type="hidden" id="documento" name="documento" value="<?php echo $documento;?>" />
		  <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo;?>" />
		  <input type="hidden" id="nombre_doc" name="nombre_doc" value="<?php echo $nombre_doc;?>" />		  </td>
		   <td width="20" align="left">
		  <div  align="left" class="upload"  id="divimage"   
			<?php if($existe==true){echo "style='visibility:hidden;'";}?>  >
			<input type="hidden" name="MAX_FILE_SIZE" value="90009000" />
			<input id="imagen" type="file" accept="application/pdf, image/*" class="file" name="imagen" onchange="ver_doc_select();"  title="Buscar documento"
			onMouseOver="this.style.cursor='pointer';" onMouseOut="this.style.cursor='default';" >
			<img src='../../img/botones/buscar2.png' width='20px' height='20px' >		    </div>					  </td>
		  
		  <td width="24" height="60">
			<a id="cmd_nuevo_file"  href='javascript:void(0)'   title='Guardar' onClick="guardar_doc()" >
			<img  src='../../img/botones/guardar.png' width='20px' height='20px'></a>		   </td>
	      <td width="24" align="left">
		  <img id="doc_select" style='visibility:hidden;'  src='../../img/botones/listo.png' width='24px' height='24px' title="Documento Seleccionado">		  </td>
	      <td width="24" align="left">
		  <div id="barra" style="visibility:hidden;">	<img  src='../../img/botones/cargando.gif' width='24px' height='24px'></div>
		  </td>
		  
	</tr>
  </table>
</form>
</div>
</body>
</html>
