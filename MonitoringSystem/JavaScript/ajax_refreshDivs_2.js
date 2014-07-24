function  refreshDivs_2 (divid, secs, url, dato1 , dato2) {
	var divid,secs,url,dato1,dato2,fetch_unix_timestamp;
	/*Revisando que las variables no esteen vacias*/
	if (divid == "") {alert('Error: Escribe el id del div que quieres refrescar'); return ;}
	else if (!document.getElementById(divid)) {alert('Error: El div del ID seleccionado no esta definido:' + divid); return;}
	else if (secs == "") {alert('Error: Indica la cantidad de segundos que quieres que el div se refresque'); return ;}
	else if (url == "") {alert('Error: La URL del documento que quieres cargar en el div no puede estar vacia'); return ;}
	/* The xmlHttpRequest object*/
				
	var xmlHttp;
	try{	xmlHttp=new XMLHttpRequest(); /* Firefox, Opera 8.0+, Safari */
	}
	catch (e){
		try{	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); /* Internet Explorer */
		}
		catch (e){
			try{	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
			alert("Tu explorador no soporta AJAX.");
			return false;
			}
		}
	}

	/* Timestamp para evitar que se cachee el array GET */

	fetch_unix_timestamp = function()
	{
	return parseInt(new Date().getTime().toString().substring(0, 10))
	}

	var timestamp = fetch_unix_timestamp();
	var nocacheurl = url+"?dato1="+dato1+"&dato2="+dato2+"&t="+timestamp;

	/* the ajax call */
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4 && xmlHttp.status == 200){
			document.getElementById(divid).innerHTML=xmlHttp.responseText;
			setTimeout(function(){refreshDivs_2(divid,secs,url,dato1,dato2);},secs*1000);
		}
	}
		xmlHttp.open("GET",nocacheurl,true);
		xmlHttp.send(null);
}
