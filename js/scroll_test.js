
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
  
  
  
  var i=0;
  var count_limit=10;
  //for(var i=0;i<length_db;i++){}
  var laki="";
  var temmm=true;
  function sendNudes(id){ 
    
    var huy=1;
    return $.ajax({
      type: "POST",
      url: "js/ajax_sql.php",
      data: {"count":id, "dich": huy}
    }).done(function(result) {
        if(result==false)
        {
            console.log("done");
            temmm=false;
            console.log(temmm);
        }else{
        //console.log('1='+result);
        $( "#temp_news").append(result);
        //console.log('2='+result);
        return result;
        console.log('3='+window.laki);
        }
      });
      if(temmm==false)
        {
      console.log("temmm");
        }

    }
  
  
  //var a = await fetch("/news.db")
  //let tex = await a.text();
  //let typ = tex.split("-|-");
  //let titles= typ[0].split("|");
  //let bodys=typ[1].split("|");
  //et img_url=typ[2].split("|");
  let post = {
      title: 'temp',
      body: 'Т.',
      div: '<a><h2></h2><p></p></a>'
    }
  
    // «Сервер API»
  
    const server = {
      posts(page = 2) {
        if(i%5==0){
          console.log(i);
          laki=sendNudes(count_limit); 

          console.log(temmm);
          //console.log(laki);
         // console.log(laki.result)
          //console.log(lalkk);
        }
        //console.log("count_limit="+count_limit)
        //console.log("i="+i)
        
        
        //console.log(lal);
        
  
        
        //console.log(page);
        //console.log(bodys[i]);
        //console.log(titles[page+8])
        //console.log(bodys[page+8].length)
        //console.log(bodys[i]);
        
        
        
        //console.log(bodys[page+8].length)
        const finished = temmm == false
        const next = finished ? null : page + 5
  
        post = {
          //title: titles[i],
          //body: bodys[i],
          //div: '<a href="./news.php?news_id='+ids[i]+'"><div class="news"><div class="news_img_div"><img src="'+img_url[i]+'" class="news_url"></div><div class="news_text">'+dates[i]+'<article class="post"><h2 class="ahuevshiy_h2"></h2><p></p></article></div></div></a>'
        }
        i+=5;
        count_limit+=5;
        let posts = Array(1).fill(post)
        setTimeout(function()
            {
            //console.log(laki); // Покажет данные из PHP
            /* Только здесь данные из PHP доступны */
            }, 30);
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
      window.addEventListener('scroll', throttle(checkPosition,200))
      window.addEventListener('resize', throttle(checkPosition,200))
    })()