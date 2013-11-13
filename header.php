<?php include 'connection.php'; ?>
<?php

	$limit_articles = 5;

   function curPageURL() {
    $pageURL = 'http';
    if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
     $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
     $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
   }
   
   function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
   
        return $ipaddress; 
   }
   
   $page_url = curPageURL();
   $client_ip = get_client_ip();
   $sql = "insert into visits(created_at, page_url, remote_ip) values(NOW(), '$page_url', '$client_ip')";			
   mysql_query($sql);
   
   ?>
   
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44596939-1', 'ofkdesigns.com.mx');
  ga('send', 'pageview');

</script>
   
<div id="mainContainer2">
<header>
 	<div class="header-container">
      <div class="header-class1">
         <a href="home.php"><img class="header-class2" src="images/logo.png" /></a>
      </div>
      <div id='cssmenu'>
         <ul>
            <li class="has-sub" style="padding-left: 20px">
               <a href='#' id="muebleslabel"><span>MUEBLES</span></a>
               <ul>
                  <li><a href='muebles_ofk.php' style="padding-left: 20px"><span>^dise&ntilde;o OFK /</span></a></li>
                  <li><a href='muebles_reinterpretados.php'><span>reinterpretados / </span></a></li>
                  <li class='last'><a href='muebles_personalizados.php'><span>personalizados</span></a></li>
               </ul>
            </li>
            <li class='has-sub'>
               <a href='#' id="accesorioslabel"><span>ACCESORIOS</span></a>
               <ul>
                  <li><a href='accesorios_ofk.php'><span>^dise&ntilde;o OFK /</span></a></li>
                  <li><a href='accesorios_reinterpretados.php'><span>reinterpretados / </span></a></li>
                  <li class='last'><a href='accesorios_personalizados.php'><span>personalizados</span></a></li>
               </ul>
            </li>
            <li class='last'><a id="nosotroslabel" href='nosotros.php'><span>NOSOTROS</span></a></li>
            <li class='last' style="padding-right:25px;"><a id="contactlabel" href='contacto.php'><span>CONTACTO</span></a></li>
            <li style="padding-left: 10px; padding-right: 10px" class="fb"><a href='#'><img src="images/FB.png" /></a></li>
            <li style="padding-right: 10px" class="twitter"><a href='http://twitter.com/OFK_oneofakind' target="_blank"><img src="images/TWITTER.png" /></a></li>
            <li style="padding-right: 10px" class="ig"><a href='http://instagram.com/OFK_oneofakind' target="_blank"><img src="images/IG.png" /></a></li>
            <li style="padding-right: 10px" class="pin"><a href='http://www.pinterest.com/OFKoneofakind' target="_blank"><img src="images/PINTEREST.png" /></a></li>
         </ul>
      </div>
      <div class="header-class7">
      </div>
   </div>
   <div class="header-class6"></div>
   <?php 
   	if ($cat_name != null) {
   		echo"<div class='header-class3'>";
   		echo "<div class='header-class4'><span class='header-class5'>";
   		echo $cat_name;
   		echo "</span></div>";
   		echo "</div>";
   		
   		if (strpos($cat_name,'MUEBLES') !== false) 
   			echo "<script type='text/javascript'>$('#muebleslabel').css('color','white');</script>";
   		
   		else if (strpos($cat_name,'ACCESORIOS') !== false) 
   			echo "<script type='text/javascript'>$('#accesorioslabel').css('color','white');</script>";

   	} else if($us){
   		echo "<script type='text/javascript'>$('#nosotroslabel').css('color','white');</script>";
   	} else if($contact){
   		echo "<script type='text/javascript'>$('#contactlabel').css('color','white');</script>";
   	}
   ?>
   
   
</header>

