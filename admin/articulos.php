<?php include 'layout.php'; ?>
<section id="main" class="column">
<script type="text/javascript">
function confirmDelete(id){
	var x =  confirm("Desea eliminar el articulo?");
	
	if(x)
		document.location.href = 'articulos.php?delete=' + id
		
}
</script>

	<?php
		if($_GET["delete"]){
			$prod_id = $_GET["delete"];
			$sql = "delete from products where id =".$prod_id;
			$response = mysql_query($sql);
			
			if($response > 0)
				echo "<h4 class='alert_success'>El art&iacute;culo ha sido eliminado</h4>";
			else
				echo "<h4 class='alert_error'>El art&iacute;culo no se pudo eliminar. Verifique que no tenga im&aacute;genes</h4>";
		}
		if( isset($_POST['name']) && !isset($_POST['id'])){
		
			$name = htmlentities($_POST["name"],ENT_QUOTES,'UTF-8');
			$title = htmlentities($_POST["title"],ENT_QUOTES,'UTF-8');
			$description = htmlentities($_POST["description"],ENT_QUOTES,'UTF-8');
			$str_description = str_replace(array('&lt;','&gt;','&quot;'),array('<','>', '"'), $description);
			$dimensions = $_POST["dimensions"];
			$price = $_POST["price"];
			$cat = $_POST["cat"];
			$tags = htmlentities($_POST["tags"]);
		
			$sql = "insert into products(name,title,description,tags,dimensions,price,cat_id,created_at) values('$name','$title','$str_description','$tags','$dimensions','$price',$cat, NOW())";			
			mysql_query($sql);
			echo "<h4 class='alert_success'>El art&iacute;culo ha sido creado</h4>";
						

		} else if(isset($_POST['name']) && isset($_POST['id'])){
		
			$id = $_POST["id"];
			$name = htmlentities($_POST["name"],ENT_QUOTES,'UTF-8');
			$title = htmlentities($_POST["title"],ENT_QUOTES,'UTF-8');
			$description = htmlentities($_POST["description"],ENT_QUOTES,'UTF-8');
			$str_description = str_replace(array('&lt;','&gt;','&quot;'),array('<','>', '"'), $description);
			$dimensions = $_POST["dimensions"];
			$price = $_POST["price"];
			$cat_id = $_POST["cat"];
			$tags = htmlentities($_POST["tags"]);
			
			$sql = "update products set name = '$name', title = '$title', description = '$str_description', tags = '$tags', dimensions = '$dimensions', price = $price , cat_id = $cat_id WHERE id = $id";			
			mysql_query($sql);
			echo "<h4 class='alert_success'>El art&iacute;culo ha sido actualizado</h4>";

		}
	?>
	
	<?php
			$sql = mysql_query("SELECT * FROM categories");
    		while ($row = mysql_fetch_assoc($sql)) {
    		
        		$cat_name = $row['name'];
        		$created_at = $row['created_at'];
        		$cat_id = $row['id'];
        		
        		echo "<article class=\"module width_full\">
        		<header style=\"background:rgb(47,53,64)\"><h3 style=\"color:white;text-shadow:none;\">$cat_name</h3></header>
		
		<div class=\"module_content\" style=\"margin:0 0\">
				<table class=\"tablesorter\" cellspacing=\"0\">
					<thead>
						<tr>
							<th width=\"200px\">Nombre</th>
							<th width=\"300px\">T&iacute;tulo</th>
							<th>Precio</th>
							<th>Im&aacute;genes</th>
							<th width=\"100px\">Creado el</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>";
					
					$sql2 = mysql_query("SELECT * FROM products WHERE cat_id=$cat_id ORDER BY created_at DESC ");
    					while ($row2 = mysql_fetch_assoc($sql2)) {
        					$name = $row2['name'];
        					$title = $row2['title'];
        					$price = $row2['price'];
        					$created_at_product = $row2['created_at'];
        					$id = $row2['id'];
        					
        					$sql3 = mysql_query("SELECT COUNT(*) as total FROM images WHERE product_id=$id");
        					$data = mysql_fetch_assoc($sql3);
							$total_images = $data['total'];
        					
        					echo "<tr>";
        					echo "<td><strong>$name</strong></td>";
        					echo "<td><strong>$title</strong></td>";
        					echo "<td><strong>$ $price</strong></td>";
        					echo "<td><strong><a href='article_images.php?id=$id'>$total_images</a></strong></td>";
        					echo "<td>$created_at</td>";
        					echo "<td><a href='article_images.php?id=$id'><input type='image' src='../images/icn_photo.png' title='Ver im&aacute;genes'></a><a href='editar_articulo.php?id=$id'><input type='image' src='../images/icn_edit.png' title='Editar'></a><a onclick=\"confirmDelete($id)\"><input type='image' src='../images/icn_trash.png' title='Eliminar'></a></td>";
        					echo "</tr>";

    					}
    					
    					echo "</tbody>
				</table>
		</div>
	</article>";

    			}
		?>

	<div class="spacer"></div>
</section>
</body>
</html>