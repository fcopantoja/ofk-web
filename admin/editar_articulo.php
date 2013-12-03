<?php include 'layout.php'; ?>
<script type="text/javascript">
function validateForm(){
var name = document.forms["articleForm"]["name"].value;
var title = document.forms["articleForm"]["title"].value;
var description = document.forms["articleForm"]["description"].value;

	if (name == null || name == "") {
  		alert("El nombre no debe estar vacio");
  		return false;
	}
	if (title == null || title == "") {
  		alert("El titulo no debe estar vacio");
  		return false;
	}
	if (description == null || description == "") {
  		alert("La descripcion no debe estar vacia");
  		return false;
	}
	if (price != null && price != "") {
		
		if(isNaN(price)){
			alert("El precio debe de ser un numero valido");
			return false;
		}
	}
}
</script>
<?php
	$sql = mysql_query("SELECT * FROM products where id = ".$_GET["id"]);
    $data = mysql_fetch_assoc($sql);
    
    $id = $data['id'];
    $name = $data['name'];
    $title = $data['title'];
    $description = $data['description'];
    $dimensions = $data['dimensions'];
    $price = $data['price'];
    $tags = $data['tags'];
    $prod_cat_id = $data['cat_id'];
?>
<section id="main" class="column">

	<article class="module width_full">
		<form action="articulos.php" name="articleForm" method="POST" onsubmit="return validateForm()">
			<input type="hidden" name="id" value="<?php echo $id?>"
			<header>
				<h3>Editar art&iacute;culo</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<label>Nombre</label> <input type="text" name="name" value="<?php echo $name?>">
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>T&iacute;tulo</label> <input type="text" name="title" value="<?php echo $title?>">
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>Descripci&oacute;n </label>
					<textarea name="description" rows="12"><?php echo str_replace('<br />',"\n", $description)?></textarea>
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>Dimensiones</label> <input type="text" name="dimensions" value="<?php echo $dimensions?>">
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>Precio</label> <input type="text" name="price" value="<?php echo $price?>">
				</fieldset>

			</div>
			<div class="module_content">

				<fieldset style="width: 48%; float: left; margin-right: 3%;">
					<!-- to make two field float next to one another, adjust values accordingly -->
					<label>Categor&iacute;a</label> <select name="cat" style="width: 92%;">

					<?php
						$sql = mysql_query("SELECT * FROM categories");
    					while ($row = mysql_fetch_assoc($sql)) {
        					$name = $row['name'];
        					$cat_id = $row['id'];
        					
        					if($prod_cat_id == $cat_id)
        						echo "<option value='$cat_id' selected='selected'>$name</option>";
        					
        					else
        						echo "<option value='$cat_id'>$name</option>";
    					}
					?>
					</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<!-- to make two field float next to one another, adjust values accordingly -->
					<label>Tags</label> <input type="text" name="tags" value="<?php echo $tags?>" style="width: 92%;">
				</fieldset>
				<div class="clear"></div>
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