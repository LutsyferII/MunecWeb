<?php 
include("news_class.php");
$page = new NewsPage;
$page->SwitchSideLeft();
$page->SwitchSideRight();
$content;
$page->Display();







?>