<?php include 'layout.php'; ?>
<section id="main" class="column">
		
		<h4 class="alert_info">Bienvendio al Administrador de OFK Designs</h4>
		
		<article class="module width_full">
			<header><h3>Estad&iacute;sticas</h3></header>
			<div class="module_content">
				<article class="stats_graph">
					<img src="../images/Pagina6/personalizados.jpg" height="140" alt="" />
				</article>
				
				<?php
						$sql = mysql_query("SELECT count(*) as total FROM visits");
						$data = mysql_fetch_assoc($sql);
						$total = $data['total'];
						
						$sql = mysql_query("SELECT count(*) as total FROM visits WHERE DATE(created_at) = CURDATE();");
						$data = mysql_fetch_assoc($sql);
						$total_today = $data['total'];
						
						$sql = mysql_query("SELECT count(*) as total FROM products");
						$data = mysql_fetch_assoc($sql);
						$total_products = $data['total'];
				?>
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Visitas</p>
						<p class="overview_count"><?php echo $total_today;?></p>
						<p class="overview_type">Hoy</p>
						<p class="overview_count"><?php echo $total?></p>
						<p class="overview_type">Total</p>
					</div>
					<div class="overview_previous">
						<p class="overview_day">Art&iacute;culos</p>
						<p class="overview_count"><?php echo $total_products?></p>
						<p class="overview_type">Total</p>

					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		

		<div class="spacer"></div>
	</section>
</body>
</html>