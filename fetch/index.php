<?php

$json = file_get_contents("feed.json");
$data = json_decode($json,true);
$json = file_get_contents("latest.json");
$meta = json_decode($json,true);
$number = 0;
if(isset($meta["payload"])){
  header("location:../");
}
if(isset($data["items"])){
  header("location:../");
}

if(isset($_POST['nam'])){
    //URL of targeted site  
    $url = "https://api.rss2json.com/v1/api.json?rss_url=".$_POST['nam'];  
    $ch = curl_init();
    // set URL and other appropriate options  
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // grab URL and pass it to the browser  
    $output = curl_exec($ch);
    // close curl resource, and free up system resources  
    curl_close($ch);
    $fp = fopen("../feed.json", "w");
    fwrite($fp, $output);
    fclose($fp);
    
    if(strpos($_POST['nam'],"feed")){
        $get_url = str_replace("feed/","",$_POST['nam']);
    }
    $url = $get_url."/latest?format=json";  
    $ch = curl_init();
    // set URL and other appropriate options  
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // grab URL and pass it to the browser  
    $output = curl_exec($ch);
    // close curl resource, and free up system resources  
    curl_close($ch);
    $fp = fopen("../latest.json", "w");
    fwrite($fp, substr($output,16));
    fclose($fp);
    header("location:../");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Fetch Data from Medium</title>

<link rel="stylesheet" href="../css/material.red-blue.min.css" />
<script defer src="../js/material.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
body{
    margin: 0;
    padding: 0;
    background: #fff;
    overflow: hidden;
    color: #fff;
    font-family: Arial;
    font-size: 12px;
}
.body{
    position: absolute;
    top: -20px;
    left: -20px;
    right: -40px;
    bottom: -40px;
    width: auto;
    height: auto;
    background-image: url(../img/wallpaper.jpg);
    background-size: cover;
    -webkit-filter: blur(5px);
    z-index: 0;
}
.grad{
    position: absolute;
    top: -20px;
    left: -20px;
    right: -40px;
    bottom: -40px;
    width: auto;
    height: auto;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
    z-index: 1;
    opacity: 0.7;
}
.header{
    position: absolute;
    top: calc(50% - 35px);
    left: calc(50% - 255px);
    z-index: 2;
}
.header div{
    float: left;
    color: #fff;
    font-family: 'Exo', sans-serif;
    font-size: 35px;
    font-weight: 200;
}
.header div span{
    color: #5379fa !important;
}
.login{
    position: absolute;
    top: calc(50% - 75px);
    left: calc(50% - 50px);
    height: 150px;
    width: 350px;
    padding: 10px;
    z-index: 2;
}
::-webkit-input-placeholder{
    color: rgba(255,255,255,0.6);
}
::-moz-input-placeholder{
    color: rgba(255,255,255,0.6);
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
<body>
<div class="body"></div>
<div class="grad"></div>
<div class="header">
<div>Fetch<span>Data</span></div>
</div>
<div class="login">
<form action="" method="POST">
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" id="sample1" name="nam">
<label class="mdl-textfield__label" for="sample3" style="color:white;">URL</label>
</div>
<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" style="float:right;">
<i class="material-icons">chevron_right</i>
</button>
</form>
</div>
<script src='../js/jquery.min.js'></script>
</body>
</html>