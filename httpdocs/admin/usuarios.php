<?php include 'layout.php'; ?>
<script type="text/javascript">
function validateForm(){
var x = document.forms["userForm"]["name"].value;
var y1 = document.forms["userForm"]["password"].value;
var y2 = document.forms["userForm"]["repeatpassword"].value;
var z = document.forms["userForm"]["email"].value;

	if (x == null || x == "") {
  		alert("El nombre de usuario no debe estar vacio");
  		return false;
	}
	if (y1 == null || y1 == "") {
  		alert("El password no debe estar vacio");
  		return false;
	}
	if (y1 != y2) {
  		alert("Los passwords deben de ser iguales");
  		return false;
	}
	if (z == null || z == "") {
  		alert("El correo no debe estar vacio");
  		return false;
	}
}

</script>
<section id="main" class="column">

	<?php
		if($_GET["delete"]){
			$user_id = $_GET["delete"];
			$sql = "delete from users where id =".$user_id;
			mysql_query($sql);
			echo "<h4 class='alert_success'>El usuario ha sido eliminado</h4>";
		}
		if( isset($_POST['name']) ){
		
			$name = $_POST["name"];
			$password = $_POST["password"];
			$email = $_POST["email"];

			$sql = "insert into users(username, password, email) values('$name', '$password', '$email')";			
			mysql_query($sql);
			echo "<h4 class='alert_success'>El usuario ha sido creado</h4>";
		}
	?>
	
	<article class="module width_full">
		<header>
			<h3 class="tabs_involved">Lista de usuarios</h3>
		</header>
		

		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<table class="tablesorter" cellspacing="0">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql = mysql_query("SELECT * FROM users");
    					while ($row = mysql_fetch_assoc($sql)) {
        					$user_id = $row['id'];
        					$username = $row['username'];
        					$email = $row['email'];
        					echo "<tr><td><strong>$username</strong></td><td>$email</td><td><a href='usuarios.php?delete=$user_id'><input type='image' src='../images/icn_trash.png' title='Trash'></a></td></tr>";
    					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</article>
	
	<article class="module width_full">
			<form action="usuarios.php" name="userForm" method="POST" onsubmit="return validateForm()">
			<header><h3>Agregar nuevo usuario</h3></header>
				<div class="module_content">
						<fieldset>
							<label>Nombre de usuario</label>
							<input type="text" name="name">
						</fieldset>
						
				</div>
				<div class="module_content">
						<fieldset>
							<label>Password</label>
							<input type="password" name="password">
						</fieldset>
				</div>
				<div class="module_content">
						<fieldset>
							<label>Confirmar password</label>
							<input type="password" name="repeatpassword">
						</fieldset>
				</div>
				<div class="module_content">
						<fieldset>
							<label>E-MAIL</label>
							<input type="text" name="email">
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