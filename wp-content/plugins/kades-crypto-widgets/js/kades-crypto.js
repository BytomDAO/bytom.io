
// where data come from
baseUrl = "https://widgets.cryptocompare.com/";


// Crypto market index

var cryptoheader = document.getElementById("kadescrypto-header");
if( cryptoheader !== null && cryptoheader !== '' ) {
	var cccTheme = {"General":{"background":"#011627","priceText":"#ebeef0"},"Menu":{"triggerBackground":"#465a65"}};
	(function (){
	var appName = encodeURIComponent(window.location.hostname);
	if(appName==""){appName="local";}
	var s = document.createElement("script");
	s.type = "text/javascript";
	s.async = true;
	var theUrl = baseUrl+'serve/v2/coin/header?fsyms=BTC,ETH,LTC,XRP&tsyms=USD,EUR,CNY,GBP';
	s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
	cryptoheader.appendChild(s);
	})();
}

// Crypto converter
var cryptoconvert = document.getElementById("kadescrypto-converter");
if( cryptoconvert) {
	(function (){
	var appName = encodeURIComponent(window.location.hostname);
	if(appName==""){appName="local";}
	var s = document.createElement("script");
	s.type = "text/javascript";
	s.async = true;
	var theUrl = baseUrl+'serve/v1/coin/converter?fsym=BTC&tsyms=USD,EUR,CNY,GBP';
	s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
	cryptoconvert.appendChild(s);
	})();

}

// Crypto tabbed widget
var cryptotabbed = document.getElementById("kadescrypto-tabbed");
if( cryptotabbed !== null && cryptotabbed !== '' ) {
	(function (){
	var cryptotabbed_appName = encodeURIComponent(window.location.hostname);
	if(cryptotabbed_appName==""){cryptotabbed_appName="local";}
	var s = document.createElement("script");
	s.type = "text/javascript";
	s.async = true;
	var cryptotabbed_theUrl = baseUrl+'serve/v1/coin/multi?fsyms=BTC,ETH,XMR,LTC,DASH&tsyms=USD,EUR,CNY,GBP';
	s.src = cryptotabbed_theUrl + ( cryptotabbed_theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + cryptotabbed_appName;
	cryptotabbed.appendChild(s);
	})();

}

// Crypto ICOs widget

function add_iwl_list_widget(){
	var widget_divs = document.getElementsByClassName("icowatchlist_list_widget");
	for(var i = 0; i < widget_divs.length; i++)
	{
		if (!widget_divs.item(i).getElementsByTagName('iframe').length)
		{
		var link = "https://api.icowatchlist.com/widget/v1/";
		if (widget_divs.item(i).getAttribute("data-type")=='nolink') link += "widget2.php";
		link += "?items="+widget_divs.item(i).getAttribute("data-num")+"&color="+widget_divs.item(i).getAttribute("data-color");
	
		frame_height = (parseInt(widget_divs.item(i).getAttribute("data-num"))*75)+128;
		var iframe = document.createElement('iframe');
		iframe.style.cssText='width:100%;height:'+frame_height+'px;border:1px solid #000;border: 1px solid #b5b4b4;';
		iframe.setAttribute("src", link);	   
		
		widget_divs.item(i).appendChild(iframe);
		}
	}	
}
if(window.addEventListener){
  window.addEventListener('load', add_iwl_list_widget)
}else{
  window.attachEvent('onload', add_iwl_list_widget)
}



