function soloInt(evt){
	//asignamos el valor de la tecla a keynum
	if(window.event){// IE
		keynum = evt.keyCode;
    	keychar=evt.keyCode;
	}else{
		keynum = evt.which;
		keychar=evt.keyCode;
	}
	//alert('keynum='+keynum+' keychar='+keychar)
	//comprobamos si se encuentra en el rango
	if((keynum>47 && keynum<58 )|| keynum==8 || (keychar==9 && keynum==0)  || keynum==37 || keynum==38 || keynum==39 || keynum==40){
		return true;
	}else{
		return false;
	}
}
function solofecha(evt){
	//asignamos el valor de la tecla a keynum
	if(window.event){// IE
		keynum = evt.keyCode;
    	keychar=evt.keyCode;
	}else{
		keynum = evt.which;
		keychar=evt.keyCode;
	}
	//alert('keynum='+keynum+' keychar='+keychar)
	//comprobamos si se encuentra en el rango
	if((keynum>=47 && keynum<58 )|| keynum==8 || (keychar==9 && keynum==0)  || keynum==37 || keynum==38 || keynum==39 || keynum==40){
		return true;
	}else{
		return false;
	}
}
function soloNombres(evt){
	//asignamos el valor de la tecla a keynum
	if(window.event){// IE
		keynum = evt.keyCode;
    	keychar=evt.keyCode;
	}else{
		keynum = evt.which;
		keychar=evt.keyCode;
	}
	//alert('keynum='+keynum+' keychar='+keychar)
	//comprobamos si se encuentra en el rango
	if(keynum>=47 && keynum<58 ){
		return false;
	}else{
		return true;
	}
}

function truncar2(valor){
	var result=Math.round(valor*100)/100;
	return result;
}
function soloDec(evt){
//asignamos el valor de la tecla a keynum
	if(window.event){// IE
		keynum = evt.keyCode;
	}else{
		keynum = evt.which;
		keychar=evt.keyCode;
	}
	//comprobamos si se encuentra en el rango
	if((keynum>47 && keynum<58 )|| keynum==8 || keynum==46 || (keychar==9 && keynum==0) || (keychar==46 && keynum==0) || keynum==37 || keynum==38 || keynum==39 || keynum==40){
	return true;
	}else{
		return false;
	}
}
function soloDecObj(evt,Object){
//asignamos el valor de la tecla a keynum
	if(window.event){// IE
	keynum = evt.keyCode;
	}else{
	keynum = evt.which;
	keychar=evt.keyCode;
	}
	if(keynum==110 || keynum==46){if(Object.value.indexOf(".")!=-1){return false;} } 
	//comprobamos si se encuentra en el rango
	if((keynum>47 && keynum<58 )|| keynum==8 || keynum==46 || (keychar==9 && keynum==0) || keynum==110 || (keychar==46 && keynum==0) || keynum==37 || keynum==38 || keynum==39 || keynum==40){
	return true;
	}else{
		return false;
	}
}
function u_case(obj){
	var texto =$("#"+obj).val().toUpperCase();
	$("#"+obj).val(texto);
}
function l_case(obj){
	var texto =$("#"+obj).val().toLowerCase();
	$("#"+obj).val(texto);
}
function imprinf(nombre)
	{  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( "<table align='center' width='1000'><tr align='center'><td align='center' height='70'></td><td align='center'>"+$("#"+nombre).html()+"</td></tr></table>" );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
	}
function ExportaInf(nombre)
	{  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write($("#"+nombre).html());
	  ventimp.document.close();
	  //ventimp.document.execCommand('saveAs');
	}

function imprSelec(nombre)
{
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  //var html="<table align='center' width='1181'><tr align='center'><td align='center'>"
  //ventimp.document.write( "<table align='center' width='1000'><tr align='center'><td align='center'>"+$("#"+nombre).html()+"</td></tr></table>" );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
}

	
function MaxLengthTextArea(Event, Object, MaxLen)
	{
    	return (Object.value.length <= MaxLen)||(Event.keyCode == 8 ||Event.keyCode==46||(Event.keyCode>=35&&Event.keyCode<=40))
	}	
function validarctrlv(e) {//valida crtl + V
  tecla = (document.all) ? e.keyCode : e.which;
  return  !(tecla==86 && e.ctrlKey);
}
jQuery.fn.maxlength = function(){
     
    $("textarea[@maxlength]").keypress(function(event){
        var key = event.which;
         
        //all keys including return.
        if(key >= 33 || key == 13) {
            var maxLength = $(this).attr("maxlength");
            var length = this.value.length;
            if(length >= maxLength) {
                 
                event.preventDefault();
            }
        }
    });
}
function eliminar2(id)
	{
		if (confirm("Realmente desea eliminar el registro?"))
		{
			window.location="borrar.php?codigo="+id ;
		}
	}
function eliminar(id){
	if (confirm("Realmente desea eliminar el registro?"))
		{	$.ajax({ 
				type: 'GET',
				async: false, 
				url: "borrar.php?codigo="+id,  
				success: function(data) { 
					var op=data.substring(0,2);
					var cod=data.substring(2,data.length); 
					if(op!="ok"){alert("Ocurrio un problema " + data);window.location.reload();}
					else{ 
						if(cod==0){alert("El registro no puede ser borrado....! \nMantiene relacion con otros registros de la base de Datos.");}
						else{window.location.reload();}
					}  
				}  
			});
		}
	}
		
function BuscaConEnter(evt){
		//asignamos el valor de la tecla a keynum
		if(window.event){// IE
			keynum = evt.keyCode;
		}else{
			keynum = evt.which;
			keychar=evt.keyCode;
		}
		//comprobamos si se encuentra en el rango
		if(keynum==13){
			filtrar();
		}//else{alert(keynum + " ; " + keychar);}
	}
function filtrar(){
		var b=document.getElementById("busca").value;
		//var rutaAbsoluta = self.location.href;        // http://asdas.asd/uno/dos/index.html
//		var posicionUltimaBarra = rutaAbsoluta.lastIndexOf("/");
//		var rutaRelativa = rutaAbsoluta.substring( posicionUltimaBarra + "/".length , rutaAbsoluta.length );       // index.html
//		var posicionprimerinter = rutaRelativa.indexOf("?");
//		if (posicionprimerinter!=0){var rutaRelativa = rutaRelativa.substring( posicionprimerinter , posicionprimerinter ); }
//		alert(rutaRelativa)
		window.location="?busca=" + b ;
	}
	
function muestra_img(tb,valor){
		obj = document.getElementById(tb);
		for (i=0; ele = obj.getElementsByTagName('img')[i]; i++)
				{ ele.style.visibility = valor;}
		}
function guardar(idFormulario){document.forms[idFormulario].submit();}

function imprimir(){
	document.getElementById('div_botones').style.visibility='hidden';
	muestra_img('tabla','hidden');
	window.print(); 
	setTimeout ("document.getElementById('div_botones').style.visibility='visible'", 2000);
	setTimeout ("muestra_img('tabla','visible')", 2000);
}

//funciones de movimiento de ventana
function carga()
{
	posicion=0;
	
	// IE
	if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
	// Otros
	else navegador=1;

	registraDivs();
}

function registraDivs()
{		for(i=0;i<=num_ven; i++){
		document.getElementById(scrollDivs[i]).onmouseover=function() { this.style.cursor="move"; }
		document.getElementById(scrollDivs[i]).onmousedown=comienzoMovimiento;
		}
		//if(num_ven==2){alert('entro');}
		//document.getElementById("frm_busqueda").onmouseover=function() { this.style.cursor="auto"; }
		//document.getElementById("frm_busqueda").onmousedown=comienzoMovimiento;
}

function evitaEventos(event)
{
	// Funcion que evita que se ejecuten eventos adicionales
	if(navegador==0)
	{
		window.event.cancelBubble=true;
		window.event.returnValue=false;
	}
	if(navegador==1) event.preventDefault();
}

function comienzoMovimiento(event)
{
	var id=$(this).parent('div').attr('id');
	//id="frm_busqueda";
	//alert (id);
	//id=frm;
	elMovimiento=document.getElementById(id);
	
	 // Obtengo la posicion del cursor
	 
	if(navegador==0)
	 {
	 	cursorComienzoX=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		cursorComienzoY=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	}
	if(navegador==1)
	{    
		cursorComienzoX=event.clientX+window.scrollX;
		cursorComienzoY=event.clientY+window.scrollY;
	}
	
	elMovimiento.onmousemove=enMovimiento;
	elMovimiento.onmouseup=finMovimiento;
	
	elComienzoX=parseInt(elMovimiento.style.left);
	elComienzoY=parseInt(elMovimiento.style.top);
	// Actualizo el posicion del elemento
	elMovimiento.style.zIndex=++posicion;
	
	evitaEventos(event);
}

function enMovimiento(event)
{  
	var xActual, yActual;
	if(navegador==0)
	{    
		xActual=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		yActual=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	}  
	if(navegador==1)
	{
		xActual=event.clientX+window.scrollX;
		yActual=event.clientY+window.scrollY;
	}
	
	elMovimiento.style.left=(elComienzoX+xActual-cursorComienzoX)+"px";
	elMovimiento.style.top=(elComienzoY+yActual-cursorComienzoY)+"px";

	evitaEventos(event);
}

function finMovimiento(event)
{
	elMovimiento.onmousemove=null;
	elMovimiento.onmouseup=null;
}
function cal_cedula(obj){
	var ced=$("#"+obj).val();
	if(ced.length==10){
    	var digitos = ced.split("");
    	var impares=0;
    	var pares=0;
    	var ultimo_digito=parseInt(digitos[9]);
    	var digito_validador=0;
    	var suma_total=0;
    	for (i = 0; i <= 8; i++) {
    		if( i == 0 || i == 2 || i== 4 || i == 6 || i == 8 ){ //son todos los impares	
        		var d=parseInt(digitos[i]);
            	d=d*2;
            	if(d>9){d=d - 9;}
            	impares=impares + d;
            
			}else{//todos los pares
         	   pares=pares + parseInt(digitos[i]);
            }//FIN else
        }
    	suma_total=impares + pares;
    	while (suma_total > 0) {
    		suma_total=suma_total - 10;
		}
    	digito_validador=Math.abs(suma_total);
    	if(digito_validador==ultimo_digito){$("#"+obj).removeClass("texto_invalido"); }
    	else{$("#"+obj).addClass("texto_invalido"); }
    }
	else{$("#"+obj).addClass("texto_invalido"); }
}
function cal_cedula_ruc(obj,tp){
	var ced=$("#"+obj).val();
    if(tp=='PN'){if(ced.length!=13 && ced.length!=10){$("#"+obj).addClass("texto_invalido");return false;}}//personas naturales
    if(tp=='PJ'){if(ced.length!=13){$("#"+obj).addClass("texto_invalido");return false;}}//personas juridicas
    if(tp=='PP'){if(ced.length!=13){$("#"+obj).addClass("texto_invalido");return false;}}//Sector publico
    if(tp=='PN'){var multiplicador="2,1,2,1,2,1,2,1,2";var veri=10; var divi=10;}//personas naturales
    if(tp=='PJ'){var multiplicador="4,3,2,7,6,5,4,3,2";var veri=10; var divi=11;}//personas juridicas
    if(tp=='PP'){var multiplicador="3,2,7,6,5,4,3,2,0";var veri=9; var divi=11;}//Sector publico
	var digitos = ced.split("");
    var multi=multiplicador.split(",");
    var ultimo_digito=parseInt(digitos[(veri - 1)]);
    var suma_total=0;
    
    if(isNaN(ced)==true){$("#"+obj).addClass("texto_invalido");return false;}//el dato no es numerico	
    for(i=0;i<(veri-1);i++){
    	var d= parseInt(digitos[i]) *  parseInt(multi[i]);
        if(tp=='PN'){if(d>9){d=d-9;}}
        suma_total=suma_total + d;
    }
    var verificador= suma_total % divi;
    if (verificador!=0){ verificador=divi - verificador;}
    if(verificador!=ultimo_digito){$("#"+obj).addClass("texto_invalido");return false;}
    else{$("#"+obj).removeClass("texto_invalido");return true;}
}

function valida_fechaddmmyyyy(f){
	//EL FORMATO DEBE SER dd/mm/yyyy o dd-mm-yyyy implica que debe tener una longitud de 10 caracteres
    //maximos u 8 minimos
	if(f.length<8 && f.length>10){return false;}
    var fec = f.replace("-", "/");// reemplazamos primer - por /
    fec = fec.replace("-", "/");// reemplazamos segundo - por /
	//ahora vamos a obtener los valores del dia, mes y aÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂªÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂªÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€¦Ã‚Â¾o
	var dia = parseInt(fec.substring(0, fec.indexOf("/")));
	var mes = parseInt(fec.substring((fec.indexOf("/") + 1), fec.indexOf("/",(fec.indexOf("/") + 1))));
	var ano = parseInt(fec.substring((fec.indexOf("/",(fec.indexOf("/") + 1)) + 1 ), (fec.length + 4)));
	//validamo que existan datos validos
    if(isNaN(dia)==true || isNaN(mes)==true || isNaN(ano)==true ){return false;}
    // VALIDAMOS QUE el mes sea valido
	if(mes>12 || mes <1){return false;}//el mes no existe
	if(dia>31 || dia <1){return false;}//el di no existe
	if(ano < 1){return false;}//el aÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂªÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂªÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€¦Ã‚Â¾o no existe
	// ahora validamos que los dias esten acorde al mes
	if(mes== 4 || mes== 6 || mes==9 || mes== 11 ){if(dia>30){return false;}} // estos meses maximo deben tener 30 dias
	if(mes==2){ // el famoso febrero
    	//preguntamos si el aÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂªÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚ÂªÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€¦Ã‚Â¾o en viciento
    	if((ano % 4)==0){if(dia>29){return false;}}
    	else{if(dia>28){return false;}}
    }
	return true;
}
function valida_mail_basico(m){
	if(m.indexOf("@")<3){return false;}// no existe @ o esta en una posicion irreal
    // los no permitidos
    if((m.length - m.indexOf("@"))<=4){return false;}
    
    if(m.indexOf("(")!=-1){return false;}
    
    if(m.indexOf(")")!=-1){return false;}
    
    if(m.indexOf(",")!=-1){return false;}
    
    if(m.indexOf(":")!=-1){return false;}
    
    if(m.indexOf(";")!=-1){return false;}
    
    if(m.indexOf("<")!=-1){return false;}
    
    if(m.indexOf(">")!=-1){return false;}
    
    if(m.indexOf(";")!=-1){return false;}
    
    if(m.indexOf("@",(m.indexOf("@")+1))!=-1){return false;}
    
    if(m.indexOf("[")!=-1){return false;}
    
    if(m.indexOf("]")!=-1){return false;}
    
    //los permitidos en la parte local del correo _xxxxx_@
    
    if(m.indexOf("!")!=-1)
    if(m.indexOf("!")<1 || m.indexOf("!") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("#")!=-1)
	if(m.indexOf("#")<1 || m.indexOf("#") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("$")!=-1)
    if(m.indexOf("$")<1 || m.indexOf("$") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("%")!=-1)
 	if(m.indexOf("%")<1 || m.indexOf("%") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("&")!=-1)
    if(m.indexOf("&")<1 || m.indexOf("&") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("*")!=-1)
    if(m.indexOf("*")<1 || m.indexOf("*") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("+")!=-1)
    if(m.indexOf("+")<1 || m.indexOf("+") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("-")!=-1)
    if(m.indexOf("-")<1 || m.indexOf("-") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("/")!=-1)
    if(m.indexOf("/")<1 || m.indexOf("/") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("=")!=-1)
    if(m.indexOf("=")<1 || m.indexOf("=") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("?")!=-1)
    if(m.indexOf("?")<1 || m.indexOf("?") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("^")!=-1)
    if(m.indexOf("^")<1 || m.indexOf("^") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("_")!=-1)
    if(m.indexOf("_")<1 || m.indexOf("_") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("{")!=-1)
    if(m.indexOf("{")<1 || m.indexOf("{") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("|")!=-1)
    if(m.indexOf("|")<1 || m.indexOf("|") >= (m.indexOf("@") - 1) ){return false;}
    if(m.indexOf("}")!=-1)
    if(m.indexOf("}")<1 || m.indexOf("}") >= (m.indexOf("@") - 1) ){return false;} 
    if(m.indexOf(".")!=-1)
    if(m.indexOf(".")<1 || m.indexOf(".") == (m.indexOf("@") - 1) ){return false;} 
    if(m.indexOf(".")!=-1)
    if(m.indexOf(".") == (m.indexOf("@") + 1) || m.lastIndexOf(".") == (m.length -1) ){return false;}
    
	return true;
}
function valida_num_telefono(t){
	if(t.length < 9 || t.length > 10){return false;}
    if(t.length == 9){
    	if(t.substring(0, 1)!='0'){return false;}
    }
    if(t.length == 10){
    	if(t.substring(0, 2)!='09'){return false;}
    }
    if(isNaN(t)==true){return false;}
	return true;
}