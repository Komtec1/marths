<!DOCTYPE html>
<html>
<head>

  <title>Creador de fractales, arte con matemáticas / Fractal generator, art with maths / Marths</title>
  <meta name="description" content="Creador de fractales, arte con matemáticas / Fractal generator, art with maths / Marths">
  <meta name="keywords" content="Fractal,Fractales,Arte,Matemáticas,Maths,Art,Code">
  <meta name="author" content="Alfonso Cuevas - @komtec1">

<style type="text/css">
    #container
    {
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
        text-align: center;
    }

    #canvas
    {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        display: block;
        cursor: move;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
        background-color: white;
    }

    #minus, #plus
    {
        font-family: 'Ubuntu';
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
    }

    #minus:hover, #plus:hover
    {
        background-color: Yellow;
    }

    #download {
        float:none;
        cursor:pointer;
        color:#000;
        padding:3px;
    }
    #download:hover {
        color:#666;
    }
</style>
</head>
<body>

<!-- <form>
<input type="number" id="valorx" name='valorx'>
<input type="button" onclick="mandaFuncion()" value='Genera'>
</form>
<br /> -->

<div id="container">
<canvas id="canvas" width="4000" height="2000" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.</canvas>
<a id="download">Descargar la imagen</a> o al final clic derecho - guardar como / <a href='.'>Generar otro</a>
</div>

<script>

//hecho por Alfonso Cuevas / Komtec1
//http://marths.art
//komtec1 [at] gmail [dot] com
//@komtec1

var scale = 1.0;
var scaleMultiplier = 0.8;
var startDragOffset = {};
var mouseDown = false;

var c = document.getElementById("canvas");
var ctx = c.getContext("2d");
var tamanioX = 4000;
var tamanioY = 2000;
var x,y,radioG,radioP, puntoxG1, puntoyG1, puntoxP1, puntoyP1, b1, b2, auA, auB, valor;
var requestAnimationFrame = window.requestAnimationFrame || 
                            window.mozRequestAnimationFrame || 
                            window.webkitRequestAnimationFrame || 
                            window.msRequestAnimationFrame;
ctx.lineCap = "round";


//auA = 30;
auA = Math.floor(Math.random() * 100); 
//auB = 15;
auB = Math.floor(Math.random() * 100); 
b1=0;
b2=0;
//radioG = 10;
radioG = Math.floor(Math.random() * 100); 
//radioPG = 100;
radioPG = Math.floor(Math.random() * 100);
puntoxG1=0;
puntoyG1=0;
puntoxP1=0;
puntoyP1=0;

var t = 1;

x = tamanioX/2;
y = tamanioY/2;



function gameLoop () {
  window.requestAnimationFrame(gameLoop);
  renderLine();
}

function calculaPuntos()
{
var losPuntos = [];
	for (c=0; c<=6; c++)
	{
		for (b = 0; b <= 360; b=b+auB)
		{
			for (a = 0; a <= 360; a=a+auA)
			{
				puntoxG1 = x +radioG* Math.cos(deg2rad(a)+(Math.PI/180));
				puntoyG1 = y +radioG* Math.sin(deg2rad(a)+(Math.PI/180));

				puntoxP1 = x +radioPG* Math.cos(deg2rad(b)+(Math.PI/180));
				puntoyP1 = y +radioPG* Math.sin(deg2rad(b)+(Math.PI/180));
				//ctx.moveTo(puntoxG1, puntoyG1);
				//ctx.lineTo(puntoxP1, puntoyP1);
				//ctx.stroke(); //stroke crea la linea en el canvas o todo lo que se ah dibujado en el 
				//creaLinea(puntoxG1, puntoyG1, puntoxP1, puntoyP1);
				//setInterval(2000);
				//ctx.closePath();
				losPuntos.push({puntoxG1:puntoxG1,puntoyG1:puntoyG1,puntoxP1:puntoxP1,puntoyP1:puntoyP1});
			}
		}
		b1=b1+Math.floor(Math.random() * 100);
		b2++;
		radioG = radioG+100;
		radioPG = radioPG+100;
	}
	//dump(losPuntos);
	return (losPuntos);
}

var points = calculaPuntos();

//var control = new CanvasManipulation(
//      canvas
//      , function () {renderizar(points)}
      //, {leftTop: {x: 0, y: 0}, rightBottom: {x: 1000, y: 1000}}
//    )
//    control.init()
//    control.layout()
ctx.rect(0, 0, 4000, 2000);
ctx.fillStyle = "white";
ctx.fill();
ctx.fillStyle = "black";
ctx.font = "100px Arial";
ctx.textAlign = "center";
ctx.fillText("http://marths.art/",canvas.width/2,1950);
renderizar(points);


function deg2rad(angle) {
  return angle * .017453292519943295; // (angle / 180) * Math.PI;
}

function renderizar() {
    if (t < points.length - 1) {
        requestAnimationFrame(renderizar);
    }
    // draw a line segment from the last waypoint
    // to the current waypoint
    ctx.beginPath();
    ctx.moveTo(points[t - 1].puntoxG1, points[t - 1].puntoyG1);
    ctx.lineTo(points[t].puntoxP1, points[t].puntoyP1);
    //ctx.moveTo(puntoxG1, puntoyG1);
    //ctx.lineTo(puntoxP1, puntoyP1);

    //ctx.strokeStyle = getRandomColor();

    ctx.stroke();
    // increment "t" to get the next waypoint
    t++;
}

function downloadCanvas(link, canvasId, filename) {
    link.href = document.getElementById(canvasId).toDataURL();
    link.download = filename;
}

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

document.getElementById('download').addEventListener('click', function() {
    downloadCanvas(this, 'canvas', 'marths.art.png');
}, false);

</script>



</body>

<!-- tracking code -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108129718-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108129718-1');
</script>


</html>
