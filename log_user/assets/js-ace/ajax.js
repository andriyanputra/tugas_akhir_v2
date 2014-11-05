function createAjax(){
	if(window.ActiveXObject){
		try{
			return new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			return new ActiveXObject("Msxml2.XMLHTTP");
		}
	}
	else if(window.XMLHttpRequest){
		return new XMLHttpRequest();
	}
}

var xmlhttp = createAjax();
function sendRequest(halaman, parameter, konten){
	var obj = window.document.getElementById(konten);
	obj.innerHTML = "<table border='0' width='100%'><tr><td align='center' valign='middle'><img src='loader.gif' width='24' height='24' style='border:0px groove #fff;' /></td></tr></table>";
	if(xmlhttp.readyState==4 || xmlhttp.readyState==0){
		xmlhttp.open('POST', halaman, true);
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				obj.innerHTML=parseScript(xmlhttp.responseText);
			}
		}
		xmlhttp.send(parameter);
	}
}

function parseScript(_source)
{
		var source = _source;
		var scripts = new Array();
		
		while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
			var s = source.indexOf("<script");
			var s_e = source.indexOf(">", s);
			var e = source.indexOf("</script", s);
			var e_e = source.indexOf(">", e);
 
			scripts.push(source.substring(s_e+1, e));
			source = source.substring(0, s) + source.substring(e_e+1);
		}
 
		for(var i=0; i<scripts.length; i++) {
			try {
				eval(scripts[i]);
			}
			catch(ex) {
				// do what you want here when a script fails
			}
		}
		// Return the cleaned source
		return source;
}