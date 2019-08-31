<!doctype html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/login.css">
</head>
<body  >
	<div  class="cabecera"  ><img src="img/logo2.png" width="32" height="32" align="left" /> Acceso al Sistema <img src="img/LOGO.png" height="32" width="32" align="right" /> </div>
	<div id="login">
		<form action="autenticar.php" method="POST">
			<fieldset>
				<p><label for="usuario">usuario</label></p>
				<p><input type="usuario" id="usuario" name="usuario" value="nombre_usuario" onBlur="if(this.value=='')this.value='nombre_usuario'" onFocus="if(this.value=='nombre_usuario')this.value=''"></p> 
				<p><label for="password">Password</label></p>
				<p><input type="password" id="password" name="password" value="password" onBlur="if(this.value=='')this.value='password'" onFocus="if(this.value=='password')this.value=''"></p> 
				<p><input type="submit" value="Acceder"></p>
			</fieldset>
		</form>
	</div> <!-- end login -->
	<div id="footer"></div>
</body>	
</html>
