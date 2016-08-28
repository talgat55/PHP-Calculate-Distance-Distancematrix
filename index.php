<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="LightXDesign" />
    <link href="http://fonts.googleapis.com/css?family=Dosis:300,600,700,800" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Document Title -->
    <title>Calculate  distance</title>
</head>
<body style="background-color: #fdfafa;">
<h1>Calculate distance</h1>
<form method="post" style="margin: 50px auto; width:600px; "> 
<!--  can add intermedia Point
<label>Intermediate point</label>

<div id="listpoint">
	<input type="text" name="intermediapoints[]" />
</div>
 <input class="addinterpoint"  type="button" onclick="addpoints()" value="Add Point" />
 -->
<div class="input-field col s6">
    <input id="firstposint" type="text"  name="firstpoint"  class="validate">
    <label for="firstposint">First Point</label>
</div>

<div class="input-field col s6">
    <input id="endpoint" type="text"  name="endpoint"  class="validate">
    <label for="endpoint">End Point</label>
</div>
 
<input type="submit"  class="waves-effect waves-light btn" value="Calculate"/>
</form>
<script type="text/javascript">
	function addpoints(){
		var container;
		var input = document.createElement("INPUT");
		input.type = "text";
		input.className = "intermediapoints[]"; // set the CSS class
		document.getElementById("listpoint").appendChild(input);
	}
</script>
<?php
   // API  AIzaSyDS6f8F5bj6kKdsfO57Y_2GZQShg79rgnk
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if(isset($_POST["firstpoint"])){
	echo "true";
	
	if(isset($_POST["intermediapoints"])){
		$mediats = $_POST["intermediapoints"];
		
		$redypoints = "&waypoints=".implode("|", $mediats);
	}
	else{
		$redypoints = "";
		
	}
	$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".trim($_POST["firstpoint"])."&destinations=".trim($_POST["endpoint"])."&language=en_US".$redypoints."&units=imperial&key=AIzaSyDS6f8F5bj6kKdsfO57Y_2GZQShg79rgnk";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	print_r($response);
	// 	$response_a = json_decode($response, true);
}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
