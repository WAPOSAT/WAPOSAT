// -----------------------------------------------------------------------------------------------------------------
/* Valida correo */
function valida_correo(correo) {
		  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(correo)){
			
		   return (true)
		  } else {
		   
		   return (false);
		  }
		 }
// ------------------------------------------------------------------------------------------------------------------
/* valida números */
function valida_numero(numero)
{
if (!/^([0-9])*$/.test(numero)){
		return false;
}else{
		return true;
	}
}
// -------------------------------------------------------------------------------------------------------------------
/* función para validar cadenas de solo letras */
function valida_cadena(texto)
	{
		var RegExPattern = "[1-9]";
		 if (texto.match(RegExPattern))
		 {
		 	return false;
		 }else
		 {
		 	return true;
		 }
	}
// --------------------------------------------------------------------------------------------------------------------
/* funcion para limpiar los cuadros rellenados */
function limpiar()
{
	document.form.reset();
	document.form.nom.focus();
}


// -----------------------------------------------------------------------------------------------------------
/* funcion que mueve un reloj */

	function mueveReloj(){
		momentoActual = new Date()
	    hora = momentoActual.getHours()
	    minuto = momentoActual.getMinutes()
	    segundo = momentoActual.getSeconds()

	    str_segundo = new String (segundo)
	    if (str_segundo.length == 1)
	       segundo = "0" + segundo

	    str_minuto = new String (minuto)
	    if (str_minuto.length == 1)
	       minuto = "0" + minuto

	    str_hora = new String (hora)
	    if (str_hora.length == 1)
	       hora = "0" + hora 
		horaImprimible = hora + ":" + minuto + ":" + segundo
		document.form_reloj.reloj.value= horaImprimible
		setTimeout("mueveReloj()",1000)	}
	
	
// -------------------------------------------------------------------------------------------------------------
	function Marcar(form){
		var limite_de_tiempo = 15
		inicio=document.inicio.hora_inicio.value
		entrada=document.form_reloj.reloj.value
		form.hora.value=entrada
		form.asistencia.value="Asistio"
		// ***********************************************************************************
		//programa que resta las horas
		    horas1=entrada.split(":"); /*Mediante la función split separamos el string por ":" y lo convertimos en array. */
		    horas2=inicio.split(":");
		    horatotale=new Array();
//		    for(a=0;a<3;a++) /*bucle para tratar la hora, los minutos y los segundos*/
//		    {
//		
//		        horas1[a]=(isNaN(parseInt(horas1[a])))?0:parseInt(horas1[a]) /*si horas1[a] es NaN lo convertimos a 0, sino convertimos el valor en entero*/
//		        horas2[a]=(isNaN(parseInt(horas2[a])))?0:parseInt(horas2[a])
//		        horatotale[a]=(horas1[a]-horas2[a]);/* insertamos la resta dentro del array horatotale[a].*/
//		
//		    }
					entrada=horas1[0]*60
					inicio=horas2[0]*60
					entrada=entrada + horas1[1]
		    		inicio=inicio + horas2[1]
		    		retardo = entrada - inicio
		    horatotal=new Date()  /*Instanciamos horatotal con la clase Date de javascript para manipular las horas*/
		    horatotal.setHours(horatotale[0]); /* En horatotal insertamos las horas, minutos y segundos calculados en el bucle*/
		    horatotal.setMinutes(horatotale[1]);
		    horatotal.setSeconds(horatotale[2]);
		    //form.hora.value=horatotal.getHours()+":"+horatotal.getMinutes()+":"+horatotal.getSeconds();
		    //form.hora.value=retardo
		    if(retardo > limite_de_tiempo ){
				if(form.condicion.value != "Tarde justificado"){form.condicion.value="Tarde" } }
		    else {form.condicion.value="Puntual"}
		    /*return horatotal.getHours()+":"+horatotal.getMinutes()+":"+
		    horatotal.getSeconds();*/
		    /*Devolvemos el valor calculado en el formato hh:mm:ss*/
		    form.submit()
		//***********************************************************************************
				
		}
	
	
	
	
//-------------------------------------------------------------------------------------------------------------------
