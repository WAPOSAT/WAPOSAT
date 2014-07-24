/*
	 * @author  Neumann Valle Aka UTAN
	 * @email   vcomputadoras@yahoo.com, website vcomputadoras.com
	 * Parametros mandatorios son: recipienteid , formaid, ajaxurl
	 * donde recipienteid, es donde reciviremos el resultado de la enviar_form ajax.
	 * formaid, el id de la forma especificado en el html.
	 * ajaxurl , el documento donde hases el envio ajax o enviar_form.
	 * metodo , no es mandatorio, sera POST for defecto sin parametro
	 * sincronico, no es mandatorio si lo dejas en blanco se ara la llamada
	 * ajax asincronica.  TRUE Por defecto que es asincronico.. y FALSE sincronico.
	 */

	function enviar_form(recipienteid, formaid, ajaxurl , metodo , sincronico){

            this.recepienterid   = recipienteid;
	        this.formid          = formaid;
	        this.ajaxurl         = ajaxurl;
			this.method          = metodo     == undefined ? 'post': metodo     ;
			this.asynchronous    = sincronico == undefined ? true  : sincronico ;

		/*
		 * colocamos un evento en la forma o elemento con el id especificado
		 * browser independiente, trabaja con  >= ie7 y los otros exploradores
		 * estandares.. firefox, chrome, safari y otros.
		 */
	    enviar_form.prototype.loadform = function() {
	        var form = document.getElementById(this.formid);
	        if(form){
			    // para todos los browsers execto IE =< 7
		        if(form.addEventListener){
				    // agregamos un evento de submit a nuestra forma
			        form.addEventListener('submit' , function(){

					// declaramos nuestra variable que tendra nuestro datos de la forma
					var data = [];
					    /*
						 *  si tenemos mas imputs, en nuestra forma este loop se ara cargo
						 *  de crear un array con todos los datos de la forma
						 */
					    if(form.elements.length >= 1){
						    for(var i= 0; i < form.elements.length; i++){
					            data[form.elements[i].name] = form.elements[i].value;
					        }
						}else{
						    return false;
						}
					    //dejemonos de jugar mandemos el request a nuestro servidor
						this.sendRequest(data);
					}.bind(this));

				}else if(form.attachEvent){
				    // como ie,  <= ie8 no soporta el keyboard bind() esta es una buena solucion
				    enviar_form.prototype.binding();
					// agregamos el evento a nuestra forma
				    form.attachEvent('onsubmit' , function(){

					// declaramos nuestra variable que tendra nuestro datos de la forma
					var data = [];
					    /*
						 *  si tenemos mas imputs, en nuestra forma este loop se ara cargo
						 *  de crear un array con todos los datos de la forma
						 */
					    if(form.elements.length >= 1){
						    for(var i= 0; i < form.elements.length; i++){
					            data[form.elements[i].name] = form.elements[i].value;
					        }
						}else{
						    return false;
						}
						//dejemonos de jugar mandemos el request a nuestro servidor
						this.sendRequest(data);

				    }.bind(this));

				}
		    }
	    };
		// una function para serialize objetos
		enviar_form.prototype.serialize = function(obj)
		{
			var str = [];
			for(var p in obj)
			str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
			return str.join("&");


		};

		enviar_form.prototype.sendRequest = function(data){
		    // instanciamos nuestro ajax objeto
		    var request    =  new ajaxob();
			var recipiente = document.getElementById(this.recepienterid);
			var url        = this.ajaxurl;
		    // una timestamp que cambiara en cada enviada ajax, por el cache de IE.
		    var timestamp  = parseInt(new Date().getTime().toString().substring(0, 10));
		            // serialize el objeto que octuvimos de los input de la forma
					data = enviar_form.prototype.serialize(data);

					//caso especial para el get, este es enviado en el url
					if(this.method.toLowerCase() == 'get'){
					    url  = url + '?' + data + '&' ;
						data = null;
					}
					// enviemos la enviar_form de ajax
					request.open(this.method, url + '?t=' + timestamp , this.asynchronous);
					    // si usamos post, entonces enviemos los headers necesarios
					    if(this.method.toLowerCase() == 'post'){
				            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				            request.setRequestHeader("Content-length", data.length);
					        request.setRequestHeader("Connection", "close");
					    }

					request.onreadystatechange = function(){
					    if(request.readyState == 4){
						    if(request.status == 200){
							    if(request.responseText != null && request.responseText != ''){
						            // mostremos el resultado en nuestro html
						            if(recipiente) recipiente.innerHTML = request.responseText;
								}else{
								    alert('hubo un error:  estas seguro que, '+ this.ajaxurl +' esta printeando resultados?');
								}
							}else{
							    alert('hubo un error al enviar la enviar_form : ' + request.statusText);
							}
						}
					}.bind(this)
					request.send(data);
		};
		/*
		 * el bind keyboard no esta disponible en versiones de IE <= 8
		 * con esta funcion la tenemos disponible..
		 * https://developer.mozilla.org/en-US/docs/JavaScript/Reference/Global_Objects/Function/bind
		 */
		enviar_form.prototype.binding = function(){
		    if (!Function.prototype.bind) {
				Function.prototype.bind = function (oThis) {
					if (typeof this !== "function") {
						// closest thing possible to the ECMAScript 5 internal IsCallable function
						throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
					}

					var aArgs = Array.prototype.slice.call(arguments, 1),
					fToBind = this,
					fNOP = function () {},
					fBound = function () {
						return fToBind.apply(this instanceof fNOP && oThis
						? this
						: oThis,
						aArgs.concat(Array.prototype.slice.call(arguments)));
					};

					fNOP.prototype = this.prototype;
					fBound.prototype = new fNOP();

					return fBound;
				};
			}
		}
	}
		/*
		 * * checkeamos soporte para el ajax
		 * * browser independiente, trabaja con  >= ie7 y los otros exploradores
		 * * estandares.. firefox, chrome, safari y otros.
		 * */
		function ajaxob(){
			try{
				return new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
			}
			catch (e){
				try{
					return new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
				}
				catch (e){
					try{
						return new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e){
						alert("Sorry AJAX is not supported by your browser.");
						return false;
					}
				}
			}
		};