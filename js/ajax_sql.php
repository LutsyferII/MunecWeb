<?php
    if(isset($_POST["count"])){
        $count=$_POST["count"];


        class MyDB extends SQLite3 {
            function __construct() {
               $this->open('../news.db');
            }
        }
        $db = new MyDB();
        if(!$db){
            echo $db->lastErrorMsg();
        }
        $sql_c= "SELECT COUNT(*) FROM news";
        $cont =$db->query($sql_c);
        $i_count = $cont->fetchArray();
        $i_count = $i_count[0];



        



        



        if($count<=$i_count){
            $content="";
            $titles = array();
            $bodys = array();//explode("|",$all_news_tags[2]);
            $img_urls= array();//explode("|",$all_news_tags[4]);
            $news_ids=array();
            $dates=array();

            $sql ="
                SELECT * from news ORDER BY ID DESC limit ".$count.", 5;
                ";
            $ret = $db->query($sql);
            while($row = $ret->fetchArray(1)) {
                if(strlen($row['bodys'])>100){
                    $row['bodys']=mb_substr($row['bodys'],0,100);
                    $row['bodys'].="...";
                }
                array_push($titles,$row['titles']);
                array_push($bodys,$row['bodys']);
                array_push($img_urls,$row['img_url']);
                array_push($news_ids,$row['ID']);
                array_push($dates,$row['date']);
                
                
              
              }
              $db->close();
            for($i=0;$i<5;$i++){
                
            
            
            if(isset($news_ids[$i])){
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
                ";}
        }
        echo $content;
        }else{
            echo false;
        }






    }













?>