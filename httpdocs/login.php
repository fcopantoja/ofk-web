<?php 
   session_start();   	
   if($_GET["logout"])
      	session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login | OFK</title>
      <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
      <link rel="stylesheet" type="text/css" href="css/login.css" />
      <script src="js/modernizr.custom.63321.js"></script>
      <!--[if lte IE 7]>
      <style>.main{display:none;} .support-note .note-ie{display:block;}</style>
      <![endif]-->
      <style>
         body {
         background: #e1c192 url(images/wood_pattern.jpg);
         }
      </style>
      <script>
         function setFocus()
         {
         document.getElementById("username").focus();
         }
      </script>
   </head>
   <body onload="setFocus()">
      <div class="container">
         <section class="main">
            <form class="form-2" action="admin/auth.php" method="POST">
               <h1>
                  <span class="log-in">Log in</span> - <span class="sign-up">OFK Designs</span>
               </h1>
               <p class="float">
                  <label for="login"><i class="icon-user"></i>Nombre de usuario</label> <input type="text" name="username" id="username" placeholder="Usuario">
               </p>
               <p class="float">
                  <label for="password"><i class="icon-lock"></i>Password</label> <input type="password" name="password" placeholder="Password" class="showpassword">
               </p>
               <p class="clearfix">
                  <br /> <input style="float: right" type="submit" name="submit" value="Log in">
               </p>
            </form>
            <div align="center">
               <?php
                  if($_GET["wrong"])
                  	echo "<strong>Combinaci&oacute;n incorrecta de correo electr&oacute;nico y contrase&ntilde;a.</strong>";
               ?>
            </div>
         </section>
         <header>
            <h1>
               Regresar a <strong><a href="home.php">OFK Designs</a></strong>
            </h1>
         </header>
      </div>
   </body>
</html>