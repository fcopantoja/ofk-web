<?php include 'layout.php'; ?>
<script type="text/javascript">
function validateForm(){
var x = document.forms["categoryForm"]["name"].value;
var y = document.forms["categoryForm"]["description"].value;

	if (x == null || x == "") {
  		alert("El nombre de categoria no debe estar vacio");
  		return false;
	}
	if (y == null || y == "") {
  		alert("La descripcion de la categoria no debe estar vacia");
  		return false;
	}
}

function confirmDelete(cat_id){
	var x =  confirm("Desea eliminar la categoría?");
	
	if(x)
		document.location.href = 'categorias.php?delete=' + cat_id
		
}

</script>
<section id="main" class="column">

	<?php
	
		
function reArrayFiles(&$file_post)
{
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
	
		if($_GET["delete"]){
			$cat_id = $_GET["delete"];
			$sql = "delete from categories where id =".$cat_id;
			$response = mysql_query($sql);
			
			if($response > 0)
				echo "<h4 class='alert_success'>La categor&iacute;a ha sido eliminada</h4>";
			else
				echo "<h4 class='alert_error'>La categor&iacute;a no se puede eliminar porque tiene art&iacute;culos asociados</h4>";
		}
		
		if(isset($_POST['id']) ){
		
			$id = $_POST["id"];
			$name = htmlentities($_POST["name"],ENT_NOQUOTES,'UTF-8',false);
			$description = htmlentities($_POST["description"],ENT_NOQUOTES,'UTF-8',false);
			
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

    		}
			
			
			$sql = "update categories set name='$name', description='$description', image_uri='$image_uri' where id = $id";	
			mysql_query($sql);		
			echo "<h4 class='alert_success'>La categor&iacute;a $name ha sido actualizada</h4>";
		
		} else if(isset($_POST['name']) ){
			$name = htmlentities($_POST["name"],ENT_NOQUOTES,'UTF-8',false);
			$description = htmlentities($_POST["description"],ENT_NOQUOTES,'UTF-8',false);

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

    		}
    
			$sql = "insert into categories(name,description,created_at,image_uri) values('$name', '$description', NOW(), '$image_uri')";	
			mysql_query($sql);		
			echo "<h4 class='alert_success'>La categor&iacute;a $name ha sido creada</h4>";
		}
		
	?>
	
	<article class="module width_full">
		<header>
			<h3 class="tabs_involved">Lista de Categor&iacute;as</h3>
		</header>
		

		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<table class="tablesorter" cellspacing="0">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripci&oacute;n</th>
							<th>Imagen</th>
							<th>Creado el</th>
							<th>Acci&oacute;n</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql = mysql_query("SELECT * FROM categories");
						$total = 0;
    					while ($row = mysql_fetch_assoc($sql)) {
        					$name = $row['name'];
        					$description = $row['description'];
        					$created_at = $row['created_at'];
        					$categoryId = $row['id'];
        					$image_uri = $row['image_uri'];
        					echo "<tr>
        							<td><strong>$name</strong>
        							</td><td>$description</td>
        							<td><a href='$image_uri' target='_blank'><img src='$image_uri' height='40px'/></a></td>
        							<td>$created_at</td>
        							<td>
        								<a onclick=\"confirmDelete($categoryId)\" '><input type='image' src='../images/icn_trash.png' title='Trash'></a>
        								<a href='editar_categoria.php?id=$categoryId'><input type='image' src='../images/icn_edit.png' title='Editar'></a>
        							</td>
        						</tr>";
    					}
					?>
					</tbody>
				</table>
			</div>
			<!-- end of #tab1 -->
		</div>
		<!-- end of .tab_container -->
	</article>
	<!-- end of content manager article -->
	
	<article class="module width_full">
			<form action="categorias.php" name="categoryForm" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
			<header><h3>Agregar nueva categor&iacute;a</h3></header>
				<div class="module_content">
						<fieldset>
							<label>Nombre</label>
							<input type="text" name="name" maxLength="50">
						</fieldset>
						<fieldset>
							<label>Descripci&oacute;n</label>
							<input type="text" maxLength="300" name="description">
						</fieldset>
						<fieldset>
               				<label>Imagen</label>
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
		</article><!-- end of post new article -->

	<div class="spacer"></div>
</section>
</body>
</html>