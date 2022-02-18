var current = window.location.pathname.split('/');
var currentUC = current[1].toUpperCase();
var currentUrl = current[1];
function createCookie(name, value) {
	var expires; 
	var date = new Date(); 
	date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000)); 
	expires = "; expires=" + date.toGMTString();
	document.cookie = escape(name) + "=" +  
		escape(value) + expires + "; path=/"+currentUrl; 
}
function getCookie(name) {
	var dc = document.cookie;
	var prefix = name + "=";
	var begin = dc.indexOf("; " + prefix);
	if (begin == -1) {
		begin = dc.indexOf(prefix);
		if (begin != 0) return null;
	}
	else
	{
		begin += 2;
				var end = document.cookie.indexOf(";", begin);
		if (end == -1) {
		end = dc.length;
		}
	}
	// because unescape has been deprecated, replaced with decodeURI
	//return unescape(dc.substring(begin + prefix.length, end));
	return decodeURI(dc.substring(begin + prefix.length, end));
} 
function getUrlParameter(o) {
    o = o.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var e = new RegExp("[\\?&]" + o + "=([^&#]*)").exec(location.search);
	return null === e ? "" : decodeURIComponent(e[1].replace(/\+/g, " "))
}
function topPad(q) {
	if (q.matches) {
		//$('div#viewport').css('paddingTop', '60px');
		document.getElementById('viewport').style.paddingTop = '60px;';
	} else {
		//$('div#viewport').css('paddingTop', '100px');
		document.getElementById('viewport').style.paddingTop = '100px;';
	}
}
var JSip, geoLoc, geoLocHref, geoLocLang, loc, storeSelect, urlRedirect;
var paramRef = getUrlParameter("ref");
var paramLoc = getUrlParameter("loc");//new URLSearchParams(window.location.search);
var mediaMatch = window.matchMedia("(max-width: 767px;)");
//var countrySites = new Array();
//countrySites = {"US":{"country":"USA","href":"/us","value":"en"},"CA":{"country":"Canada (English)","href":"/ca","value":"en"},"FR":{"country":"France","href":"/fr","value":"fr"},"DE":{"country":"Germany","href":"/de","value":"de"},"IT":{"country":"Italy","href":"/it","value":"it"},"NL":{"country":"Netherlands","href":"/nl","value":"nl"},"ES":{"country":"Spain","href":"/es","value":"es"},"GB":{"country":"United Kingdom","href":"/gb","value":"en"},"JP":{"country":"Japan","href":"/jp","value":"jp"}};
var countrySites = [
  [ 'US', 'USA','/us', 'en'],
  ['CA', 'Canada (English)', '/ca', 'en'],
  ['FR', 'France', '/fr', 'fr'],
  ['DE', 'Germany', '/de', 'de'],
  ["IT", "Italy", "/it", "it"],
  ["NL", "Netherlands", "/nl", "nl"],
  ["ES", "Spain", "/es", "es"],
  ["GB", "United Kingdom", "/gb", "en"]
  ["JP", "Japan", "/jp", "jp"]
];
var endpoint = "https://pro.ip-api.com/json/?fields=61439&key=LoBw5YrUelcIp9E";
var ck = document.cookie.indexOf('loc');
var urlCheck = new XMLHttpRequest();
var xhr = new XMLHttpRequest();
storeSelect = document.getElementById('storeSelect');
xhr.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var response = JSON.parse(this.responseText);
		if(response.status !== 'success') {
			console.log('query failed: ' + response.message);
			return
		}
		geoLoc = response.countryCode;
		var listed = false;
		countrySites.forEach(function(key) {
			if(key == geoLoc) {
				geoLocHref = key[2];
				geoLocLang = key[3];
				listed = true;
			}
			if(listed == false) geoLocHref = "/"+geoLoc.toLowerCase(); geoLocLang = "en";
		});

		if (ck != -1) {
			if(typeof(storeSelect) != 'undefined' && storeSelect != null) storeSelect.parentNode.removeChild(storeSelect);
			document.onreadystatechange = function () { topPad(mediaMatch); mediaMatch.addListener(topPad); };
		}
		if(currentUC == geoLoc && paramRef == "") {
			(ck != 0) ? createCookie('loc' , geoLocLang) : "";
			if(typeof(storeSelect) != 'undefined' && storeSelect != null) storeSelect.parentNode.removeChild(storeSelect);//storeSelect.remove();
			document.onreadystatechange = function () { topPad(mediaMatch); mediaMatch.addListener(topPad); };
		} else {
			if( paramRef == "" && ck != 0 ) {
				var status;
				var path = window.location.pathname; path = path.replace("/"+path.split('/')[1]+"/",'');
				var params = window.location.search;
				urlRedirect = "https://whill.inc"+geoLocHref;
				urlCheck.open('get', urlRedirect, true);
				urlCheck.onreadystatechange = (function(){
					if (urlCheck.readyState === 4) {
						//check to see whether request for the file failed or succeeded
						if ((urlCheck.status == 200) || (urlCheck.status == 0)) {
							urlRedirect = urlRedirect + ( (path != "") ? "/"+path : "" ) + ( (window.location.href.indexOf('?') == -1) ? "?ref="+currentUrl : params+"&ref="+currentUrl );
							window.location.replace(urlRedirect);
						}
						else {
							window.location.replace("https://whill.inc/gb?ref="+currentUrl);
							return;
						}
					}
				});
				urlCheck.send(null);
			}
		}
	}
};
xhr.open('GET', endpoint, true);
xhr.send();