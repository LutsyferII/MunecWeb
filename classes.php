<script src="path/to/jquery.min.js"></script>
<?php class Page{
    var $content;
    var $left_content;
    var $right_content;
    var $title = "Мюнек";
    var $keywords ="Майнкрафт, RPG, MMORPG";
    var $buttons = array("Home"=>"index.php","Контакты"=>"contact.php","Вики"=>"wiki.php","Ссылки"=>"cart.php");
    var $style_file = "Munec.css";
    var $url_gif = "Munec_Site.png";  
    var $side_left=true;
    var $side_right=true;
    var $script= "js/scroll_content.js";
    var $script_news_db="js/news_db.js";
    var $scripts= array(array("module","js/scroll_test.js"),array("text/javascript","js/menu_open.js"));
    
    var $titles;
    function ExcludeScript($j){
        if(isset($this->scripts[$j])){
            unset($this->scripts[$j]);
        }
    }
    function SwitchSideLeft(){
        if($this->side_left==true){
            $this->side_left=false;
        }else{
            $this->side_left=true;
        }
    }
    function SwitchSideRight(){
        if($this->side_right==true){
            $this->side_right=false;
        }else{
            $this->side_right=true;
        }
    }
    function SetLogoGif($some_shit){
        $this->url_gif=$some_shit;
    }
    function SetContent($some_shit){
        $this->content=$some_shit;
    }
    function SetLeftContent($some_shit){
        $this->left_content=$some_shit;
    }
    function SetRightContent($some_shit){
        $this->right_content=$some_shit;
    }
    function SetTitle($some_shit){
        $this->title=$some_shit;
    }
    function SetKeywords($some_shit){
        $this->keywords=$some_shit;
    }
    function SetButtons($some_shit){
        $this->buttons=$some_shit;
    }
    function DisplayHeader(){
        include("header.inc");
    }
    function DisplayFooter(){
        include("foot.inc");
    }
    function DisplayStyles(){
        echo "<link href=\"$this->style_file\"rel=\"stylesheet\">";
    }
    function DisplayTitle(){
        echo"<title> $this->title</title>";
    }
    function DisplayKeywords(){
        echo "<META name=\"keywords\" content=\"$this->keywords\">";
    }
    function DisplayMenu(){
        
        echo
        "<header id=header class=header>
        <table width =\"100%\" cellpadding=4 cellspacing=4 class=hh>
            <tr height=20px>
                <td class=button_head><a href=\"";echo current($this->buttons);echo "\" class='ssilka_menu' shape='rect'><div class=menu>".key($this->buttons); next($this->buttons);echo "</div></a></td>
                <td class=button_head><a href=\"";echo current($this->buttons);echo "\"><div class=menu>".key($this->buttons); next($this->buttons);echo "</div></a></td>
                <td class=button_head><a href=\"";echo current($this->buttons);echo "\"><div class=menu>".key($this->buttons); next($this->buttons);echo "</div></a></td>
                <td class=button_head><a href=\"";echo current($this->buttons);echo "\"><div class=menu>".key($this->buttons); reset($this->buttons);echo " </div></a><script src=\"http://code.jquery.com/jquery-latest.js\"></script><div class='cartM' id='cartVis'></div></td>
            </tr>

        </table>
        </header>";
    }
    function Display(){
        echo "<html>\n<head>\n";
        $this->DisplayTitle();
        for($i=0;$i<count($this->scripts);$i++){
            $temp = current($this->scripts);
            echo '<script type="'.$temp[0].'" src='.$temp[1].'></script>';
            next($this->scripts);
            //if(isset($this->scripts[$i])){
            //echo '<script type="'.$this->scripts[$i][0].'" src='.$this->scripts[$i][1].'></script>';
            //}
        }


        echo $this->titles;
        $this->DisplayKeywords();
        $this->DisplayStyles();

        echo "</head>\n<body>\n";
        next($this->buttons);
        echo "<div class=menu_close id=menu>
                <a href='".current($this->buttons)."'class=side_menu_1><div >".key($this->buttons);next($this->buttons);echo"</div></a>
                <a href='".current($this->buttons)."'class=side_menu_1><div >".key($this->buttons);next($this->buttons);echo"</div></a>
                <a href='".current($this->buttons)."'class=side_menu_1><div >".key($this->buttons)."</div></a>
        
            </div>
            <div class=icon_menu id=menu_i onclick=sideMenu()><div class=icon_menu_pod id=imp_1></div><div class=icon_menu_pod id=imp_2></div><div class=icon_menu_pod id=imp_3></div></div>";
        reset($this->buttons);
        $this->DisplayHeader();
        $this->DisplayMenu($this->buttons);
        echo "<div class=main><div class='main main_menu'><div class=left_main>";if($this->side_left==true){echo"<div class=leftside_content>".$this->left_content."</div>";}echo"</div><div class=cont_main><div class=absol_ramka></div><div class=absol_mid_ramka></div><div class=absol_niz_ramka></div><div class=main_content><div class=ramka_cont>";if(is_array($this->content)){foreach($this->content as $znach){echo $znach;}}else{echo $this->content;};echo "</div></div></div><div class=right_main>";if($this->side_right==true){echo"<div class=rightside_content>".$this->right_content."</div>";}echo"</div></div></div>";
        $this->DisplayFooter();
    }

}
?>