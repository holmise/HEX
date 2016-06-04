<!-- <p style="color:<?php echo $color2;?>; margin-left:15px;" ><?php echo $color; ?></p>
<p style="color:<?php echo $color2;?>; margin-left:15px;" ><?php echo $color2; ?></p> -->
<!-- <h3 style="color:<?php echo $color2;?>; margin-left:15px;" id="latituden"></h3>
<h3 style="color:<?php echo $color2;?>; margin-left:15px;" id="longituden"></h3> 
<p id="smhidata" style="color:<?php echo $color2;?>; margin-left:15px;"></p>-->
<!-- <div id="mapholder"></div> -->

<div id="map"></div>

<div class="one" style="text-align:center; position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%); text-shadow: 2px 2px #ee0000;">
<h1 style="color:<?php echo $color2;?>;">HEX.v.2.1 - Din plats, ditt väder</h1>


<h2 id="weatherData" style='color:<?php echo $color2;?>;'></h2>
<!-- <h2 id="weatherData2" style='color:<?php echo $color2;?>;'></h2> -->

</div>

<script type="text/javascript">
var x = document.getElementById("demo");

// debugger;

	function getLocation() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition, showError);
	    } else {
	        x.innerHTML = "Geolocation is not supported by this browser.";
	    }
	}

	function showPosition(position) {
	    var latlon = position.coords.latitude + "," + position.coords.longitude;

		var latlng = new google.maps.LatLng(position.coords.latitude ,position.coords.longitude);

	    var lat = Math.round(position.coords.latitude*100000)/100000;
	    var lon = Math.round(position.coords.longitude*100000)/100000;

	    // var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="
	    // +latlon+"&zoom=12&size=400x300&sensor=false";
	    
	    // document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
	    // document.getElementById("latituden").innerHTML = "Din latitud är: "+lat+".";
	    // document.getElementById("longituden").innerHTML = "Din longitud är: "+lon+".";

	    var styles = [
	{
		featureType: "landscape",
		stylers: [
			
			{ saturation: -100 }
		]
	},{
		featureType: "natural",
		stylers: [
			
			{ saturation: -100 }
		]
	},{
		featureType: "road",
		stylers: [
			
			{ saturation: -100 }
		]
	},{
		featureType: "building",
		elementType: "labels",
		stylers: [
			
			{ saturation: -100 }
		]
	},{
		featureType: "poi",
		stylers: [
			
			{ saturation: -100 }
		]
	}
];


	    var myOptions = {
		zoom: 12,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: true,
		styles: styles
		};

		map = new google.maps.Map(document.getElementById('map'), myOptions);
		var smhiapi = "http://opendata-download-metfcst.smhi.se/api/category/pmp1.5g/version/1/geopoint/lat/"+lat+"/lon/"+lon+"/data.json";
		//document.getElementById('smhidata').innerHTML = smhiapi;

                                          var tempres = document.getElementById('weatherData');
                                          var timeres = document.getElementById('weatherData2');
                                          

											function getJSON(url) {
											        var resp ;
											        var xmlHttp ;

											        resp  = '' ;
											        xmlHttp = new XMLHttpRequest();

											        if(xmlHttp != null)
											        {
											            xmlHttp.open( "GET", url, false );
											            xmlHttp.send( null );
											            resp = xmlHttp.responseText;
											        }

											        return resp ;
											    }


											var gjson ;
											gjson = getJSON(smhiapi);
											var obj = eval ("(" + gjson + ")");

											tempA = obj['timeseries'][6]['t'];
											

											tidA = obj['timeseries'][6]['validTime'];
											


											cloudyness = obj['timeseries'][0]['tcc'];
											rain = obj['timeseries'][0]['pit'];


                                          // if (rain > 3)
                                          //   image = "rain.png";
                                          // else if (cloudyness < 6)
                                          //   image = "sun.png";
                                          // else
                                          //   image = "cloud.png";

                                          // var weatherconstant = (rain*0.6) + (cloudyness/8);
                                          tempres.innerHTML = tempres.innerHTML + tempA + " &deg;C";
                                          timeres.innerHTML = timeres.innerHTML + tidA;
                                          
                                          
                                          // div.innerHTML = div.innerHTML + "<img id='weatherimg' src='img/" + image + "' class='img-responsive'><p>" + temp + "°C</p>";
                                       
                                   



		console.log("Din latitud är: "+lat+".");
	    console.log("Din longitud är: "+lon+".");
	    console.log(smhiapi);
	    console.log(tidßA);
	    console.log(cloudyness);
	    console.log(rain);
	}
function showError(error) {
	    switch(error.code) {
	        case error.PERMISSION_DENIED:
	            x.innerHTML = "User denied the request for Geolocation."
	            break;
	        case error.POSITION_UNAVAILABLE:
	            x.innerHTML = "Location information is unavailable."
	            break;
	        case error.TIMEOUT:
	            x.innerHTML = "The request to get user location timed out."
	            break;
	        case error.UNKNOWN_ERROR:
	            x.innerHTML = "An unknown error occurred."
	            break;
	    }
	}
</script>

