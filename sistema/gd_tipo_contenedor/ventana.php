<?php 
$evento=$_POST["evento_contenido"];
$item=$_POST["item_contenido"];
?>
<script type="text/javascript">

	
</script>
<style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
</style>
 <form id="form_windows" name="form_windows">
		<input type="hidden" id="opcion_windows" name="opcion_windows" value=""/>
		<input type="hidden" id="accion_windows" name="accion_windows" value=""/>
        <input type="hidden" id="evento_windows" name="evento_windows" value="<?php echo $evento;?>"/>
        <input type="hidden" id="item_windows" name="item_windows" value="<?php echo $item;?>"/>
<input  type="hidden" id="alto_windows" name="alto_windows" value="300"/>
<input  type="hidden" id="ancho_windows" name="ancho_windows" value="500"/>
	<div align="left" id="encabezad" >
		<div id="toolbar" class="datagrid-toolbar" style=" position:relative; top:-10px; left:-10px;  ">
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="guardar()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Guardar</span>
			<span class="l-btn-icon guardar"> </span>
			</span>
			</a>
		</div>
	</div>
	<div id="datos" >	
	
	</div> 
</form>


