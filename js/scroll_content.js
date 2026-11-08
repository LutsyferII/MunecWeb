// «База данных»

//const fs = require("fs");
//let file = new File()
//var f = new FileReader();
//f.onload = function(e) {
//  typ=e.target.result ;
//};
//f.readAsText("news_db.txt");
//let filename = "news_db.txt";
//let str = fs.readFileSync(filename,'utf8');
//let typ = str.split("\n");
const sqlPromise = initSqlJs({
  locateFile: file=> '../news.db'
});
function toBinString (arr) {
	var uarr = new Uint8Array(arr);
	var strings = [], chunksize = 0xffff;
	// There is a maximum stack size. We cannot call String.fromCharCode with as many arguments as we want
	for (var i=0; i*chunksize < uarr.length; i++){
		strings.push(String.fromCharCode.apply(null, uarr.subarray(i*chunksize, (i+1)*chunksize)));
	}
	return strings.join('');
}


function toBinArray (str) {
	var l = str.length,
			arr = new Uint8Array(l);
	for (var i=0; i<l; i++) arr[i] = str.charCodeAt(i);
	return arr;
}



const dataPromise = fetch ("../news.db").then(res=>res.arrayBuffer());
const [SQL, buf]= await Promise.all([sqlPromise,dataPromise])
let db = new SQL.Database(new Uint8Array(buf));
window.localStorage.setItem("mydata", toBinString(db.export()));
db = new SQL.Database(toBinArray(localStorage.getItem("mydata")));
//var temp = db.run("SELECT * from news ORDER BY ID DESC;");
var length_db = db.exec("SELECT COUNT(*) FROM news")[0].values[0][0];


let ids=[];
let titles = [];
let bodys = [];
let img_url=[];
let urls=[];
let dates =[];
var i=0;
var count_limit=10;
//for(var i=0;i<length_db;i++){}

console.log(titles);



//var a = await fetch("/news.db")
//let tex = await a.text();
//let typ = tex.split("-|-");
//let titles= typ[0].split("|");
//let bodys=typ[1].split("|");
//et img_url=typ[2].split("|");
let post = {
    title: titles[0],
    body: 'Т.',
    div: '<a><h2></h2><p></p></a>'
  }

  // «Сервер API»

  const server = {
    posts(page = 2) {
      if(i%5==0){
        console.log(i);
        var zapros = "SELECT * FROM news ORDER BY id DESC limit "+count_limit+", 5 ";
        var lal = db.exec(zapros);
        for(var j=0;j<5;j++){
          if(typeof(lal[0]['values'][j])!='undefined'){
          //console.log(lal[0]['values'][j][0])
          ids.push(lal[0]['values'][j][0])
          titles.push(lal[0]['values'][j][1])
          bodys.push(lal[0]['values'][j][2])
          img_url.push(lal[0]['values'][j][3])
          urls.push(lal[0]['values'][j][4])
          dates.push(lal[0]['values'][j][5])
          }

        }


      }
      //console.log("count_limit="+count_limit)
      //console.log("i="+i)
      
      
      //console.log(lal);
      

      
      //console.log(page);
      //console.log(bodys[i]);
      //console.log(titles[page+8])
      //console.log(bodys[page+8].length)
      if(bodys[i].length>100){
        bodys[i]=bodys[i].substr(0, 100);
        bodys[i]+="..."
      }
      
      if(titles[i].length>40){
        titles[i]=titles[i].substr(0, 40);
        titles[i]+="..."
      }
      var substr_count = bodys[i].split('<br>').length - 1;
      if(substr_count>=2){
        const regex = /^((?:(?!<br>)(.|\n))*<br>(?:(?!<br>)(.|\n))*<br>)/;
        const str = bodys[i];
        let m;
        if ((m = regex.exec(str)) !== null) {
          // The result can be accessed through the `m`-variable.
          bodys[i]=m[0];
          bodys[i]+="...";
      }
      
      }
      //console.log(bodys[i]);
      
      
      
      //console.log(bodys[page+8].length)
      const finished = i >= length_db-11
      const next = finished ? null : page + 1

      post = {
        title: titles[i],
        body: bodys[i],
        div: '<a href="./news.php?news_id='+ids[i]+'"><div class="news"><div class="news_img_div"><img src="'+img_url[i]+'" class="news_url"></div><div class="news_text">'+dates[i]+'<article class="post"><h2 class="ahuevshiy_h2"></h2><p></p></article></div></div></a>'
      }
      i++;
      count_limit++;
      let posts = Array(1).fill(post)
    
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve({posts, next})
        }, 0)
      })}
      
    
    
  }

  // Клиент

  let nextPage = 2
  let isLoading = false
  let shouldLoad = true

  function appendPost(postData) {
    if (!postData) return;
    const main = document.querySelector('main')
    const postNode = composePost(postData)
    main.append(postNode)
  }

  function composePost(postData) {
    if (!postData) return
    const template = document.getElementById('post_template')
    const post = template.content.cloneNode(true)

    const {title, body, div} = postData
    //post.querySelector('a').innerHTML = a
    post.querySelector('div').innerHTML = div
    post.querySelector('h2').innerText = title
    post.querySelector('p').innerText = body



    return post
  }

  async function fetchPosts() {
    if (isLoading || !shouldLoad) return
    isLoading = true

    const {posts, next} = await server.posts(nextPage)
    nextPage = next

    posts.forEach(appendPost)

    // Здесь можно менять адресную строку,
    // чтобы сохранить положение прокрутки.

    if (!next) shouldLoad = false
    isLoading = false
  }

  function throttle(callee, timeout) {
    let timer = null

    return function perform(...args) {
      if (timer) return

      timer = setTimeout(() => {
        callee(...args)

        clearTimeout(timer)
        timer = null
      }, timeout)
    }
  }

  async function checkPosition() {
    const height = document.body.offsetHeight
    const screenHeight = window.innerHeight
    const scrolled = window.scrollY

    const threshold = height - screenHeight / 4
    const position = scrolled + screenHeight

    if (position >= threshold) {
      await fetchPosts()
    }
  }

  (() => {
    window.addEventListener('scroll', throttle(checkPosition))
    window.addEventListener('resize', throttle(checkPosition))
  })()




























