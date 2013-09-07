<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
Luego de hacer algún cambio se debe actualizar esta página para que se muestre correctamente, 
en caso de no hacer ninguna modificación igualmente se debe picar en Enviar antes de ir atras o se borra el registro entero.
<form action="editar.php" method="get" name="form1">



<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>
	
<?php
	include("conex.php");
	$link=Conectarse();
	mysql_set_charset('utf8');
	$k = $_GET["kanji"];

	$query = mysql_query("select * from `caracter` where `kanji` like '$k'");
	$arr[0] = mysql_fetch_array($query);
	unset($query);
	echo '<tr><TD>&nbsp;<B>Número</B></TD><td><input type="text" name="id" value="';
	echo $arr[0]["id"];
	echo '" /></td></tr> <TD>&nbsp;<B>Kanji</B></TD><td><input type="text" name="kanji" value="';
	echo $arr[0]["kanji"];
	echo '" /></td></tr>';
	$id = $arr[0]["id"];
	for ($q = 1; $q <= 12; $q++) {
		$query = mysql_query("select * from `$q` where `id` like '$id'");
		$arr[$q] = mysql_fetch_array($query);
		unset($query);
		if ($q == 1) { echo '<tr><TD>&nbsp;<B>Palabra Clave'; }
		else { echo '<tr><TD>&nbsp;<B>Componente '; echo $q-1; }
		echo '</B></TD><td><input type="text" name="';
		echo $q;		
		echo '" value="';
		echo $arr[$q]["comp"];
		echo '" /></td></tr>';
	}
	printf("</tr></TABLE>");
	
		
?>

<input name="action" type="submit" value="Guardar" />
</form>

<?php

for ($q = 1; $q <= 7; $q++) {
	$dato = $_GET[$q];
	$query = mysql_query("UPDATE `kanji`.`$q` SET `comp` = '$dato' WHERE `$q`.`id` =$id");
	unset($query);
}

?>

<br><br>
<a href="http://clugo.isgreat.org">Regresar a la página principal</a>

</body>
</html>