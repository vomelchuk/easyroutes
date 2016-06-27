document.getElementById("year").innerHTML = new Date().getFullYear();



var showStreet = function(str, id) {
	if (str.length == 0) { 
        document.getElementById(id).innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("startStreet").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "search.php?station=search&value=" + str, true);
        xmlhttp.send();
    }
}

var advice_count = 0;
var advice_selected = 0;
var input_str = '';

var showStation = function(event, marker) {

	var help = document.getElementById(marker == 's1' ? 'search1' : 'search2');
	var hid = document.getElementById(marker == 's1' ? 'sid1' : 'sid2');
	var inp = document.getElementById(marker == 's1' ? 's1' : 's2');
	var str = inp.value;
	var key = event.keyCode;
	var n = key - 39;
	switch(key) {
		case 13:  
		case 27:  
			help.style.display = 'none';
			break;
		case 38:  
		case 40:  
			if (advice_count) {
				help.style.display = 'block';
				
				console.log('advice_selected='+advice_selected);
				
				if(advice_selected > 0) {
					help.childNodes[advice_selected-1].className = "search_variant";
				}
				if(n == 1 && advice_selected < advice_count) {
					advice_selected++;
				} else if (n == -1 && advice_selected > 0) {
					advice_selected--;
				}
				if(advice_selected > 0) {
					help.childNodes[advice_selected-1].className = "search_variant active";
					inp.value = help.childNodes[advice_selected-1].innerHTML;
					hid.value = help.childNodes[advice_selected-1].attributes[1].nodeValue;
				} else {
					inp.value = input_str;
					hid.value = '';
				}
		
			};


			break;			
		default:
			input_str = str;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						
						var clean = document.getElementById(marker == 's1' ? 'search1' : 'search2');
						while(clean.hasChildNodes()) clean.removeChild(clean.childNodes[0]);
						
						var res = JSON.parse(xmlhttp.responseText);
						//alert(res);
						advice_count = res.length;
						for(var i = 0; i < res.length; i++) {
							var newItem = document.createElement("div");
							var textnode = document.createTextNode(res[i][0] + (res[i][2].length == 0 ? ' ' : ' ' + res[i][2]) + ' (' + res[i][3] + ')'+ ' / ' + res[i][1]);
							newItem.appendChild(textnode);

							var attrnode = document.createAttribute("class");
							attrnode.value = "search_variant";
							newItem.setAttributeNode(attrnode);
							

							attrnode = document.createAttribute("sid");
							attrnode.value = res[i][1];
							newItem.setAttributeNode(attrnode);
						
							var list = document.getElementById(marker == 's1' ? 'search1' : 'search2');
							list.insertBefore(newItem, list.childNodes[0]);
						}
					}
				};
			xmlhttp.open("GET", "search.php?station=search&str=" + str, true);
			xmlhttp.send();		
			help.style.display = 'block';
			break;
		
	}


	inp.addEventListener("focus", disp);
	inp.addEventListener("blur", undisp);
	

	function disp() {
		help.style.display = 'block';
		event.stopPropagation();
	}

	function undisp() {
		help.style.display = 'none';
	}

}



	


var getResult = function() {


	    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				
				var res = JSON.parse(xmlhttp.responseText);
				alert(xmlhttp.responseText);
				var cont = '';
				for(i = 0; i < res['straight'].length; i++) {
					cont += res['straight'][i]['name'] + ' ';
				}				
                document.getElementById("res").innerHTML = cont;
            }
        };
        xmlhttp.open("GET", "search.php?station=result&s1=" + x1 + "&s2=" + x2, true);
        xmlhttp.send();
    }

var showOnMap = function(rid) {
	document.getElementById("googleMap").style.display = "block";
	document.getElementById("route").style.display = "none";
	
	var width = window.innerWidth
	|| document.documentElement.clientWidth
	|| document.body.clientWidth;

	var height = window.innerHeight
	|| document.documentElement.clientHeight
	|| document.body.clientHeight;
	
	var div_map = document.getElementById("googleMap");
	div_map.style.width = "" + width*0.7 + "px";
	div_map.style.height = "" + height*0.6 + "px";
	//alert (width+"x"+height);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var res = JSON.parse(xmlhttp.responseText);
			//alert(res['stations'][0].name);
			var cent = new google.maps.LatLng(49.839186, 24.0200486);
			var mapProp = {
							  center:cent,
							  zoom: 11,
							  mapTypeId: google.maps.MapTypeId.ROADMAP
							  };

			var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
			for(var i = 0; i < res['stations'].length; i++) {
				var x = 49.839186 + res['stations'][i].lat*2.0/1000000;
				var y = 24.020048 + res['stations'][i].lon*2.0/1000000;
				var stop = 'Зупинка: ' + res['stations'][i].name;
				var addr = 'Адреса: ' + res['stations'][i].street;
				var near = res['stations'][i].near == null ? '' : 'Орієнтир: ' + res['stations'][i].near;
				var marker = new google.maps.Marker({
					  position:new google.maps.LatLng(x, y),
					  icon:'image/station.jpg',
					  title: stop + '\r\n' + addr + '\r\n' + near
					  });
				marker.setMap(map);		
			}
				
			var myTrip0 = [];
			var myTrip1 = [];
			var x0 = 0;
			var y0 = 0;
			var x1 = 0;
			var y1 = 0;			
			for(var i = 0; i < res['route'].length; i++) {
				if(+res['route'][i].direction == 0) {
					x0 += +res['route'][i].lat;
					y0 += +res['route'][i].lon;
					rx = 49.839186 + x0*2.0/1000000;
					ry = 24.0200486 + y0*2.0/1000000;
					myTrip0[myTrip0.length] = new google.maps.LatLng(rx, ry);						
				} else {
					x1 += +res['route'][i].lat;
					y1 += +res['route'][i].lon;
					rx = 49.839186 + x1*2.0/1000000;
					ry = 24.0200486 + y1*2.0/1000000;
					myTrip1[myTrip1.length] = new google.maps.LatLng(rx, ry);	
				}

			};
			var flightPath=new google.maps.Polyline({
			  path:myTrip0,
			  strokeColor:"#0000FF",
			  strokeOpacity:0.8,
			  strokeWeight:4
			  });

			flightPath.setMap(map);					
			var flightPath=new google.maps.Polyline({
			  path:myTrip1,
			  strokeColor:"#ff0000",
			  strokeOpacity:0.8,
			  strokeWeight:4
			  });

			flightPath.setMap(map);				
			google.maps.event.addDomListener(window, 'load');			
		}
	};
	xmlhttp.open("GET", "routes.php?route=coord&id=" + rid, true);
	xmlhttp.send();
	
}

var resetForm = function() {
	document.getElementById("s1").value = '';
	document.getElementById("s2").value = '';
	document.getElementById("sid1").value = '';
	document.getElementById("sid2").value = '';
	document.getElementById("res").innerHTML = '';
}
