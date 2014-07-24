function eval_select (id_select, id_input) {
	evaluar = document.getElementById(id_select);
	cambio  = document.getElementById(id_input);
	if (evaluar.value == 'otro') {cambio.type = 'text';}
	else {cambio.type = 'hidden';}
}