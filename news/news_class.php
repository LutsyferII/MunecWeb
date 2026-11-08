<?php 
include("../classes.php");
class NewsPage extends Page{
    var $buttons = array("Home"=>"../index.php","Контакты"=>"../contact.php","Вики"=>"../wiki.php","Ссылкт"=>"../cart.php");
    var $style_file = "../Munec.css";
    var $url_gif = "../Munec_Site.png";  
    var $side_left=true;
    var $side_right=true;
    var $script= "../scroll_content.js";
    var $script_news_db="../news_db.js";
    var $titles;


}



?>