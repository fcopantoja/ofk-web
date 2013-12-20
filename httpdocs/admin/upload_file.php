<?php
$allowedExts = array(
    "gif",
    "jpeg",
    "jpg",
    "png"
);
$temp        = explode(".", $_FILES["file"]["name"]);
$extension   = end($temp);

if ($_FILES["file"]) {
    
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    } else {
        
        if (file_exists("../upload/" . $_FILES["file"]["name"])) {
            echo "<h4 class='alert_warning'>El archivo con nombre " . $_FILES["file"]["name"] . " ya existe. </h4>";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
            
            if (isset($_POST['product_id'])) {
                
                $product_id = $_POST["product_id"];
                
                $sql = mysql_query("SELECT * FROM config_param WHERE param_key='SERVER.URL'");
        		$row = mysql_fetch_array($sql);
        		$server_url = $row['param_value'];
        		
        		$sql = mysql_query("SELECT * FROM config_param WHERE param_key='UPLOADED.FILES.DIR'");
        		$row = mysql_fetch_array($sql);
        		$dir = $row['param_value'];
        		
                $image_url        = $server_url.$dir.$_FILES["file"]["name"];
                
                $sql = "insert into home_slideshow(image_url, product_id, created_at) values('$image_url', $product_id, NOW())";
                
                mysql_query($sql);
                echo "<h4 class='alert_success'>El item del slideshow ha sido creado</h4>";
            }
            
        }
    }
}

?>