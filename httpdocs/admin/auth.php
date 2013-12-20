<?php
if(isset($_POST['submit'])){
    $dbHost = "localhost";
    $dbUser = "ofkde_root";            //Usuario de la base de datos
    $dbPass = "root2013";            //Contraseña de la base de datos
    $dbDatabase = "ofkdesigns_com_portal";    //Nombre de la base de datos
 
    $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database.");
 
    mysql_select_db($dbDatabase, $db)or die("Couldn't select the database.");
 
    /*
    El siguiente código puede ir en un archivo diferente, como puede ser 'filename.php'.
    */
 
    $usr = mysql_real_escape_string($_POST['username']);
    $pas = mysql_real_escape_string($_POST['password']);
    $sql = mysql_query("SELECT * FROM users
        WHERE username='$usr' AND
        password='$pas'
        LIMIT 1");
    if(mysql_num_rows($sql) == 1){
        $row = mysql_fetch_array($sql);
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['logged'] = TRUE;
        header("Location: home.php"); // A la página a la que tenemos que ir
        exit;
    }else{
        header("Location: ../login.php?wrong=true");
        exit;
    }
}else{    //Si no se ha mandado nada, volvemos al index o la página del login
    header("Location: index.php");
    exit;
}
?>