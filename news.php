<?php 
include("classes.php");
$page = new Page;
$page->SwitchSideLeft();
$page->SwitchSideRight();
$page->ExcludeScript(0);
$page->script="lalka";
$content;
$titles;
$bodys;//explode("|",$all_news_tags[2]);
$img_urls;//explode("|",$all_news_tags[4]);
if(!isset($_GET['news_id'])){
    $content ="Пиздец(";
    $page->SetContent($content);
    $page->Display();
    exit;
}
$news_id=$_GET['news_id'];

class MyDB extends SQLite3 {
  function __construct() {
     $this->open('news.db');
  }
}
$db = new MyDB();
if(!$db){
  echo $db->lastErrorMsg();
}
$stmt = $db->prepare("SELECT * FROM news WHERE ID = :id ORDER BY ID DESC LIMIT 10");
$stmt->bindValue(':id', $news_id, SQLITE3_INTEGER);
$ret = $stmt->execute();
$row = $ret->fetchArray(1);
if(isset($row["ID"])){
$img_url=$row["img_url"];
$title=$row["titles"];
$body=$row["bodys"];
$date=$row["date"];
$content="
<style>
@media screen and (max-width: 1000px){
  .ramka_cont{
    padding:0;
    margin-top:15px;
  }
}

</style>
<div class='div_img_news'>
<img src='".$img_url."' class='img_in_news'>
</div>

<div class='text_news'>
<div class='date_in_news'>".$date."
</div>
<h2>".$title."</h2><p>".$body."
</div>";

}else{
  $content="Ты чо, упоротый? Зачем ты там тыкаешь?";
}






$page->SetContent($content);

$page->Display();



?>
