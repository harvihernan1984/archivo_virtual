<?php
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
//consulta todos los empleados
$op_busca=$_POST["op_filtro_busca"];
if($op_busca=='persona'){include('buscar_persona.php');}
if($op_busca=='directorio'){include('buscar_directorio.php');}
?>
