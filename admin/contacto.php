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
		$sql = "update config_param set param_value = '$str' where param_key = 'CONTACT.TEXT.DESCRIPTION'";			
		mysql_query($sql);
	}
	
	if( isset($_POST['footertext'])){
		$footertext = htmlentities($_POST["footertext"],ENT_NOQUOTES,'UTF-8',false);
		$sql = "update config_param set param_value = '$footertext' where param_key = 'FOOTER.TEXT'";			
		mysql_query($sql);
	}
	
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
    	$sql = "update config_param set param_value = '$image_uri' where param_key = 'CONTACT.BACKGROUND.IMAGE.URI'";			
		mysql_query($sql);		

    }
	
	$sql = mysql_query("SELECT param_value FROM config_param where param_key='CONTACT.TEXT.DESCRIPTION'");
	$data = mysql_fetch_assoc($sql);
	$contact_text = $data['param_value'];
	
	$sql = mysql_query("SELECT param_value FROM config_param where param_key='FOOTER.TEXT'");
	$data = mysql_fetch_assoc($sql);
	$footer_text = $data['param_value'];
	
	$sql = mysql_query("SELECT param_value FROM config_param where param_key='CONTACT.BACKGROUND.IMAGE.URI'");
	$data = mysql_fetch_assoc($sql);
	$contact_image = $data['param_value'];
?>

</script>
<section id="main" class="column">
	<article class="module width_full">
		<form action="contacto.php" name="descriptionForm" method="POST" onsubmit="return validateForm()">
			<header>
				<h3>Contacto</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<label>Descripci&oacute;n</label>
					<textarea name="description" rows="12"><?php echo $contact_text;?></textarea>
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
		<form action="contacto.php" name="footerForm" method="POST" onsubmit="return validateFooterForm()">
			<header>
				<h3>Footer</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<label>Texto</label>
					<input type="text" name="footertext" value="<?php echo $footer_text;?>"/>
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
		<form action="contacto.php" name="imageForm" method="POST" enctype="multipart/form-data">
			<header>
				<h3>Imagen de fondo</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<img src="<?php echo $contact_image;?>" style="max-width:885px;"/>
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