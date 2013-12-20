<!doctype html>
<html lang="es">
<head>
   <meta charset="utf-8"/>
   <meta name="keywords" content="muebles, personalizados, accesorios, diseños, ofk">
   <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/captionjs.min.css">
   <link rel="stylesheet" href="css/app.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script src="http://demos.flesler.com/jquery/scrollTo/js/jquery.scrollTo-min.js"></script>
   <script src="js/jquery.caption.min.js"></script>
   <title>Accesorios OFK</title>  
</head>
<body>
<script type="text/javascript">
$( document ).ready(function() {
  <?php 
  	if ($_GET["page"] != "") 
  		echo "$.scrollTo( '#cat-description', 800 );";
  ?>
  
  $('#cssmenu ul li a').addClass('active');
});

</script>
   <?php 
    include 'connection.php';
    
    $cat_id = 4;
	$sql = mysql_query("SELECT * FROM categories where id = ".$cat_id);
    $data = mysql_fetch_assoc($sql);
    
    $id = $data['id'];
    $cat_description = $data['description'];
    $cat_name = $data['name'];
    $image_uri = $data['image_uri'];
    
    include 'header.php';
          
   ?>
   <div class="muebles-separator"></div>
   <div class="muebles-container">
      <img src="<?php echo $image_uri; ?>"/>
      <div class="cat-separator"></div>
      <div class="cat-main-container" align="center">
         <div class="cat-description" id="cat-description">
         
         <?php

$offset   = 0;
$has_more = false;

if ($_GET["page"]) {
    $offset = $_GET["page"] * $limit_articles;
    $page   = $_GET["page"];
} else{
	$page = 0;
}

$offset_next_page = ($page + 1) * $limit_articles;

$sql         = mysql_query("SELECT COUNT(*) as total FROM products WHERE cat_id = $cat_id");
$data        = mysql_fetch_assoc($sql);
$total_count = $data['total'];

if ($total_count > $offset_next_page) {
    $has_more   = true;
    $page_after = $page + 1;
}

echo $cat_description;
?>

            
         </div>
         <div class="floated-left" id="products-list">
            <?php

$sql   = mysql_query("SELECT * FROM products WHERE cat_id = $cat_id limit $offset, $limit_articles");
$total = 0;
while ($row = mysql_fetch_assoc($sql)) {
    $id   = $row['id'];
    $sql2 = mysql_query("SELECT * FROM images WHERE product_id = $id AND is_principal = 1");
    
    if (mysql_num_rows($sql2) > 0) {
        
        $data        = mysql_fetch_assoc($sql2);
        $preview_url = $data['preview_url'];
        $total++;
        
        echo "<a class='muebles-class1' href='detalle.php?article=$id'><img id='animation".$id."' data-caption='A wonderful caption for the photo.'   src='$preview_url' width='180px' height='180px'/></a>";
        echo "<script type='text/javascript'>$('#animation".$id."').captionjs({'mode' : 'animated'});</script>";
        
    }
}

$module = $total % 5;
if ($module != 0) {
    $restantes = 5 - $module;
    for ($i = 0; $i < $restantes; $i++) {
        echo "<a style='cursor:default;float:left;margin:10px 10px 0 0;border:1px solid rgb(235, 255, 130);width:180px;height:180px;' href='#'><img id='animation".$id."' data-caption='A wonderful caption for the photo.'  src='images/white.png' width='180px' height='180px'/></a>";
    }
}

?>
         </div>
         
         <div style="clear:both"></div>
         <div class="paginator">
         
         
         <?php

$number_of_pages = $total_count / $limit_articles;

if ($number_of_pages % $limit_articles != 0)
    $number_of_pages = ceil($number_of_pages);

else
    $number_of_pages = floor($number_of_pages);

if ($page > 0) {
    $page_before = $page - 1;
    echo "<a href=\"?page=$page_before\"><img class=\"nav-arrow\" src=\"images/flechitaIZQ.png\"/></a>";
}

if($number_of_pages > 1){
	for ($i = 1; $i <= $number_of_pages; $i++) {
    	$circle_page = $i - 1;
    	if ($page + 1 == $i)
	    	echo "<a href=\"?page=$circle_page\"><img class=\"circle-page\" src=\"images/circulito2.png\"/></a>";
	    else
	    	echo "<a href=\"?page=$circle_page\"><img class=\"circle-page\" src=\"images/circulito.png\"/></a>";
	}
}

if ($has_more) {
    echo "<a href=\"?page=$page_after\"><img class=\"nav-arrow\" src=\"images/flechitaDER.png\"/></a>";
}
?>
</div>
      </div>
   </div>
   <?php
include 'footer.php';
?>

</body>
</html>