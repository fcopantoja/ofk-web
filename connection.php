<?php
   $dbHost = "localhost";
   $dbUser = "ofkde_root";            //Usuario de la base de datos
   $dbPass = "root2013";            //Contraseña de la base de datos
   $dbDatabase = "ofkdesigns_com_portal";    //Nombre de la base de datos
   $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
   mysql_select_db($dbDatabase, $db)or die("Couldn't select the database.");
   mysql_set_charset('utf8');   
?>