<html>
<head>
<style>
.sun {
position: absolute;

bottom: 20%;
width: 15em;
height: 15em;
margin-left: -75em;
margin-top: 0;
background: orangered;
border-radius: 60%;
box-shadow: 0 0 20px orange;
animation: 9s infinite linear;
animation-name: move, sun-color;

}
.sunta {
position: absolute;

bottom: 60%;
width: 15em;
height: 15em;
margin-left: -75em;
margin-top: 0;
background: orangered;
border-radius: 60%;
box-shadow: 0 0 20px orange;
animation: 9s infinite linear;
animation-name: mov, sun-color;

}
.suntra {
position: absolute;

bottom: 40%;
width: 75em;
height: 15em;
margin-left: -75em;
margin-top: 0;
background: orangered;
border-radius: 60%;
box-shadow: 0 0 20px orange;
animation: 9s infinite linear;
animation-name: mover, sun-color;

}
@keyframes move {
0%{}
5%{
margin-left:5%;
}
10%{
margin-left:10%;
}

20%{
margin-left: 20%;
}

30%{
margin-left: 30%;
}

40%{
margin-left:40%;
}

50%{
margin-left: 50%;

}

60%{
margin-left: 60%;
}

70%{
margin-left:70%;
}

80%{
margin-left: 80%;
}

90%{
margin-left: 90%;
}

100%{
margin-left: 100%;
}

}
BODY {
margin: 0;
overflow: hidden;

}
@keyframes sun-color {
20%{
background: greenyellow;

}
40%{
background: lawngreen;
box-shadow:0 0 35px gold;
}
60%{
background: blue;
box-shadow:4 0 70px blue;

}
80%{
background: blueviolet;
box-shadow: 0 0 105px blueviolet;

}
100%
{
background: black;
box-shadow:0 0 140px black;
}
}
@keyframes mov {
0%{}
5%{
margin-left:5%;

}
10%{
margin-left:10%;
}

20%{
margin-left: 20%;

}

30%{
margin-left: 30%;
}

40%{
margin-left:40%;

}

50%{
margin-left: 50%;


}

60%{
margin-left: 60%;

}

70%{
margin-left:70%;
}

80%{
margin-left: 80%;
}

90%{
margin-left: 90%;
}

100%{
margin-left: 100%;
}

}
@keyframes mover {
0%{}
5%{
margin-left:5%;
}
10%{
margin-left:10%;
}

20%{
margin-left: 20%;
}

30%{
margin-left: 30%;
}

40%{
margin-left:40%;
}

50%{
margin-left: 50%;

}

60%{
margin-left: 60%;
}

70%{
margin-left:70%;
}

80%{
margin-left: 80%;
}

90%{
margin-left: 90%;
}

100%{
margin-left: 100%;
}

}
body{
    background-color: #181818;
}


</style>
</head>
<body><a href="index.php">
<div class="sun">
</div>
<div class="sunta">
</div>
<div class="suntra"></div>
</a>
</body>
</html>