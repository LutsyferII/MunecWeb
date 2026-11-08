<?php
if(isset($_GET["page"]) && $_GET["page"]!="index"){
    $page_name=$_GET["page"].".php";
    require ($page_name);
    //header("Location: cart.php");
    exit;
}
?>
<?php 
include("classes.php");
$page = new Page;
echo "<script src='js/sql-asm.js'></script>";

$titles = array();
$bodys = array();//explode("|",$all_news_tags[2]);
$img_urls= array();//explode("|",$all_news_tags[4]);
$news_ids=array();
$dates=array();

class MyDB extends SQLite3 {
  function __construct() {
     $this->open('news.db');
  }
}
$db = new MyDB();
if(!$db){
  echo $db->lastErrorMsg();
}
$sql =<<<EOF
SELECT * from news ORDER BY ID DESC limit 10;
EOF;
$ret = $db->query($sql);
//echo "HUY ".$row['ID']."\n";
//while($row = $ret->fetchArray(SQLITE3_ASSOC)){
 // echo "HUY ".$row['titles']."\n";
  //array_push($titles,$row['titles']);}
//$row = $ret->fetchArray(SQLITE3_ASSOC);
//var_dump($row);
$data = array();
while($row = $ret->fetchArray(1)) {
    array_push($titles,$row['titles']);
    array_push($bodys,$row['bodys']);
    array_push($img_urls,$row['img_url']);
    array_push($news_ids,$row['ID']);
    array_push($dates,$row['date']);
    
  
  }
array_reverse($titles);
array_reverse($bodys);
array_reverse($img_urls);
array_reverse($dates);

$db->close();

$content ="
<main id=temp_news>

";
for($i=0;$i<=9;$i++){
  if(strlen($bodys[$i])>100){
    $bodys[$i]=mb_substr($bodys[$i],0,100);
    $bodys[$i].="...";
}
  if(substr_count($bodys[$i],"<br>")>=2){
    //var_dump($bodys[$i]);echo "<br>";
    //preg_match_all('/(?:[[:alpha:]]|[[:space:]])*<br>(?:[[:print:]]|\n)*/',$bodys[$i], $lal);
    preg_match('/^((?:(?!<br>)(.|\n))*<br>(?:(?!<br>)(.|\n))*<br>)/',$bodys[$i], $lal);
    $lal[0]=substr($lal[0],0,-4);
    $bodys[$i]=$lal[0]."...";
    //var_dump($lal);
    //echo "<br>".$lal[0]."<br>";
  }
  if(strlen($titles[$i])>40){
    $titles[$i]=mb_substr($titles[$i],0,40);
    $titles[$i].="...";
}
  $content.="
  <a href='./news.php?news_id=".$news_ids[$i]."'>
  <div class='news'>
  <div class='news_img_div'>
  <img src='".$img_urls[$i]."' class='news_url'>
  </div>
  <div class='news_text'>
  ".$dates[$i]."
  <article class='post'>
    <h2 class='ahuevshiy_h2'>".$titles[$i]."</h2>
    <p>".$bodys[$i]."</p>
    
  </article>
  </div>
  </div></a>
  ";
}

$content .='<div></main><template id="post_template">
<div>

<div>
</template>
';
$side_content="boob";
$page->SetLeftContent($side_content);
$page->SetContent($content);
$page->SetRightContent($side_content);
//$page->SwitchSideLeft();
//$page->SwitchSideRight();
$page->Display();

?>



<?php      
$operaciaZapuska = `ls -la`;
echo "<pre>".$operaciaZapuska."</pre>";

?>




