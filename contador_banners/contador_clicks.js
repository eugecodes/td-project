/* 

Función: Contador de clicks para banners
Fecha de creación: 01/06/2016
Última modificación: 01/06/2016
Autor modificación: Emilse  

*/

function loadScript(url, callback)
{
    // Adding the script tag to the head as suggested before
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;

    // Then bind the event to the callback function.
    // There are several events for cross browser compatibility.
    script.onreadystatechange = callback;
    script.onload = callback;

    // Fire the loading
    head.appendChild(script);
}

loadScript("https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js", myPrettyCode);

function guardar_click(cliente, banner){
	console.log("cliente "+ cliente);
	console.log("banner "+ banner);
	$.post( "contador_clicks.php",
	{
		'data':'guardar_click',
		'cliente': cliente,
		'banner': banner
	}, function(data) {
		console.log(JSON.stringify(data));
	});
	
}
