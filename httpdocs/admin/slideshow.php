<?php include 'layout.php'; ?>
<script type="text/javascript">
function confirmDelete(id){
	var x =  confirm("Desea eliminar la imagen?");
	
	if(x)
		document.location.href = 'slideshow.php?delete=' + id
		
}

</script>
<section id="main" class="column">

	<?php
		if($_GET["delete"]){
			$slideshow_id = $_GET["delete"];
			$sql = "delete from home_slideshow where id =".$slideshow_id;
			mysql_query($sql);
			echo "<h4 class='alert_success'>El item ha sido eliminado</h4>";
		}
	?>
	
	<?php include 'upload_file.php'; ?>
	
	<article class="module width_full">
		<header>
			<h3 class="tabs_involved">Slideshow - home</h3>
		</header>
		
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<table class="tablesorter" cellspacing="0">
					<thead>
						<tr>
							<th>Preview</th>
							<th>Link de producto</th>
							<th>Creado el</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql = mysql_query("SELECT * FROM home_slideshow ORDER BY created_at DESC");
    					while ($row = mysql_fetch_assoc($sql)) {
        					$image_url = $row['image_url'];
        					$product_id = $row['product_id'];
        					$created_at = $row['created_at'];
        					$id = $row['id'];
        					
        					$sql2 = mysql_query("SELECT * FROM products WHERE id=$product_id");
        					$row2 = mysql_fetch_array($sql2);
        					$product_name = $row2['name'];
        					
        					echo "<tr>";
        					echo "<td><strong><a href='$image_url' target='_blank'><img class='preview_slideshow' src='$image_url' width='100'></a></strong></td>";
							echo "<td><strong>$product_name</strong></td>";
        					echo "<td><strong>$created_at</strong></td>";
        					echo "<td><a onclick=\"confirmDelete($id)\"><input type='image' src='../images/icn_trash.png' title='Trash'></a></td>";
        					echo "</tr>";

    					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</article>
	
	<article class="module width_full">
		<form action="slideshow.php" method="POST" enctype="multipart/form-data">
			<header>
				<h3>Agregar nueva imagen del slideshow</h3>
			</header>
			<div class="module_content">
				<fieldset>
					<label>Imagen</label>
					<div style="color:red">Aseg&uacute;rese de que la imagen sea de <strong>1024px</strong> de alto por <strong>500px</strong> de ancho en formato .jpg</div>
					<input type="file" name="file" id="file">
				</fieldset>

			</div>
			<div class="module_content">
				<fieldset>
					<label>Producto</label>
					<select name="product_id">
					<?php
						$sql = mysql_query("SELECT * FROM products");
    					while ($row = mysql_fetch_assoc($sql)) {
        					$name = $row['name'];
        					$title = $row['title'];
        					$product_id = $row['id'];
        					echo "<option value='$product_id'>$name - $title</option>";
    					}
					?>
					</select>
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