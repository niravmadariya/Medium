<?php
$json = file_get_contents("feed.json");
$data = json_decode($json,true);
$json = file_get_contents("latest.json");
$meta = json_decode($json,true);
$number = 0;
if(isset($_GET['post'])){
  $number = $_GET['post']>0?$_GET['post']-1:$_GET['post'];
  if(empty($data["items"][$number]["categories"])){ //skipping showing comments, and jumping to next story. //need a little fix here as $number for comment and next story will be same.
    $number++;
  }
}
if($number > count($data["items"])){
  exit("No Post Found!!!");
}
if(!isset($meta["payload"])){
  header("location:./fetch/");
}
if(!isset($data["items"])){
  header("location:./fetch/");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Latest Medium Post by Nirav Madariya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./css/material.blue-orange.min.css">
    <link rel="stylesheet" href="./css/site.css">
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <script defer src="./js/material.min.js"></script>
    <script type="text/javascript" src="./js/jquery.min.js"></script>
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Blog | Nirav Madariya</span>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class="mdl-navigation__link" target="_blank" href="<?php echo $meta["payload"]["userNavItemList"]["userNavItems"][0]["url"]; ?>">Medium</a>
            <a class="mdl-navigation__link" target="_blank" href="<?php echo "https://twitter.com/".$meta["payload"]["user"]["twitterScreenName"]; ?>">Twitter</a>
            <a class="mdl-navigation__link" target="_blank" href="https://linkedin.com/in/niravmadariya">LinkedIn</a>
            <a class="mdl-navigation__link" target="_blank" href="https://instagram.com/niravmadariya">Instagram</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">All Posts</span>
      <nav class="mdl-navigation">
      <?php for($i=((count($data["items"]))-1);$i>=0;$i--){ 
            if(!count($data["items"][$i]["categories"])){
                continue;
            }; ?>
        <a class="mdl-navigation__link" href=<?php echo "./?post=".($i+1).">".$data["items"][$i]["title"]; ?></a>
        <?php } ?>
      </nav>
    </div>
      <main class="mdl-layout__content">
        <div class="page-content">
            <div class="floating-button">
                <div class="center">
                    <div style="float: right;">
                        <img src="./img/thumbs.png" style="width: 100%;" /><br />
                        <p style="font-size: 16px;" class="center">
                          <?php echo $meta["payload"]["references"]["Post"][substr($data["items"][$number]["guid"],(strrpos($data["items"][$number]["guid"],"/"))+1)]["virtuals"]["totalClapCount"]; ?>
                        </p>
                    </div>
                </div>
                <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect medium-button" target="_blank" href="<?php echo $data["items"][$number]["guid"]; ?>"></a>
            </div>
          <div class="mdl-grid center">
              <div class="mdl-cell mdl-cell--9-col mdl-cell--10-col-tablet">
                  <div class="story-card mdl-card mdl-shadow--2dp">
                      <h3>
                        <?php echo $meta["payload"]["references"]["Post"][substr($data["items"][$number]["guid"],(strrpos($data["items"][$number]["guid"],"/"))+1)]["title"]; ?>
                      </h3>
                      <div class="header">
                          <div>
                              <img src="<?php echo $data["feed"]["image"]; ?>" class="profilepic" />
                          </div>
                          <div>
                              <ul>
                                  <li><a href="<?php echo substr($data["items"][$number]["link"],0,strrpos($data["items"][$number]["link"],"/")); ?>" ><?php echo $data["items"][$number]["author"]; ?></a></li>
                                  <li> <?php
                                  $monthNum  = substr($data["items"][$number]["pubDate"],5,2);
                                  $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
                                  $monthName = substr($monthName,0,3);
                                  echo $monthName." ".substr($data["items"][$number]["pubDate"],8,2);
                                  ?> </li>
                              </ul>
                          </div>
                      </div>
                      <div class="content">
                          <?php echo $data["items"][$number]["description"]; ?>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>