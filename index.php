<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kanji Sama dictionary, ganbatte kudasai</title>
</head>

<body>
<H1>Diccionario de Kanji basado en componentes de "Kanji Para Recordar"</H1>
Este diccionario funciona a manera de indice asociativo entre los distintos componentes y palabras clave, está basado en el método de estudio del libro "Kanji Para Recordar" de los autores James W. Heisig, Marc Bernabé y Verònica Calafell, editorial Herder, año 2003 2da edición. Se puede ver más información al respecto en su página web <a href="http://www.nipoweb.com">http://www.nipoweb.com</a>
<br> <br> 
Introduce las palabras clave de kanji o componente a buscar, los resultados estarán ordenados de manera que los que tienen mayor cantidad de coincidencias con los componentes solicitados aparecerán de primero, si clickas sobre el kanji te va a redirigir al diccionario en linea de <a href="http://www.taipansoftware.com">http://www.taipansoftware.com</a> donde se muestra las lecturas del kanji.
<br> <br> 
También es posible hacer una búsqueda de componentes según su kanji mediante este <a href="http://cclugo.comxa.com//spk.php">enlace</a>.<br> 
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
	<INPUT TYPE="submit" NAME="accion" VALUE="Buscar">
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

for ($i = 1; $i <= 7; $i++) {               // 1 iteración para cada tabla de componentes
	for ($q = 1; $q <= 6; $q++)	{       	// 1 iteración para cada palabra en el formulario	
		$y = $_GET[$q];
		if ($y != '') {			
			$query = $query = mysql_query("select * from `$i` where `comp` like '$y'");
			while ($arr = mysql_fetch_array($query)){
      			if ($y == $arr[1]) { $a[$arr[0]]["ncoin"] = $a[$arr[0]]["ncoin"]+1; $foo = $foo+1; }
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
	<TR><TD>&nbsp;<B>Número</B></TD> <TD>&nbsp;<B>Kanji</B>&nbsp;</TD> <TD>&nbsp;<B>Palabra Clave</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 1</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 2</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 3</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 4</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 5</B>&nbsp;</TD> <TD>&nbsp;<B>Comp 6</B>&nbsp;</TD> <TD>&nbsp;<B></B>&nbsp;</TD> </TR>
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
				for ($q = 1; $q <= 7; $q++) {
					$query = mysql_query("select * from `$q` where `id` like '$i'");
					$arr[$i][$q] = mysql_fetch_array($query);
					unset($query);
					printf("<td>&nbsp;%s</td>", $arr[$i][$q]["comp"]);
				}
				
				echo '<td>&nbsp;<a href="http://www.clugo.isgreat.org/editar.php?kanji=';
				echo $arr[$i][0]["kanji"];
								
				echo '">';
				echo 'Editar';
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
						for ($q = 1; $q <= 7; $q++) {
							$query = mysql_query("select * from `$q` where `id` like '$i'");
							$arr[$i][$q] = mysql_fetch_array($query);
							unset($query);
							printf("<td>&nbsp;%s</td>", $arr[$i][$q]["comp"]);
						}
						
						echo '<td>&nbsp;<a href="http://www.clugo.isgreat.org/editar.php?kanji=';
						echo $arr[$i][0]["kanji"];
										
						echo '">';
						echo 'Editar';
						echo '</a></td>';
					}
				}
			}	
		}	
	?>
</TABLE>
</body>
</html> 