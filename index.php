<?php
include 'RSSService.php';

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css" />

    <title>RSS Read</title>
</head>
<body >
<form method="get">
<div class="" style="background-color:#F5F5F5;">
    <div class="row justify-content-center" style="margin: 0">
        <div class="container">
            <div class="m-5 border bg-white rounded-3  shadow row justify-content-center">
                <div class="row justify-content-center m-4">
                    <div class="col-9 my-2 row justify-content-center">
                        <h5 class="col-9 my-3 ms-2 text-secondary">URL</h5>
                        <div class="col-10 row mx-5 mb-5 justify-content-center">
                            <input name="url" type="text" class="col-8 rounded border border-3 border-muted">
                            <button class="btn-lg btn btn-primary ms-5 col-2"  type="submit">Add</button>
                        </div>
                    </div>
                    <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    			$xxx=$_GET["url"];
			$logFile = fopen('text', 'w');
   			$ch = curl_init();
   			curl_setopt($ch, CURLOPT_URL,$xxx);
   			curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 			Safari/537.17');
    			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    			curl_setopt($ch, CURLOPT_VERBOSE, 1);
    			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    			curl_setopt($ch,CURLOPT_STDERR,$logFile);
    			$html = curl_exec($ch);
    			curl_close($ch);
	
   			$xx=RSSService::ParseXml($html);
    			$array=RSSService::getAttributes($xx);	
                        RSSService::PopulateHTML($array);                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

