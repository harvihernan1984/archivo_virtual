

 <?php 
	if($_GET["op"]=="zona"){//cuando se selcciona parroquia
	$zona=$_POST["zona"];
			if($_GET["hijo"]=="distrito"){//llenamos sector?>
				<select name="distrito" id="distrito" style="width:130px" size="1" onchange="carga_combo('distrito',new Array('unidad_operativa','limpiar'))">
					<option value="-1">-- Seleccione Distrito ---</option>
					<?php $sql="select codigo,nombre from gd_distrito where zona='".$zona."' order by nombre";
					$res=pg_query($conn,$sql);
					while ($reg=pg_fetch_array($res))
					{ ?> <option 	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
					<?php } ?>
				</select> 
		<?php 	} //fin de if($_GET["hijo"]=="distrito")
		if($_GET["hijo"]=="limpiar"){//llenamos unidad_operativa
				echo"<script>limpia_form(new Array('sel=unidad_operativa','sel=bodega','div=cajas','div=folder','div=documentos'));limpia_titulos();</script>";
		} //fin de if($_GET["hijo"]=="limpiar")
	}//fin de if($_GET["op"]=="zona")
	if($_GET["op"]=="distrito"){//cuando se selcciona parroquia
	$zona=$_POST["zona"];
	$distrito=$_POST["distrito"];
			if($_GET["hijo"]=="unidad_operativa"){//llenamos unidad_operativa?>
			<select name="unidad_operativa" id="unidad_operativa" style="width:250px" size="1" 
			onchange="carga_combo('unidad_operativa',new Array('bodega','limpiar'))">
				<option value="-1">-- Seleccione Unidad Operativa ---</option>
				<?php $sql="select codigo,nombre from gd_unidad_operativa where zona='".$zona."' and distrito='".$distrito."'  order by nombre";
				$res=pg_query($conn,$sql);
				while ($reg=pg_fetch_array($res))
				{ ?> <option 	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
				<?php } ?>
			</select> 
	<?php 	} //fin de if($_GET["hijo"]=="unidad_operativa")
		if($_GET["hijo"]=="limpiar"){//llenamos unidad_operativa
				echo"<script>limpia_form(new Array('sel=bodega','div=cajas','div=folder','div=documentos'));limpia_titulos();</script>";
		} //fin de if($_GET["hijo"]=="limpiar")
	}//fin de if($_GET["op"]=="distrito")
	if($_GET["op"]=="unidad_operativa"){//cuando se selcciona parroquia
	$zona=$_POST["zona"];
	$distrito=$_POST["distrito"];
	$unidad_operativa=$_POST["unidad_operativa"];
			if($_GET["hijo"]=="bodega"){//llenamos unidad_operativa?>
				<select name="bodega" id="bodega" style="width:180px" size="1" onchange="carga_combo('bodega',new Array('cajas','limpiar'))">
					<option value="-1">-- Seleccione Unidad Operativa ---</option>
					<?php $sql="select codigo,nombre from gd_bodega where zona='".$zona."' and distrito='".$distrito."' 
					and unidad_operativa='".$unidad_operativa."'  order by nombre";
					$res=pg_query($conn,$sql);
					while ($reg=pg_fetch_array($res))
					{ ?> <option 	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
					<?php } ?>
				</select> 
		<?php 	} //fin de if($_GET["hijo"]=="bodega")
		if($_GET["hijo"]=="limpiar"){//llenamos unidad_operativa
				echo"<script>limpia_form(new Array('div=cajas','div=folder','div=documentos'));limpia_titulos();</script>";
		} //fin de if($_GET["hijo"]=="limpiar")
	}//fin de if($_GET["op"]=="unidad_operativa")
?> 