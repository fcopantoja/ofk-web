<?php
   include 'layout.php';
   ?>
   <?php
		if($_GET["id"]){
			$product_id = $_GET["id"];
			$sql = mysql_query("select * from products where id =".$product_id);
			$row = mysql_fetch_array($sql);
        	$product_name = $row['name'];
		}
		
	?>	

<section id="main" class="column">

	<?php
	
		if($_GET["principal"]){
			$product_id = $_GET["id"];
			$image_id = $_GET["image_id"];
			$sql = "update images set is_principal = 0 where product_id = $product_id";
			mysql_query($sql);
			$sql = "update images set is_principal = 1 where id = $image_id";
			mysql_query($sql);
			
			echo "<h4 class='alert_success'>La imagen principal ha sido actualizada</h4>";

		}
		
		if($_GET["delete"]){
			$img_id = $_GET["delete"];
			$sql = "delete from images where id =".$img_id;
			mysql_query($sql);
			echo "<h4 class='alert_success'>La imagen ha sido eliminada</h4>";
		}
	?>	
   <?php include 'upload_article_file.php'; ?>
   <article class="module width_full">
      <header>
         <h3 class="tabs_involved">Im&aacute;genes del art&iacute;culo: <?php
            echo $product_name;
            ?></h3>
      </header>
      <div class="tab_container">
         <div id="tab1" class="tab_content">
            <table class="tablesorter" cellspacing="0">
               <thead>
                  <tr>
                     <th>Imagen</th>
                     <th>Preview</th>
                     <th>Imagen principal</th>
                     <th>Descripci&oacute;n</th>
                     <th>Eliminar</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $sql = mysql_query("SELECT * FROM images WHERE product_id = ".$product_id);
                     while ($row = mysql_fetch_assoc($sql)) {
                         $image_url  = $row['image_url'];
                         $preview_url  = $row['preview_url'];
                         $product_id  = $row['product_id'];
                         $caption  = $row['caption'];
                         $id         = $row['id'];
                         $is_principal         = $row['is_principal'];
                             
                         echo "<tr>";
                         echo "<td><strong><a href='$image_url' target='_blank'><img class='preview_slideshow' src='$image_url' width='100'></a></strong></td>";
                         echo "<td><strong><a href='$preview_url' target='_blank'><img class='preview_slideshow' src='$preview_url' width='100'></a></strong></td>";
                         
                         if ($is_principal == 1)
                         	echo "<td>S&iacute;</td>";
                         
                         else
                         	echo "<td>No <a href='?principal=true&id=$product_id&image_id=$id'><br><br>Establecer como <br>imagen del mosaico</a></td>";
                         	
                         echo "<td>$caption</td>";
                         echo "<td><a href='article_images.php?delete=$id&id=$product_id'><input type='image' src='../images/icn_trash.png' title='Trash'></a></td>";
                         echo "</tr>";
                         
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
      <form action="article_images.php?id=<?php echo $product_id?>" method="POST" enctype="multipart/form-data">
         <header>
            <h3>Agregar imagen</h3>
         </header>
         <div class="module_content">
            <fieldset>
               <label>Imagen</label>
               <div style="color:red">Imagen de <strong>555px</strong> de alto por <strong>400px</strong> de ancho en formato .jpg</div>
               <input type="file" name="upload[]" id="file">
            </fieldset>
         </div>
         <div class="module_content">
            <fieldset>
               <label>Preview</label>
               <div style="color:red">Imagen de <strong>180px</strong> de alto por <strong>180px</strong> de ancho en formato .jpg</div>
               <input type="file" name="upload[]" id="file">
            </fieldset>
         </div>
		 <div class="module_content">
			<fieldset>
				<label>Descripci&oacute;n</label>
				<input type="description" name="description" maxlength="40">
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