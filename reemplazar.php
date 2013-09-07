<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
Luego de hacer algún cambio se debe actualizar esta página para que se muestre correctamente, 
en caso de no hacer ninguna modificación igualmente se debe picar en Enviar antes de ir atras o se borra el registro entero.





	
<?php
	include("conex.php");
	$link=Conectarse();
	mysql_set_charset('utf8');
	//$k = $_GET["kanji"];
	
	
		
?>



<?php
for ($i = 1; $i <= 2042; $i++) {
	for ($q = 2; $q <= 12; $q++) {
		$query = mysql_query("select * from `$q` where `id` like '$i'");
		$arr = mysql_fetch_array($query);
		unset($query);
		if ($arr[encomp] == '0') {
			echo $arr[encomp];
			$query = mysql_query("UPDATE `db294731597`.`$q` SET `encomp` = '' WHERE `$q`.`id` =$i");
			unset($query);
		}
		unset ($arr);
	}
}

?>

</body>
</html>