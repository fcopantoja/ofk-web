<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8"/>

    <?php include 'connection.php'; ?>
   <?php
   
   function curPage() {
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
   
            $sql = mysql_query("SELECT * FROM products where id = ".$_GET["article"]);
            $data = mysql_fetch_assoc($sql);
            $name = $data['name'];
            $title = $data['title'];
            $tags = $data['tags'];
            $description = $data['description'];
            $dimensions = $data['dimensions'];
            $price = $data['price'];
            $cat_id = $data['cat_id'];
            $total_products = $data['total'];
            $availables = $data['availables'];
            
            $sql = mysql_query("SELECT name FROM categories where id = ".$cat_id);
            $data = mysql_fetch_assoc($sql);
            $cat_name = $data['name'];
                        
            $sql = mysql_query("SELECT * FROM images where product_id = ".$_GET["article"]);
            $first_img;
            while ($row = mysql_fetch_assoc($sql)) {
        		$first_img = $row['image_url'];
        		break;
        	}
?>
    <title><?php echo $name;?> | OFK</title>
    <meta name="description" content="<?php echo $title;?>">
    <meta name="keywords" content="<?php echo $tags;?>">

	<meta property="fb:app_id" content="565562100182534" />
	<meta property="og:site_name" content="OFK Designs" />
	<meta property="og:type" content="website" />
	<meta property="og:locale" content="es_MX" />
	<meta property="og:title" content="<?php echo $name;?>" />
	<meta property="og:url" content="<?php echo curPage();?>" />
	<meta property="og:image" content="<?php echo $first_img;?>" />
	<meta property="og:description" content="<?php echo $description;?>" /> 
	
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

   <script type="text/javascript">
   function PopupCenter(pageURL, title,w,h) {
  		var left = (screen.width/2)-(w/2);
  		var top = (screen.height/2)-(h/2);
  		var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	} 
   </script>
   
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
function updateImage(src){
	$('#imgDiv').fadeOut(200, function(){
		document.getElementById("imgDiv").src = src;
		$('#imgDiv').fadeIn(200);
	});
};
</script>
   <?php include 'header.php'; ?>
   <div id="fb-root"></div>
   <div class="muebles-separator"></div>
   <div class="muebles-container" style="width: 955px;">
      <div class="floated-left">
         <img id="imgDiv" src="" width="555px" height="400px" /> <br>
         <div style="width:560px">
         	<?php
            	$sql = mysql_query("SELECT * FROM images where product_id = ".$_GET["article"]);
            	$count = 0;
            	$first_img;
            	while ($row = mysql_fetch_assoc($sql)) {
        			$image_url = $row['image_url'];
    				$preview_url = $row['preview_url'];
    				$total = $total + 1;
        			echo "<a href='#'><img class='detail-thumb' src='$preview_url' onClick=\"updateImage('$image_url');return false;\"/></a> ";
        			
        			if($count == 0)
        				$first_img = $image_url;
        				
        			$count++;
    			}
    			$module = $total % 5;
               			
               	if($module != 0){
               		$restantes = 5 - $module;
               		for ($i = 0; $i < $restantes; $i++) {
               			echo "<img class='detail-thumb' src='images/white.png'>";
               		}
               	}
               	
               	echo "<script type=\"text/javascript\">document.getElementById(\"imgDiv\").src=\"$first_img\";</script>";
          	?>            
         </div>
      </div>
      
      <div class="floated-left" style="margin: 10px 0 0 15px; text-align: left; width: 350px;">
         <span class="product-title"><?php echo $name?></span> <br />
         <?php
         	if($total_products >= 0)
         		echo "<br /> <span class='product-count'>$availables disponibles de $total_products</span> <br />"
         ?>
         <br /> <span class="product-subtitle"><?php echo $title?></span> <br />
         <br /> <span class="product-description"><?php echo $description?></span> <br />
         <br /> <span class="product-dimensions"><?php echo $dimensions?></span> <br />
         <?php 
            if($price != null && $price != 0){
            	$formattedNum = number_format($price, 2);
            	echo "<br/><span class='product-price'>PRECIO: $$formattedNum</span><br/>";
            }
            ?>         
         <br />
         <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
         <div style="margin-top: 100px">
            <div style="float:left;">
            <span style="vertical-align:top;">Compartir:</span> &nbsp;
            </div>
            <div style="float:left;margin-top:-35px;"><a href="#" 
               onclick="PopupCenter('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), '', 626, 436); return false;">
            	<img class="fb_share" src="images/FB_share.png">
            </a>
            
            <a href="#"
            	onclick="PopupCenter('https://twitter.com/intent/tweet?url=' + encodeURIComponent(location.href) + '&text=' + encodeURIComponent('<?php echo $name?> | Muebles OFK'), '', 626, 436); return false;">
               <img class="twitter_share" src="images/TWITTER_share.png">
            </a>
            
            &nbsp;<img src="images/black.png">&nbsp;
            <a href="#"
            	onclick="PopupCenter('http://www.pinterest.com/pin/create/button/?url=' + encodeURIComponent(location.href) + '&media=<?php echo $first_img;?>&description=' +encodeURIComponent('<?php echo $name?> | Muebles OFK'), '', 626, 436); return false;">
               <img class="pin_share" src="images/PINTEREST_share.png">
            </a>
            &nbsp;<img src="images/black.png">&nbsp;
            <div class="fb-like" data-href="http://98.129.169.147/muebles/detalle.php?article=<?php echo $_GET["article"]?>" data-width="30px" data-height="400px" data-colorscheme="light" data-layout="box_count" data-action="like" data-show-faces="true" data-send="false"></div>
            </div>
         </div>
      </div>
   </div>
   <div style="clear:both"></div>
   <br>
   <?php include 'footer.php'; ?>
   
</body>
</html>