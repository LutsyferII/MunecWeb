<?php 
    require 'config.php';
    if(!isset($_SESSION)){
    session_start();}
    echo 1;
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 72000)) {
        // last request was more than 30 minutes ago
        if(isset($_SESSION['password2'])){
            unset($_SESSION['password2']);
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();
    if(isset($_POST['password']) || isset($_SESSION['password2'])){
        echo 2;
        if($_POST['password']==ADMIN_PASSWORD_3 || isset($_SESSION['password2']) && $_SESSION['password2']==ADMIN_PASSWORD_3){
            
            
            
            echo 3;
            date_default_timezone_set("Europe/Moscow");
            $_SESSION['password2']=ADMIN_PASSWORD_3;
            $title=$_POST['title'];
            $body=$_POST['body'];
            if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK)
            {
                $name = "img_news/" . $_FILES["filename"]["name"];
                move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
                echo "Файл загружен";
            }else{
                echo "А кампот?";
                exit;
            }
            $date=date('d.m.Y H:i');
            echo $date;
            class MyDB extends SQLite3 {
                function __construct() {
                   $this->open('news.db');
                }
              }
            $db = new MyDB();
            if(!$db){
                echo $db->lastErrorMsg();
            }
            $sql ="
            INSERT INTO news VALUES(NULL,'".$title."','".$body."','".$name."','./news.php','".$date."');
              ";
            $ret = $db->query($sql);
            header("Location: ./zapoln_SQL.php");
            exit;



        }else{
            echo "pizda";
        }
    }else{
        echo "huy";
    }


?>