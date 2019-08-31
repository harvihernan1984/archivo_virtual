

 <?php 
	if($_GET["op"]=="zona"){//cuando se selcciona parroquia
	$zona=$_POST["zona"];
	if($_GET["hijo"]=="distrito"){//llenamos sector?>
		<select name="distrito" id="distrito" style="width:230px" size="1">
			<option value="-1">-- Seleccione sector ---</option>
			<?php $sql="select codigo,nombre from distrito where zona='".$zona."' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?> <option 	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
			<?php } ?>
		</select> 
<?php 	} //fin de if($_GET["hijo"]=="sector")
	}//fin de if($_GET["op"]=="zona")
?> 