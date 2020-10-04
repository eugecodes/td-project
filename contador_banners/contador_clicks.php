<?php
/* 

	Función: Contador de clicks para banners
	Fecha de creación: 01/06/2016
	Última modificación: 20/06/2016
	Autor modificación: Emilse  

*/

	$servername = "localhost";
	$username = "tradem_user_et";
	$password = "2EeHrkIA";
	$dbname = "tradem_et";

	$conn = new mysqli($servername, $username, $password, $dbname);
	$sitio = $_SERVER['HTTP_HOST'];
	
	$nombre_host = '';
	
	switch($sitio) {
		case 'trademdesign.com':
			$host = 'trademdesign.com';
			$nombre_host = 'design';
			break;
		case 'trademdesign.com.ar':
			$host = 'trademdesign.com';
			$nombre_host = 'design';
			break;
		case 'www.trademdesign.com':
			$host = 'trademdesign.com';
			$nombre_host = 'design';
			break;
		case 'www.trademdesign.com.ar':
			$host = 'trademdesign.com';
			$nombre_host = 'design';
			break;
		case 'trademstyle.com':
			$host = 'trademdesign.com';
			$nombre_host = 'style';
			break;
		case 'trademstyle.com.ar':
			$host = 'trademstyle.com';
			$nombre_host = 'style';
			break;
		case 'www.trademstyle.com':
			$host = 'trademstyle.com';
			$nombre_host = 'style';
			break;
		case 'www.trademstyle.com.ar':
			$host = 'trademdesign.com';
			$nombre_host = 'style';
			break;        
		case 'www.espaciotradem.com':
			$host = 'espaciotradem.com';
			$nombre_host = 'espacio';
			break;
		case 'www.espaciotradem.com.ar':
			$host = 'espaciotradem.com';
			$nombre_host = 'espacio';
			break;
		case 'espaciotradem.com':
			$host = 'espaciotradem.com';
			$nombre_host = 'espacio';
			break;
		case 'espaciotradem.com.ar':
			$host = 'espaciotradem.com';
			$nombre_host = 'espacio';
			break;
		default:
			$host = 'espaciotradem.com';
			$nombre_host = 'espacio';
	}
	
	echo $nombre_host;
	
	switch ($_POST['data']) 
	{
		case 'guardar_click':
			if($_POST['cliente'] && $_POST['banner']){
				$cliente = $_POST['cliente'];
				$banner = $_POST['banner'];
				$count = 0;

				$sql = "select contador_$nombre_host as contador from tradem_et.wp_stats_banners where cliente = '$cliente' and banner = '$banner'";		
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$count = $row['contador'];
						$count++;
						$sql = "UPDATE tradem_et.wp_stats_banners SET contador_$nombre_host = $count WHERE cliente = '$cliente' and banner = '$banner'";
						$result = $conn->query($sql);
						echo json_encode($result);
					}
				}
			}
			break;
	}
	
	$conn->close();