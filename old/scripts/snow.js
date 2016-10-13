// <body  bgcolor="#CC0000" LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0" onLoad="snow()">

//SnowFlakeImage = "/grenouilles-et-rainettes/themes/standard/images/ball_grey.gif";
SnowFlakeImage = "/download/attachments/38502616/snow.gif";

var NbFlakes = 5;
var snowSpeed = 75; // 75 for standard speed
Y = new Array();
X = new Array();
S = new Array();
A = new Array();
B = new Array();
M = new Array();
var V = (document.layers ? 1 : 0);
var H = 0;
var W = 0;
var T = 0;
var L = 0;

function snow(img, count)
{
	SnowFlakeImage = img;
	NbFlakes = count;
	iH = (V ? window.innerHeight : window.document.body.clientHeight - 30);
	iW = (V ? window.innerWidth : window.document.body.clientWidth - 50);
	
	for (i=0; i < NbFlakes; i++)
	{
		Y[i]=Math.round(Math.random()*iH);
		X[i]=Math.round(Math.random()*iW);
		S[i]=Math.round(Math.random()*5+1);
		A[i]=0;
		B[i]=Math.random()*0.1+0.1;
		M[i]=Math.round(Math.random()*1+5);
		obj = document.getElementById('si'+i);
		obj.src = img;
	}
	/******
	if (V)
	{
		for (i = 0; i < NbFlakes; i++)
		{
			document.write("<LAYER NAME='sn"+i+"' LEFT=0 TOP=0 ><img src='"+snowsrc+"'></LAYER>")
		}
	}
	else
	{
		for (i = 0; i < NbFlakes; i++)
		{
			document.write('<img id="si'+i+'" style="position:absolute;top:0;left:0;" src="+snowsrc+">')
		}
	}
	***/
	setTimeout('snow_repeat()',75);
}

function snow_repeat()
{
	H =(document.layers)?window.innerHeight:window.document.body.clientHeight - 30;
	W =(document.layers)?window.innerWidth:window.document.body.clientWidth - 50;
	T =(document.layers)?window.pageYOffset:document.body.scrollTop;
	L =(document.layers)?window.pageXOffset:document.body.scrollLeft;
	
	for (i=0; i < NbFlakes; i++)
	{
		sy=S[i]*Math.sin(90*Math.PI/180);
		sx=S[i]*Math.cos(A[i]);
		Y[i]+=Math.round(sy);
		X[i]+=Math.round(sx);
		if (Y[i] > H)
		{
			Y[i]=-10;
			X[i]=Math.round(Math.random()*W);
			M[i]=Math.round(Math.random()*1+1);
			S[i]=Math.round(Math.random()*5+2);
		}
		if (V)
		{
			document.layers['sn'+i].left=X[i];
			document.layers['sn'+i].top=Y[i]+T
		}
		else
		{
			var yy = Y[i]+T;
			obj = document.getElementById('si'+i);
			obj.style.left = X[i]+'px';
			obj.style.top = yy+'px';
			obj.style.visibility = "visible";
		}
		A[i]+=B[i];
	}
	setTimeout('snow_repeat()',snowSpeed);
}
//-->
