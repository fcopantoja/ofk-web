<?php
session_start();
if(!$_SESSION['logged']){
    header("Location: ../login.php");
    exit;
}
$dbHost = "localhost";
$dbUser = "ofkde_root";            //Usuario de la base de datos
$dbPass = "root2013";            //Contraseña de la base de datos
$dbDatabase = "ofkdesigns_com_portal";    //Nombre de la base de datos
 
$db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
mysql_select_db($dbDatabase, $db)or die("Couldn't select the database.");
?>

<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8"/>
	<title>Administrador | OFK</title>
	<link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
	
	<link rel="stylesheet" href="../css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="../js/hideshow.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>

<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="home.php">OFK Designs Admin</a></h1>
			<h2 class="section_title"></h2><div class="btn_view_site"><a href="../login.php?logout=true">Cerrar sesi&oacute;n</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Bienvenido <?php echo $_SESSION['username']?></p>
		</div>
		<div class="breadcrumbs_container">
			<!--<article class="breadcrumbs"><a href="home.php">Panel de Administraci&oacute;n</a></article>-->
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column" style="height:100%">
		<h3>Contenido</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="nuevo_articulo.php">Agregar nuevo art&iacute;culo</a></li>
			<li class="icn_categories"><a href="articulos.php">Ver art&iacute;culos</a></li>
			<li class="icn_view_users"><a href="nosotros.php">Secci&oacute;n Nosotros</a></li>
			<li class="icn_view_users"><a href="contacto.php">Secci&oacute;n Contacto</a></li>
		</ul>
		<h3>Slideshow</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="slideshow.php">Ver slideshow</a></li>
		</ul>
		<h3>Categor&iacute;as</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="categorias.php">Ver categorias</a></li>
		</ul>
		<h3>Usuarios</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a href="usuarios.php">Ver usuarios</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_jump_back"><a href="../login.php?logout=true">Cerrar sesi&oacute;n</a></li>
		</ul>
		
		<footer>
			<hr />
		</footer>
	</aside><!-- end of sidebar -->
	

