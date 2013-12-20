<div class="footer-class1"></div>
</div>
<div class="footer-class2">
   <footer>
         <div class="barra-footer">
         <img src="images/logo_footer.jpg"/>
      </div>
      <br/>
      <div class="footer-info">
         <i>
         	<?php
         		$sql = mysql_query("SELECT param_value FROM config_param where param_key='FOOTER.TEXT'");
				$data = mysql_fetch_assoc($sql);
				$footer_text = $data['param_value'];
				echo $footer_text;
         	?>
         </i>
      </div>
   </footer>
</div>
