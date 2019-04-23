<?php $json = file_get_contents("feed.json"); $data = json_decode($json,true); ?>
<!DOCTYPE html>
<html>
    <head><title>Medium Posts by Nirav Madariya</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="./css/material.blue-orange.min.css">
      <link rel="stylesheet" href="./css/site.css">
      <link type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
      <script defer src="./js/material.min.js"></script>
      <script type="text/javascript" src="./js/jquery.min.js"></script>
      <style>
            body {font-family: 'Poppins', sans-serif; font-weight:400; font-size: 12px; background-color: #eee;}
      </style>
    </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Medium posts by <b>Nirav Madariya</b></span>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class="mdl-navigation__link" href="https://medium.com/@niravmadariya">Medium</a>
            <a class="mdl-navigation__link" href="">Twitter</a>
            <a class="mdl-navigation__link" href="">LinkedIn</a>
            <a class="mdl-navigation__link" href="">Instagram</a>
          </nav>
        </div>
      </header>
      <main class="mdl-layout__content">
        <div class="page-content">
          <div class="mdl-grid">
            <ul class="demo-list-control mdl-list">
            <?php for($i=((count($data["items"]))-1);$i>=0;$i--){ 
            if(!count($data["items"][$i]["categories"])){
                continue;
            }; ?>
              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                  <i class="material-icons" style="margin-right: 20px;">playlist_add</i>
                  <a style="text-decoration: none;" target="_blank" href=<?php echo "./?post=".($i+1).">".$data["items"][$i]["title"]; ?></a>
                </span>
                <span class="mdl-list__item-secondary-action">
                </span>
              </li>
          <?php } ?>
            </ul>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>