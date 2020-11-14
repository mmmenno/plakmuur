<?php

$headers = get_headers($_GET['url'], 1);
$type = $headers["Content-Type"];


header("Content-type: " . $type);

$image = file_get_contents($_GET['url']);
echo $image;


?>