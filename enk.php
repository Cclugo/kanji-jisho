<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kanji Sama dictionary, ganbatte kudasai</title>
</head>

<body>
Here you can refresh a forgotten component using a search by kanji.
<br><br>
<form action="enk.php" method="get" name="form1">



<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>
	
<?php
	include("conex.php");
	$link=Conectarse();
	mysql_set_charset('utf8');
	$k = $_GET["kanji"];

	$query = mysql_query("select * from `caracter` where `kanji` like '$k'");
	$arr[0] = mysql_fetch_array($query);
	unset($query);
	echo '<tr> <TD>&nbsp;<B>Paste the Kanji to search</B></TD><td><input type="text" name="kanji" value="';
	echo $arr[0]["kanji"];
	echo '" /></td></tr></TABLE>';
	echo '<input name="action" type="submit" value="Search" />';
	echo '<br><br>'; 
	echo '<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>';
	echo '<tr><TD>&nbsp;<B>Number</B></TD><td><input type="text" name="id" value="';
	echo $arr[0]["id"];
	echo '" /></td></tr>';
	$id = $arr[0]["id"];
	for ($q = 1; $q <= 12; $q++) {
		$query = mysql_query("select * from `$q` where `id` like '$id'");
		$arr[$q] = mysql_fetch_array($query);
		unset($query);
		if ($q == 1) { echo '<tr><TD>&nbsp;<B>Keyword'; }
		else { echo '<tr><TD>&nbsp;<B>Component '; echo $q-1; }
		echo '</B></TD><td><input type="text" name="';
		echo $q;		
		echo '" value="';
		echo $arr[$q]["encomp"];
		echo '" /></td></tr>';
	}
	printf("</tr></TABLE>");
	
		
?>


</form>
<br><br><br><br>
<a href="http://www.kanji-sama.com/en.php">Back to main page.</a>

</body>
</html>