<head>
   <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="css/app.css">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
   <meta name="keywords" content="muebles, personalizados, accesorios, diseños, ofk">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <title>Contacto | OFK</title>
</head>
<body>
  	<?php 
  		$contact = true;
  		include 'header.php';
  		$sql = mysql_query("SELECT param_value FROM config_param where param_key = 'CONTACT.TEXT.DESCRIPTION'");
   		$data = mysql_fetch_assoc($sql);
   		$contact_text = $data['param_value']; 
   		
   		$sql = mysql_query("SELECT param_value FROM config_param where param_key = 'CONTACT.BACKGROUND.IMAGE.URI'");
   		$data = mysql_fetch_assoc($sql);
   		$contact_image = $data['param_value'];
  	?>
   <div class="contact-separator"></div>
   <div class="contact-container" style="background-image:url(<?php echo $contact_image;?>);">
      <div class="contact-child-container">
         <span class="contact-title">CONTACTO</span>
         <br><br>
         	<?php echo $contact_text;?>
         <!--
         <span class="contact-text">
         Si tienes un espacio que te gustar&iacute;a llenar con un muebles especial, alguna necesidad de dise&ntilde;o, o alg&uacute;n mueble o accesorio que quisieras actualizar, comun&iacute;cate con nosotros. Estaremos encantados de atenderte.
         <br><br>
         Tel: 5521 3894<br/>
         Cel: 04455 2456 7789
         <br><br>
         mail: contacto@ofk.com
         <br><br>
         Estamos en el D.F. pero hacemos entregas dentro de la Rep&uacute;blica Mexicana.
         </span>
         -->
      </div>
   </div>
   	<?php include 'footer.php'; ?>
</body>
