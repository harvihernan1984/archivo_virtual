

 <?php 
	if($_GET["op"]=="empresa"){//cuando se selcciona parroquia
	$empresa=$_POST["empresa"];
	if($_GET["hijo"]=="area"){//llenamos sector?>
		<select name="area" id="area" style="width:230px" size="1">
			<option value="-1">-- Seleccione Area ---</option>
			<?php $sql="select codigo,nombre from atf_area where padre<>'-1' and empresa='".$empresa."' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?> <option value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
			<?php } ?>
		</select> 
<?php 	} //fin de if($_GET["hijo"]=="sector")
	}//fin de if($_GET["op"]=="zona")
?> 