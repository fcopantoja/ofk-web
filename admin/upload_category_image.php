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

?>

<?php

if ($_FILES['upload'] && sizeof($_FILES['upload']) > 0) {
    $file_ary = reArrayFiles($_FILES['upload']);
    
    $sql = mysql_query("SELECT * FROM config_param WHERE param_key='UPLOADED.FILES.DIR'");
    $row = mysql_fetch_array($sql);
    $dir = $row['param_value'];
        
    $sql        = mysql_query("SELECT * FROM config_param WHERE param_key='SERVER.URL'");
    $row        = mysql_fetch_array($sql);
    $server_url = $row['param_value'];
    
    $image_url   = $server_url . $dir . $file_ary[0]["name"];
    $preview_url = $server_url . $dir . $file_ary[1]["name"];
    $description = htmlentities($_POST["description"],ENT_QUOTES,'UTF-8');
    
    move_uploaded_file($file_ary[0]["tmp_name"], "../" . $dir . $file_ary[0]["name"]);
    move_uploaded_file($file_ary[1]["tmp_name"], "../" . $dir . $file_ary[1]["name"]);
    
    $sql = "insert into images(image_url, preview_url, product_id, caption) values('$image_url', '$preview_url', $product_id, '$description')";
    mysql_query($sql);
    
    echo "<h4 class='alert_success'>Las im&aacute;genes han sido guardadas</h4>";
      
}

?>
