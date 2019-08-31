

 <?php 
	if($_GET["op"]=="zona"){//cuando se selcciona parroquia
	$zona=$_POST["zona"];
	if($_GET["hijo"]=="distrito"){//llenamos sector?>
		<select name="distrito" id="distrito" style="width:90%" size="1" onchange="carga_combo('distrito',new Array('unidad_operativa'))">
			<option value="-1">-- Seleccione Distrito ---</option>
			<?php $sql="select codigo,nombre from gd_distrito where zona='".$zona."' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?> <option 	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
			<?php } ?>
		</select> 
<?php 	} //fin de if($_GET["hijo"]=="distrito")
	if($_GET["hijo"]=="unidad_operativa"){//llenamos sector?>
		<select name="unidad_operativa" id="unidad_operativa" style="width:90%" size="1">
			<option value="-1">-- Seleccione Unidad operativa ---</option>
		</select> 
<?php 	} //fin de if($_GET["hijo"]=="distrito")
	}//fin de if($_GET["op"]=="zona")
	if($_GET["op"]=="distrito"){//cuando se selcciona parroquia
	$zona=$_POST["zona"];
	$distrito=$_POST["distrito"];
	if($_GET["hijo"]=="unidad_operativa"){//llenamos sector?>
		<select name="unidad_operativa" id="unidad_operativa" style="width:90%" size="1">
			<option value="-1">-- Seleccione Unidad operativa ---</option>
			<?php $sql="select codigo,nombre from gd_unidad_operativa 
			where zona='".$zona."' and distrito='".$distrito."' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?> <option 	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
			<?php } ?>
		</select> 
<?php 	} //fin de if($_GET["hijo"]=="distrito")
	
	}
?> 
