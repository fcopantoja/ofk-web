<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="keywords" content="muebles, personalizados, accesorios, diseños, ofk">
      <title>Inicio | OFK</title>
      
	  <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
      <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
      <link rel="stylesheet" href="css/app.css">
      <link rel="stylesheet" href="css/styles.css">
      <link type="text/css" rel="stylesheet" href="js/widget/css/rcarousel.css" />
	  <link rel="stylesheet" href="css/slideshow.css">
      
	  <script type="text/javascript" src="js/widget/lib/jquery-1.7.1.js"></script>
      <script type="text/javascript" src="js/widget/lib/jquery.ui.core.js"></script>
      <script type="text/javascript" src="js/widget/lib/jquery.ui.widget.js"></script>
      <script type="text/javascript" src="js/widget/lib/jquery.ui.rcarousel.js"></script>
   </head>
   <body>
      <?php include 'header.php'; ?>
      <div id="content" style="padding-top:100px;">
         <div id="container" style="margin:0 auto;">
            <div id="carousel">
               <?php include 'connection.php'; ?>
               <?php
                  $sql = mysql_query("SELECT * FROM home_slideshow");
                  		while ($row = mysql_fetch_assoc($sql)) {
							$image_url = $row['image_url'];
                   			$product_id = $row['product_id'];
               				echo "<a href='detalle.php?article=1'><img src='$image_url'/></a>";
               			}
                  ?>			
            </div>
            <div id="pages"></div>
            <!--<a href="#" id="ui-carousel-next"><span>next</span></a>-->
            <!--<a href="#" id="ui-carousel-prev"><span>prev</span></a>-->
         </div>
      </div>
      <script type="text/javascript">
         jQuery(function($) {
         
         	function generatePages() {
         		var _total, i, _link;
				         		
         		_total = $( "#carousel" ).rcarousel( "getTotalPages" );
         		
         		for ( i = 0; i < _total; i++ ) {
         			_link = $( "<a href='#'></a>" );
         			
         			$(_link)
         				.bind("click", {page: i},
         					function( event ) {
         						$( "#carousel" ).rcarousel( "goToPage", event.data.page );
         						event.preventDefault();
																
								$( "a.on", "#pages" )
								.removeClass( "on" )
								.css( "background-image", "url(images/slideshow_blanco.png)" );
								
								$( "a:eq(" + event.data.page + ")", "#pages" )
								.removeClass( "off" )
								.addClass( "on" )
								.css( "background-image", "url(images/slideshow_amarillo.png)" );
								
         					}
         				)
         				.addClass( "bullet off" )
         				.appendTo( "#pages" );
         		}
         		
         		// mark first page as active
         		$( "a:eq(0)", "#pages" )
         			.removeClass( "off" )
         			.addClass( "on" )
         			.css( "background-image", "url(images/slideshow_amarillo.png)" );
         
         	}
			
			function pageLoaded( event, data ) {
					$( "a.on", "#pages" )
						.removeClass( "on" )
						.css( "background-image", "url(images/slideshow_blanco.png)" );

					$( "a", "#pages" )
						.eq( data.page )
						.addClass( "on" )
						.css( "background-image", "url(images/slideshow_amarillo.png)" );
			}
         	
         	$("#carousel").rcarousel({
         		orientation: "vertical",
         		visible: 1,
         		step: 1,
         		speed: 680,
         		auto: {
         			enabled: true,
					interval: 3000,
					direction: "next"
         		},
         		width: 1024,
         		height: 543,
         		start: generatePages,
				pageLoaded: pageLoaded				
         	});				
         	
         	$( "#ui-carousel-next" )
         		.add( "#ui-carousel-prev" )
         		.add( ".bullet" )
         		.hover(
         			function() {
         				$( this ).css( "opacity", 0.7 );
         			},
         			function() {
         				$( this ).css( "opacity", 1.0 );
         			}
         		);
         
         });
      </script>
      <?php include 'footer.php'; ?>
   </body>
</html>