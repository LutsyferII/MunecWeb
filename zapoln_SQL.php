<?php 
if(!isset($_SESSION)){
session_start();}
include("classes.php");
$page = new Page;
$page->SwitchSideLeft();
$page->SwitchSideRight();
$page->script="lalka";
$content;
$titles;
$bodys;//explode("|",$all_news_tags[2]);
$img_urls;//explode("|",$all_news_tags[4]);

echo "<link href='css/zapoln.css'rel=\"stylesheet\">";



require 'config.php';
if(isset($_POST['password'])||isset($_SESSION['password1'])){
  if(isset($_POST['password'])){
  $password=$_POST['password'];}
  else{$password = "huy";}
  if($password==ADMIN_PASSWORD_2 || $_SESSION['password1']=ADMIN_PASSWORD_2){
    $_SESSION['password1'] = $password;
    






















  }else{
    $content="Пароль неверный, попробуй ещё раз или пиздуй отсюда.";
    $page->SetContent($content);
    $page->Display();
    exit;
  }
}else{
  $content="Ну и что ты тут делаешь?";
    $page->SetContent($content);
    $page->Display();
    exit;
}




$content='
<script>
const inputElement = document.getElementById("file");
inputElement.addEventListener("change", handleFiles, false);
function handleFiles(files) {
  const fileList = this.files; /* now you can work with the file list */
  var file = files[0];
  console.log(file);
  var img = document.createElement("img");
  img.classList.add("zapoln_img_img");
  img.file = file;
  preview.appendChild(img);
  var reader = new FileReader();
  
  if (file && file.type.match("image.*")) {
    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
    reader.readAsDataURL(file);
    img.css("width", "100px");
  }else{
      img.css("display", "none");
      img.attr("src", "");
  }
 
}
</script>
<form action="obrab_SQL.php" method=post enctype="multipart/form-data">
<div class="zap_sql" >
  <div class="zapoln_pass">
    <input  type="password" name="password" size=3 maxlength=100 class="zapoln_input_pass">
  </div>
  <div class="zapoln_div_zag">
    <input  class="zapoln_input_zag" type="text" name="title" placeholder="Заголовок" size=10 maxlength=100>
  </div>
  <div class="zapoln_body">
    <textarea class="zapoln_input_body" id="body" name="body" rows="10" maxlength=1000 placeholder="Текст новости" ></textarea>
  </div>
  <div class="zapoln_file">
    Выберите файл:<br><input class="zapoln_input_file" type="file" id="file" name="filename" size="10" accept="image/png, image/jpeg" onchange="handleFiles(this.files)"/><br /><br />
    <div id="preview"></div>
    </div>
  <div class="zapoln_submit">
  <input class="zapoln_sub" type=submit value="Submit Order">
  </div>
</div>
</form>';








$page->SetContent($content);

$page->Display();



?>
