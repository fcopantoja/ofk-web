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
	if( isset($_POST['description'])){
		$description = htmlentities($_POST["description"],ENT_QUOTES,'UTF-8');
		$str = str_replace(array('&lt;','&gt;','&quot;'),array('<','>', '"'), $description);
		$sql = "update config_param set param_value = '$str' where param_key = 'US.TEXT.DESCRIPTION'";			
		mysql_query($sql);
	}
	
	$sql = mysql_query("SELECT param_value FROM config_param where param_key='US.TEXT.DESCRIPTION'");
	$data = mysql_fetch_assoc($sql);
	$us_text = $data['param_value'];
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
</section>
</body>
</html>