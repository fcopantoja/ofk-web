<head>
   <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="css/app.css">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
   <meta name="keywords" content="muebles, personalizados, accesorios, diseños, ofk">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <title>Nosotros | OFK</title>

</head>
<body>
   	<?php 
   		$us = true;
   		include 'header.php'; 
   		$sql = mysql_query("SELECT param_value FROM config_param where param_key = 'US.TEXT.DESCRIPTION'");
   		$data = mysql_fetch_assoc($sql);
   		$us_text = $data['param_value'];
   		
   		$sql = mysql_query("SELECT param_value FROM config_param where param_key = 'US.BACKGROUND.IMAGE.URI'");
   		$data = mysql_fetch_assoc($sql);
   		$us_image = $data['param_value'];
   	?>

   <div class="us-separator"></div>
   <div class="us-container" style="background-image:url(<?php echo $us_image;?>);">
      <div class="us-child-container">
         <span class="us-title">ONE OF A KIND</span	>
         <br><br>
         <span class="us-subtitle">NOSOTROS</span>
         <br><br>         
         	<?php echo $us_text;?>
         <!--
         <span class="us-text">Orit quos eium nobit, sum sit acestiunt labora
         dolorum, se magnate ad quatiorro magnihictem
         ipidit, et mint ea dolorposti nest eles dolupid
         ebitatem re restempellab ium sim dit volor mo qu
         bguyw khow coiwam, jieu liuoippmoi.</span>
         <br><br>
         <span class="us-text">Dus utem quaecto iliqui consed magnam hillict
         uritat iscimporpos et aribust quo blatem quam,
         est, voluptaspis is es andis et occae que suntiat
         ionsenda nistibu sciist, simaiori tem ipienis
         ipsunt quam et rest reperia estiusam noneste.</span>
         --!>
         <br><br>
      </div>
   </div>
   	<?php include 'footer.php'; ?>

</body>
