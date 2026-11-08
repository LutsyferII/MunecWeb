function sideMenu(){
    var menuBox = document.getElementById("menu");
    var menu = document.getElementById("menu_i");
    var imp = document.getElementById("imp_1");
    var imp_2 = document.getElementById("imp_2");
    var imp_3 = document.getElementById("imp_3");
    if(menuBox.className == "menu_open"){
        menuBox.className = "menu_close";
        menu.style.left = "20px";
        imp.style.transform = "rotate(0deg)"
        imp_2.style.transform = "rotate(0deg)"
        imp_3.style.display= "block"
        imp.style.top="0"
        imp_2.style.top="0"

    }else{
        menuBox.className = "menu_open";
        menu.style.left = "400px";
        imp.style.transform = "rotate(45deg)"
        imp_2.style.transform = "rotate(-45deg)"
        imp_3.style.display= "none"
        imp.style.top="25px"
        imp_2.style.top="-9px"

    }
    

    
}