<?php include 'layout.php'; ?>
<script type="text/javascript">

function validateForm(){
	var name = document.forms["articleForm"]["name"].value;
	var title = document.forms["articleForm"]["title"].value;
	var description = document.forms["articleForm"]["description"].value;
	var price = document.forms["articleForm"]["price"].value;



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
<section id="main" class="column">

	<article class="module width_full">
		<form action="articulos.php" name="articleForm" method="POST" onsubmit="return validateForm()">
			<header>
				<h3>Nuevo art&iacute;culo</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<label>Nombre</label> <input type="text" name="name">
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>T&iacute;tulo</label> <input type="text" name="title">
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>Descripci&oacute;n</label>
					<textarea name="description" rows="12"></textarea>
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>Dimensiones</label> <input type="text" name="dimensions">
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>Precio</label> <input type="text" name="price">
				</fieldset>

			</div>
			<div class="module_content">

				<fieldset style="width: 48%; float: left; margin-right: 3%;">
					<label>Categor&iacute;a</label> <select name="cat" style="width: 92%;">

					<?php
						$sql = mysql_query("SELECT * FROM categories");
    					while ($row = mysql_fetch_assoc($sql)) {
        					$name = $row['name'];
        					$cat_id = $row['id'];
        					echo "<option value='$cat_id'>$name</option>";
    					}
					?>
					</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label>Tags</label> <input type="text" name="tags" style="width: 92%;">
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
	<div class="spacer"></div>
</section>
</body>
</html>