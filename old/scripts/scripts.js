/* Scripts Javascr		ipt standard */

var IE = document.all?true:false;
if (!IE) document.addEventListener(Event.MOUSEMOVE, getMouseXY, false)
document.onmousemove = getMouseXY;
var mouseX = 0;
var mouseY = 0;

function setBackground(img)
{
	if (document.body)
	{
		document.body.background = img;
	}
}

function dump_root()
{
	dump_obj(document, 'document');
}

function getMouseXY(e)
{
	if (IE) { // grab the x-y pos.s if browser is IE
		mouseX = event.clientX + document.body.scrollLeft;
		mouseY = event.clientY + document.body.scrollTop;
	} else {  // grab the x-y pos.s if browser is NS
		mouseX = e.pageX;
		mouseY = e.pageY;
	}  
	if (mouseX < 0) { mouseX = 0; }
	if (mouseY < 0) { mouseY = 0; }  
	return true;
}

//---------------------------------------------------------------------------
//
//    putFavorite(url, title)
//    
//    Adds the <url> to Internet Explorer's favorites under the name <title>
//    
//---------------------------------------------------------------------------

function putFavorite(url, title)
{
	if ((navigator.appName.indexOf("Microsoft",0)>=0) && (parseInt(navigator.appVersion)>=4)) {
		window.external.AddFavorite(url,title);
	} else {
		alert("Cette fonction n'est proposée que par Internet Explorer 4 ou plus");
	}
}

//---------------------------------------------------------------------------
//
//   setTitle(title)
//   
//   Sets the title of the window to <title>
//
//---------------------------------------------------------------------------

function setTitle(title)
{
	top.document.title = title
}

//---------------------------------------------------------------------------
//
//   checkDate(obj)
//   
//   Verifies that the date set in an input <obj> is in allowed format.
//   If some info is missing on year, attemps to complete it.
//   
//---------------------------------------------------------------------------

function checkDate(obj)
{
	var value = trim(obj.value);
	var re1 = /^(\d\d\d\d)-(\d\d)-(\d\d)$/;
	var re2 = /^(\d\d)-(\d\d)-(\d\d)$/;
	var re3 = /^(\d\d)\/(\d\d)\/(\d\d\d\d)$/;
	var re4 = /^(\d\d)\/(\d\d)\/(\d\d)$/;
	var re5 = /^(\d\d)\/(\d\d)$/;
	var arr ;
	if ((arr = value.match(re1)) != undefined)
	{
		obj.value = arr[3] + '/' + arr[2] + '/' + arr[1];
		return obj.value;
	}
	if ((arr = value.match(re2)) != undefined)
	{
		year = parseInt(arr[1]);
		if (year < 70) {
			year = year + 2000;
		} else {
			year = year + 1900;
		}
		obj.value = arr[3] + '/' + arr[2] + '/' + year;
		return obj.value;
	}
	if ((arr = value.match(re3)) != undefined)
	{
		return obj.value;
	}
	if ((arr = value.match(re4)) != undefined)
	{
		year = parseInt(arr[3]);
		if (year < 70) {
			year = year + 2000;
		} else {
			year = year + 1900;
		}
		obj.value = arr[1] + '/' + arr[2] + '/' + year;
		return obj.value;
	}
	if ((arr = value.match(re5)) != undefined)
	{
		year = 2005;
		obj.value = arr[1] + '/' + arr[2] + '/' + year;
		return obj.value;
	}

	var errmsg = value + ": Date incorrecte,\nle format doit être JJ/MM/AAAA ou AAAA-MM-JJ,\nveuillez re-saisir.";
	alert(errmsg);
	obj.value = '';
	// obj.focus();
	// obj.select();
}

//---------------------------------------------------------------------------
//
//   checkTime(obj)
//   
//   Verifies that the time set in an input <obj> is in allowed format.
//   If some info is missing on year, attemps to complete it.
//     
//---------------------------------------------------------------------------

function oldCheckTime(obj)
{
	var value = obj.value;
	var re1 = /^\s*(\d\d?)\s*[:h]\s*(\d\d)?\s*$/;
	var scores;
	if ( (scores = value.match(re1)) != undefined)
	{
		s1 = parseInt(scores[1]);
		s2 = parseInt(scores[2]);
		if ( s1 < 10 ) {
			if ( s2 < 10 ) {
				obj.value = '0' + s1 + ':0' + s2;
			} else {
				obj.value = '0' + s1 + ':' + s2;
			}
		} else {
			if ( s2 < 10 ) {
				obj.value = s1 + ':0' + s2;
			} else {
				obj.value = s1 + ':' + s2;
			}
		}		
		if (s1 == 3 && s2 >= 0 && s2 < 3) { return true; }
		if (s2 == 3 && s1 >= 0 && s1 < 3) { return true; }
	}

	var errmsg = value + ": Format d'heure incorrect, veuillez re-saisir.";
	alert(msg);
	obj.select();
	obj.focus();
}


function checkHour(obj)
{
	checkTime(obj)
}

function checkTime(obj)
{
	obj.value = trim(obj.value);
	obj.value = obj.value.toLowerCase();
	if (obj.value == '') { return; }
	re3 = /^([0-2][0-9]):([0-5][0-9])$/;
	re2 = /^([0-2][0-9])$/;
	re1 = /^([0-9])$/;
	arr = obj.value.match(re3);
	if (arr == undefined) {
		arr = obj.value.match(re2);
		if (arr != undefined) {
			obj.value = arr[0] + ':00'
		} else {
			arr = obj.value.match(re2);
			if (arr != undefined) {
				obj.value = '0' + arr[0] + ':00'
			} else {
				alert("Attention: Format d'heure incorrect");
			}				
		}
	}
	return
}

//---------------------------------------------------------------------------

function gotoUrl()
{
	if (arguments.length < 1) {
		alert("Function gotoUrl: Missing one argument")
		return false
	}
	url = arguments[0]
	var re = /^[- ]*$/;
   for (var i=1; i < arguments.length; i++)
   {
   	str = arguments[i];
      url += (i == 1 ? '?' : (i % 2 == 0 ? '=' : '&'))
      if (str.match(re) == null) {
      	url += str
      }
   }
	top.location.href = url;
}

//---------------------------------------------------------------------------

function gotoTeam(team)
{
	gotoUrl('/resultats/equipe.php', 'div', team);
}

//---------------------------------------------------------------------------

function changeSaison(url, saison)
{
	gotoUrl(url, 'saison', saison);
}

//---------------------------------------------------------------------------

function gotoPlan(plan)
{
	gotoUrl('/asso/gymnase.php', 'id', plan);
}


//---------------------------------------------------------------------------
//
//   checkEmail(obj)
//   checkUrl(obj)
//   
//   Verifies that an object contains a valid email address, a valid URL
//     
//---------------------------------------------------------------------------

function checkEmail(obj)
{
	obj.value = trim(obj.value);
	obj.value = obj.value.toLowerCase();
	if (obj.value == '') { return; }
	re = /^([A-Za-z0-9\.\-_]+)@([A-Za-z0-9\.\-_]+)(\.com|\.net|\.fr|\.org)$/;
	arr = obj.value.match(re);
	if (arr == undefined) { alert("Attention: Format d'email incorrect"); }
}

function checkUrl(obj)
{
	obj.value = trim(obj.value);
	obj.value = obj.value.toLowerCase();
	if (obj.value == '') { return; }
	re = /^(http:\/\/)(\S+)$/;
	arr = obj.value.match(re);
	if (arr == undefined) { alert("Attention: Format d'URL incorrect"); }
}


//---------------------------------------------------------------------------
//
//   getEmailFirstname(str)
//   getEmailLastname(str)
//   
//   Tries to deduct the first/last name from an email like john[._]smith@whatever.com
//   and return it. Returns an empty string if it cannot find anything
//   (eg emails try thbob@whatever.com)
//     
//---------------------------------------------------------------------------

function getEmailFirstname(str)
{
	re = /(\w+)[_.](\w+)@/;
	arr = str.match(re);
	if (arr == undefined) { return ''; }
	arr.shift();
	if (arr[0] != undefined) {
		return capitalize(arr[0]);
	}
}

function getEmailLastname(str)
{
	re = /(\w+)[_.](\w+)@/;
	arr = str.match(re);
	if (arr == undefined) { return ''; }
	arr.shift(); arr.shift();
	if (arr[0] != undefined) {
		return arr[0].toUpperCase();
	}
}

function trimleft(str)
{
	while (str.charAt(0) == ' ')
	{
		str = str.substring(1, str.length);
	}
	return str;
}

function trimright(str)
{
	while (str.charAt(str.length-1) == ' ')
	{
		str = str.substring(0, str.length-1);
	}
	return str;
}

function trim(str)
{
	return trimleft(trimright(str));
}

function capitalize(str)
{
	c = str.charAt(0).toUpperCase();
	rest = str.substring(1, str.length).toLowerCase();
	return c + rest;
}


//---------------------------------------------------------------------------
//
//   popScrollWindow(url, title, w, h)
//   popFixedWindow(url, title, w, h, x, y)
//
//   Opens a new window (scrollable or not) with <url> as content and <title> as title.
//   <w> = width, <h> = height, <x>, <y> = xloc, yloc on screen.
//
//---------------------------------------------------------------------------

function popScrollWindow(url, title, w, h)
{
	opts = 'width=' + w + ', height=' + h + ', status=no, directories=no, toolbar=no, location=no, menubar=no, scrollbars=yes, resizable=yes';
	w = window.open(url,'',opts);
	w.document.title = title;
	w.moveTo(100, 50);
}

function popFixedWindow(url, title, w, h, x, y)
{
	opts = 'width=' + w + ', height=' + h + ', status=no, directories=no, toolbar=no, location=no, menubar=no, scrollbars=yes, resizable=no';
	w = window.open(url,'',opts);
	w.moveTo(x, y);
	//dump_obj(w, "Window");
}

function toggleVisibility(name)
{
	objStyle = document.getElementById(name).style;
	if (objStyle.visibility == "visible") {
		objStyle.visibility = "hidden";
	} else {
		objStyle.visibility = "visible";
		setTimeout("hide('" + name + "')", 4000);
	}
}

function hide(name)
{
	objStyle = document.getElementById(name).style;
	objStyle.visibility = "hidden";
}

function show(name)
{
	objStyle = document.getElementById(name).style;
	objStyle.visibility = "visible";
}

// Deletes from the destination list.
function remElem(id)
{
	var destList = document.getElementById(id);
	var destHidden = document.getElementById('hidden_del_' + id);
	var len = destList.options.length;
	if (destList.selectedIndex != -1)
	{
		for (var i = (len-1); i >= 0; i--)
		{
			if ((destList.options[i] != null) && (destList.options[i].selected == true))
			{
				destHidden.value = destHidden.value + "," + destList.options[i].value;
				// dump_obj(destHidden, "Hidden");
				// dump_obj(destList.options[i], "Option" + i);
				destList.options[i] = null;
			}
		}
	}
	else
	{
		alert("Veuillez sélectionner un joueur à supprimer");
	}
}

function dump_obj(obj, obj_name)
{
	var result = "<html>\n<head></head>\n<body>\n<small><small>\n";
	if (obj) {
		for (var i in obj) {
			result += obj_name + "." + i + " = " + obj[i] + "<BR>\n";
			last_obj = obj[i];
		}
	} else {
		result = obj_name + " is null";
	}
	alert("Dumping " + obj_name);
	w  = window.open("");
	w.document.write(result);
}

function dump(obj, obj_name)
{
	var result = "<html>\n<head></head>\n<body>\n<small><small>\n";
	if (obj) {
		for (var i in obj) {
			result += obj_name + "." + i + " = " + obj[i] + "<BR>\n";
			last_obj = obj[i];
		}
	} else {
		result = obj_name + " is null";
	}
	w  = window.open("");
	w.document.write(result);
}


function addElem(id1, id2)
{
	var srcList = document.getElementById(id1);
	var destList = document.getElementById(id2);
	var destHidden = document.getElementById('hidden_add_' + id2);
	if (srcList.selectedIndex != -1)
	{
		var len = destList.length;
		for (var i = 0; i < srcList.length; i++)
		{
			if ((srcList.options[i] != null) && (srcList.options[i].selected))
			{
				//Check if this value already exist in the destList or not
				//if not then add it otherwise do not add it.
				var found = false;
				for (var count = 0; count < len; count++)
				{
					if (destList.options[count] != null)
					{
						if (srcList.options[i].text == destList.options[count].text)
						{
							found = true;
							break;
				      }
				   }
				}
				if (! found)
				{
					destList.options[len] = new Option(srcList.options[i].text);
					destHidden.value = destHidden.value + "," + srcList.options[i].value;
					len++;
	         }
	      }
	   }
	}
	else
	{
		alert("Pas de joueurs sélectionnés");
	}
	//dump_obj(elem2, "Elem2");
}

function breakout(url)
{
	if (window.top != window.self) 
	{
		window.top.location = url
	}
}

function changeUrls(top_url, bottom_url)
{
	top.main.header.location.href = top_url;
	top.main.body.location.href = bottom_url;
}

function showRandom(path)
{
	obj = document.getElementById('randomAppear');
	obj.style.position="absolute";
	x = (600 * Math.random()) + document.body.scrollLeft;
	y = (400 * Math.random()) + document.body.scrollTop;
	obj.style.left = x + "px";
	obj.style.top = y + "px";
	// ///Alert("Pos = " + x + "," + y);
	obj.style.visibility = "visible";
	//n = parseInt(5*Math.random());
	//obj.src = path + '/randomAppear' + n + '.gif';
	setTimeout("hideRandom('"+path+"')", 3000);
}

function hideRandom(path)
{
	obj = document.getElementById('randomAppear');
	obj.style.visibility = "hidden";
	setTimeout("showRandom('"+path+"')", 6000);
}


function activateRandom(path)
{
	setTimeout("showRandom('"+path+"')", 1000);
}

//-----------------------------------------------------------------------------
//
//   swapFields(field1, field2)
//
//   Swaps the values of 2 fields
//
//-----------------------------------------------------------------------------

function swapFields(field1, field2)
{
	val = field1.value;
	field1.value = field2.value;
	field2.value = val;
}

//-----------------------------------------------------------------------------
//
//   preloadFile
//
//   Preloads a file for fast fetching when necessary
//
//-----------------------------------------------------------------------------

function setHtml(id, htmlcode)
{
   obj = document.getElementById(id);
   obj.innerHTML = htmlcode;
}

function preloadImage(file, name)
{
	if (name == '') { name = 'preload';	}
	setHtml(name, '<img src=" + file + " style="visibility: hidden; position: absolute;">');
}

//-----------------------------------------------------------------------------
//
//   Sound management routines
//
//   preloadSound: Pre-loads a sound so that it is played immediately when
//                 calling the playSound() function
//   playSound:    Guess what ?
//
//-----------------------------------------------------------------------------

function setSound(file, name, autostart)
{
	if (name == '') {	name = 'preload';	}
   setHtml(name, '<embed src="' + file + '" autostart=' + autostart + 'hidden=true></embed>');
}

function preloadSound(file, name)
{
	setSound(file, name, 'false');
}

function preloadVideo(file, name)
{
	preloadSound(file, name);
}

function playSound(file, name)
{
	setSound(file, name, 'true');
}
