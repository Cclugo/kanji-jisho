<?php
function Conectarse()
{
   if (!($link=mysql_connect("mysql9.000webhost.com","a6972996_admin","mont1234")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysql_select_db("a6972996_kanji",$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}
?>