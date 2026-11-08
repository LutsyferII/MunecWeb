<?php 
include("classes.php");
$page = new Page;
$page->SwitchSideLeft();
$page->SwitchSideRight();
$page->script="lalka";
$content;
$titles;
$bodys;//explode("|",$all_news_tags[2]);
$img_urls;//explode("|",$all_news_tags[4]);
if(!isset($_GET['password'])){
    $content ="Пиздец(";
    $page->SetContent($content);
    $page->Display();
    exit;
}elseif($_GET['password']!="IdiKaTyNahuy"){
    echo "А ну пиздуй отсюда!";
    exit;
}

$content='<form action="zapoln_SQL.php" method=post class=d_d>
<input  type="password" name="password" size=3 maxlength=100>
<input type=submit value="Submit Order">
</form>
';
$page->SetContent($content);

$page->Display();



?>
<form action="zapoln_SQL.php" method=post>
<input  type="password" name="password" size=3 maxlength=100>
<input type=submit value="Submit Order">
</form>

