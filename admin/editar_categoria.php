<?php include 'layout.php'; ?>
<script type="text/javascript">
function validateForm(){
var name = document.forms["categoryForm"]["name"].value;
var description = document.forms["categoryForm"]["description"].value;

	if (name == null || name == "") {
  		alert("El nombre no debe estar vacio");
  		return false;
	}
	if (description == null || description == "") {
  		alert("La descripcion no debe estar vacia");
  		return false;
	}
}
</script>
<?php
	$sql = mysql_query("SELECT * FROM categories where id = ".$_GET["id"]);
    $data = mysql_fetch_assoc($sql);
    
    $id = $data['id'];
    $name = $data['name'];
    $description = $data['description'];
    $image_uri = $data['image_uri'];
?>
<section id="main" class="column">

	<article class="module width_full">
		<form action="categorias.php" name="categoryForm" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id?>"
			<header>
				<h3>Editar categor&iacute;a</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<label>Nombre</label> <input type="text" name="name" value="<?php echo $name?>">
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>Descripci&oacute;n</label>
					<textarea name="description" rows="12"><?php echo str_replace('<br />',"\n", $description)?></textarea>
				</fieldset>

			</div>
			<div class="module_content" style="text-align:center">
				<fieldset>
					<label>Imagen</label>
					<img src='<?php echo $image_uri?>' style="max-width:800px;"/>
				</fieldset>
			</div>
			<div class="module_content">
				<fieldset>
					<label>Cambiar imagen</label>
					<div style="color:red">Imagen de <strong>282px</strong> de alto por <strong>1024px</strong> de ancho en formato .jpg</div>
            		<input type="file" name="upload[]" id="file">
				</fieldset>

			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Guardar" class="alt_btn">
				</div>
			</footer>
		</form>
	</article>
	<!-- end of post new article -->

	<div class="spacer"></div>
</section>
</body>
</html>