<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kanji Sama dictionary, ganbatte kudasai</title>
</head>

<body>
<H1>Kanji dictionary based on the components of "Remembering The Kanji"</H1>
Note: This is a database version from <a href="https://spreadsheets.google.com/ccc?key=pyxWLiI5lkOtYHLb8oQo2Yg&hl=en">Katsuo's spreadsheet</a> a member of <a href="http://kanji.koohii.com/index.php">Reviewing the Kanji</a> community , will be another second version whit official RTK, both will be online, still need contributors to fill the second version, comments to coregir@kanji-sama.com
<br> <br> 
This dictionary work like an asociative index between the distinct components and keywords, its based on the study metod from the book "Remembering The Kanji" from the autor James W. Heisig. 
<br> <br> 
Type the keywords or components to search, the results will be assorted by the most coincidence number and will appear first, if you click over the kanji you will see the pronunciation at the great Japanese dictionary from <a href="http://www.taipansoftware.com">http://www.taipansoftware.com</a>
<br> <br> 
Also you can do a component search using a kanji in this <a href="http://www.kanji-sama.com/enk.php">link</a>.<br> 
<br> <br> 
<FORM method="get" >
	<TABLE>
		<TR><TD><INPUT TYPE="text" NAME="1" SIZE="20" MAXLENGTH="30"></TD></TR>
		<TR><TD><INPUT TYPE="text" NAME="2" SIZE="20" MAXLENGTH="30"></TD></TR>
		<TR><TD><INPUT TYPE="text" NAME="3" SIZE="20" MAXLENGTH="30"></TD></TR>
		<TR><TD><INPUT TYPE="text" NAME="4" SIZE="20" MAXLENGTH="30"></TD></TR>
		<TR><TD><INPUT TYPE="text" NAME="5" SIZE="20" MAXLENGTH="30"></TD></TR>
		<TR><TD><INPUT TYPE="text" NAME="6" SIZE="20" MAXLENGTH="30"></TD></TR>
	</TABLE>
	<INPUT TYPE="submit" NAME="accion" VALUE="Search">
</FORM>
<br> 
<?php 
$foo = 0;	
for ($i = 1; $i <= 2042; $i++) {
	$a[$i]["id"] = $i;
	$a[$i]["ncoin"] = 0;
}
include("conex.php");
$link=Conectarse();
mysql_set_charset('utf8');

for ($i = 1; $i <= 12; $i++) {               // 1 iteración para cada tabla de componentes
	for ($q = 1; $q <= 6; $q++)	{       	// 1 iteración para cada palabra en el formulario	
		$y = $_GET[$q];
		if ($y != '') {			
			$query = $query = mysql_query("select * from `$i` where `encomp` like '$y'");
			while ($arr = mysql_fetch_array($query)){
      			if ($y == $arr[2]) { $a[$arr[0]]["ncoin"] = $a[$arr[0]]["ncoin"]+1; $foo = $foo+1; }
			} 
			unset($query);
		}
	}
}

//echo count($a);
//foreach ($a as $i => $value) {
//	if ($a[$i]["ncoin"] > 0) {
//		echo $a[$i]["id"];
//		echo ' ';
//	}
//}

//mysql_close($link);
?>

<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>
	<TR><TD>&nbsp;<B>Number</B></TD> <TD>&nbsp;<B>Kanji</B>&nbsp;</TD> <TD>&nbsp;<B>Keyword</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 1</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 2</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 3</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 4</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 5</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 6</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 7</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 8</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 9</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 10</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 11</B>&nbsp;</TD> <TD>&nbsp;<B></B>&nbsp;</TD> </TR>
	<?php  
		if ($foo == 0) {
			for ($i = 1; $i <= 2042; $i++) {
				$query = mysql_query("select * from `caracter` where `id` like '$i'");
				$arr[$i][0] = mysql_fetch_array($query);
				unset($query);
				echo '<tr><td>&nbsp;';
				echo $arr[$i][0]["id"];
				echo '</td> <td>&nbsp;<a href="http://www.taipansoftware.com/en/japanese/dictionary/index.php?search=&kanji=';
				echo $arr[$i][0]["kanji"];
				echo '" style="text-decoration:none">';
				echo $arr[$i][0]["kanji"];
				echo '</a></td>';
				for ($q = 1; $q <= 12; $q++) {
					$query = mysql_query("select * from `$q` where `id` like '$i'");
					$arr[$i][$q] = mysql_fetch_array($query);
					unset($query);
					printf("<td>&nbsp;%s</td>", $arr[$i][$q]["encomp"]);
				}
				
				//echo '<td>&nbsp;<a href="http://kanji-sama.hl79.dinaserver.com/editar.php?kanji=';
				//echo $arr[$i][0]["kanji"];
				echo '<td>&nbsp;<a href="http://www.kanji-sama.com/contacto.php';
				
				echo '">';
				echo 'Edit';
				echo '</a></td>';
			}
			//mysql_free_result($result);
			mysql_close($link);  
		} else {
			for ($k = 6; $k >= 1; $k--) {
				foreach ($a as $i => $value) {
					if ($a[$i]['ncoin'] == $k) {
						$query = mysql_query("select * from `caracter` where `id` like '$i'");
						$arr[$i][0] = mysql_fetch_array($query);
						unset($query);
						echo '<tr><td>&nbsp;';
						echo $arr[$i][0]["id"];
						echo '</td> <td>&nbsp;<a href="http://www.taipansoftware.com/en/japanese/dictionary/index.php?search=&kanji=';
						echo $arr[$i][0]["kanji"];
						echo '" style="text-decoration:none">';
						echo $arr[$i][0]["kanji"];
						echo '</a></td>';
						for ($q = 1; $q <= 12; $q++) {
							$query = mysql_query("select * from `$q` where `id` like '$i'");
							$arr[$i][$q] = mysql_fetch_array($query);
							unset($query);
							printf("<td>&nbsp;%s</td>", $arr[$i][$q]["encomp"]);
						}
						
						//echo '<td>&nbsp;<a href="http://kanji-sama.hl79.dinaserver.com/editar.php?kanji=';
						//echo $arr[$i][0]["kanji"];
						echo '<td>&nbsp;<a href="http://www.kanji-sama.com/contacto.php';
				
						echo '">';
						echo 'Edit';
						echo '</a></td>';
					}
				}
			}	
		}	
	?>
</TABLE>
</body>
</html> 