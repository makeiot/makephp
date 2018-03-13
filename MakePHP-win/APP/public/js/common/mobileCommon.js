/*meta for IE 6~9*/
var loadMobileSetting = function(url) {
	var content = document.getElementsByTagName("head")[0];
	//页面大小及用户缩放
	var viewport = document.createElement("meta");
	viewport.name = "viewport";
	viewport.content = "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0";
	content.appendChild(viewport);
	//IE渲染模式设置
	var renderForIE = document.createElement("meta");
	renderForIE.httpEquiv = "X-UA-Compatible";
	renderForIE.content = "IE=edge,chrome=1";
	content.appendChild(renderForIE);
	//360渲染模式设置
	var for360 = document.createComment("<!-- Set render engine for 360 browser -->");
	var renderFor360 = document.createElement("meta");
	renderFor360.name = "renderer";
	renderFor360.content = "webkit";
	content.appendChild(for360);
	content.appendChild(renderFor360);
	//取消百度转码
	var forBaiduSiteApp = document.createComment("<!-- No Baidu Siteapp-->");
	var baiduSiteApp = document.createElement("meta");
	baiduSiteApp.httpEquiv = "Cache-Control";
	baiduSiteApp.content = "no-siteapp";
	content.appendChild(forBaiduSiteApp);
	content.appendChild(baiduSiteApp);
	
	if(url) {
		//安卓端添加到主屏幕
		var forAndroidChrome = document.createComment("<!-- Add to homescreen for Chrome on Android -->");
		var iconForAndroid = document.createElement("link");
		iconForAndroid.rel = "icon";
		iconForAndroid.sizes = "192x192";
		iconForAndroid.href = url;
		var androidChrome = document.createElement("meta");
		androidChrome.name = "mobile-web-app-capable";
		androidChrome.content = "yes";
		content.appendChild(forAndroidChrome);
		content.appendChild(iconForAndroid);
		content.appendChild(androidChrome);
		//IOS添加到主屏幕
		var forIOSSafari = document.createComment("<!-- Add to homescreen for Safari on iOS -->");
		var iconForIOS = document.createElement("link");
		iconForIOS.rel = "icon";
		iconForIOS.sizes = "192x192";
		iconForIOS.href = url;
		var IOSSafari = document.createElement("meta");
		IOSSafari.name = "apple-mobile-web-app-status-bar-style";
		IOSSafari.content = "black";
		content.appendChild(forIOSSafari);
		content.appendChild(iconForIOS);
		content.appendChild(IOSSafari);
	}

}