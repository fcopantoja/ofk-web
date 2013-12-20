<?php include 'layout.php'; ?>
<script type="text/javascript">

function validateForm(){
	var description = document.forms["descriptionForm"]["description"].value;

		if (description == null || description == "") {
			alert("La descripcion no debe estar vacia");
			return false;
		}
}
<?php

	function reArrayFiles(&$file_post) {
	    $file_ary   = array();
    	$file_count = count($file_post['name']);
	    $file_keys  = array_keys($file_post);
    	
    	for ($i = 0; $i < $file_count; $i++) {
        	foreach ($file_keys as $key) {
            	$file_ary[$i][$key] = $file_post[$key][$i];
        	}
    	}
    
    	return $file_ary;
	}
		
	if( isset($_POST['description'])){
		$description = htmlentities($_POST["description"],ENT_QUOTES,'UTF-8');
		$str = str_replace(array('&lt;','&gt;','&quot;'),array('<','>', '"'), $description);
		$sql = "update config_param set param_value = '$str' where param_key = 'US.TEXT.DESCRIPTION'";			
		mysql_query($sql);
	}
	
	$sql = mysql_query("SELECT param_value FROM config_param where param_key='US.TEXT.DESCRIPTION'");
	$data = mysql_fetch_assoc($sql);
	$us_text = $data['param_value'];
	
	if ($_FILES['upload'] && sizeof($_FILES['upload']) > 0) {
			
		$file_ary = reArrayFiles($_FILES['upload']);
	    $sql = mysql_query("SELECT * FROM config_param WHERE param_key='UPLOADED.FILES.DIR'");
    	$row = mysql_fetch_array($sql);
    	$dir = $row['param_value'];
        
    	$sql        = mysql_query("SELECT * FROM config_param WHERE param_key='SERVER.URL'");
	    $row        = mysql_fetch_array($sql);
    	$server_url = $row['param_value'];
    
    	$image_uri   = $server_url . $dir . $file_ary[0]["name"];
    	move_uploaded_file($file_ary[0]["tmp_name"], "../" . $dir . $file_ary[0]["name"]);
    	$sql = "update config_param set param_value = '$image_uri' where param_key = 'US.BACKGROUND.IMAGE.URI'";			
		mysql_query($sql);		

    }
    
    $sql = mysql_query("SELECT param_value FROM config_param where param_key='US.BACKGROUND.IMAGE.URI'");
	$data = mysql_fetch_assoc($sql);
	$us_image = $data['param_value'];
	
?>

</script>
<section id="main" class="column">

	<article class="module width_full">
		<form action="nosotros.php" name="descriptionForm" method="POST" onsubmit="return validateForm()">
			<header>
				<h3>Nosotros</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<label>Descripci&oacute;n</label>
					<textarea name="description" rows="12"><?php echo htmlentities($us_text);?></textarea>
				</fieldset>

			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Actualizar" class="alt_btn">
				</div>
			</footer>
		</form>
	</article>
	<div class="spacer"></div>
	<article class="module width_full">
		<form action="nosotros.php" name="imageForm" method="POST" enctype="multipart/form-data">
			<header>
				<h3>Imagen de fondo</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<img src="<?php echo $us_image;?>" style="max-width:885px;"/>
				</fieldset>
			
				<fieldset>
					<label>Actualizar imagen</label>
					<input type="file" name="upload[]" id="file"/>
				</fieldset>
			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Actualizar" class="alt_btn">
				</div>
			</footer>
		</form>
	</article>
	<div class="spacer"></div>
</section>
</body>
</html>