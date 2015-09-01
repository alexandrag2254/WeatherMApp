
<script>
$(document).ready(function()
{
    function initialize(lat,lng,address1,address2,mid)
    {
       var mapCanvas = document.getElementById('map-canvas');
       var mapOptions = 
       {
          center: new google.maps.LatLng(lat, lng),
          zoom: 4,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      var bounds = new google.maps.LatLngBounds();

      var map = new google.maps.Map(mapCanvas, mapOptions);
      $.get("http://api.openweathermap.org/data/2.5/weather?lat=" +(lat)+'&lon='+(lng) +" ",function(res)
      {   
                // console.log(res);
                
                    // console.log(res);
                // $.get("https://maps.googleapis.com/maps/api/streetview?size=200x100&location="+(lat)+","+(lng)+"&heading=151.78&pitch=-0.76",function(res2)
                // {
                //  console.log(res2);

                var k = res.weather[0]['description'];


                var contentString= k;
                console.log(lng);
                console.log(lat);
                var infowindow = new google.maps.InfoWindow({
                    content:"<img src='https://maps.googleapis.com/maps/api/streetview?size=200x100&location="+(lat)+","+(lng)+"&heading=151.78&pitch=-0.76'><br>"+ k
                });
                var marker = new google.maps.Marker({
                        // icon:'http://maps.google.com/mapfiles/ms/icons/purple-dot.png',
                        position:new google.maps.LatLng(lat, lng),
                        map:map
                        // title:'Hello World'
                    });
                google.maps.event.addListener(marker,'click',function(){
                    infowindow.open(map,marker);
                });
                loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                bounds.extend(loc);
                var marker1 = new google.maps.Marker({
                    icon:'public/img/pin.png',
                    position:new google.maps.LatLng(address1[0], address1[1]),
                    map:map,
                        // title:'Hello World'
                    });
                loc1 = new google.maps.LatLng(marker1.position.lat(), marker1.position.lng());
                bounds.extend(loc1);
                var marker2 = new google.maps.Marker({
                    icon:'public/img/pin.png',
                    position:new google.maps.LatLng(address2[0], address2[1]),
                    map:map,
                        // title:'Hello World'
                    });
                loc2 = new google.maps.LatLng(marker2.position.lat(), marker2.position.lng());
                bounds.extend(loc2);
                var flightPlanCoordinates =
                [
                new google.maps.LatLng(address1[0], address1[1]),
                new google.maps.LatLng(lat, lng),
                new google.maps.LatLng(address2[0], address2[1])

                ]
                var flightPath = new google.maps.Polyline({
                    path:flightPlanCoordinates,
                    geodesic:true,
                    strokeColor: '#FF0000',
                    strokeOpacity:1.0,
                    strokeWeight:2
                });
                flightPath.setMap(map);

                map.fitBounds(bounds);
                map.panToBounds(bounds);
            });

        // });

}
google.maps.event.addDomListener(window, 'load', initialize);

geocoder = new google.maps.Geocoder();
        // FoursquareApi foursquareApi = new FoursquareApi("Client ID","Client Secret","Callback URL");
        function getCoordinate(address1, callback)
        {
            geocoder.geocode({ address: address1}, function(results,status)
            {
                var coords_obj = results[0].geometry.location;
                address1 = [coords_obj.A,coords_obj.F];
                callback(address1);
            })
            
        };
        function midpoint (address1, address2)
        {
            var lat = (address1[0] + address2[0])/2;
            var lng = (address1[1] + address2[1])/2;
            var midpoint = [lat, lng];
            return midpoint;
        }
        function temp(lat,lng)
        {

            $.get("http://api.openweathermap.org/data/2.5/weather?lat=" +(lat)+'&lon='+(lng) +" ",function(res)
            {
                $('#name').html(res.name);
                var j = res.weather[0]['description'];
                console.log(j);
                $('#temp').html(res.weather[0]['description']);
                // console.log(res.name);
                 // console.log(res.weather[0]['description']);

                var i = res.weather[0]['icon'];
                // console.log(i);
                if(i == '01d')
                {
                    $('#icon').html("<div class='sunny'></div> ");
                }
                else if(i == '01n')
                {
                    $('#icon').html("<div class='starry'></div>");
                }
                else if(i == '02d')
                {
                    $('#icon').html("<div class='sunny'></div>");
                }
                else if(i == '02n')
                {
                    $('#icon').html("<div class='starry'></div>");
                }
                else if(i == '03n')
                {
                    $('#icon').html("<div class='cloudy'></div>");
                }

                else if(i == '04d')
                {
                    $('#icon').html("<div class='cloudy'></div>");
                }
                else if(i == '04n')
                {
                    $('#icon').html("<div class='cloudy'></div>");
                }
                else if(i == '09n')
                {
                    $('#icon').html("<div class='rainy'></div>");
                }
                else if(i == '09d')
                {
                    $('#icon').html("<div class='rainy'></div>");
                }
                else if(i == '10d')
                {
                    $('#icon').html("<div class='rainy'></div>");
                }
                else if(i == '10n')
                {
                    $('#icon').html("<div class='rainy'></div>");
                }
                else if(i == '11n')
                {
                    $('#icon').html("<div class='stormy'></div>");
                }
                else if(i == '11d')
                {
                    $('#icon').html("<div class='stormy'></div>");
                }
                else if(i == '13d' || i == '13n')
                {
                    $('#icon').html("<div class='snowy'></div>");
                }
                else if(i == '50d' || i == '50n')
                {
                    $('#icon').html("<div class='cloudy'></div>");
                }               
            },"json");
return false;
            // "http://openweathermap.org/img/w/"+ res.weather[0]['icon'] +".png"

        }
        $('form').submit(function(){
            var address1 = $('#a1').val();
            var address2 = $('#a2').val();

            getCoordinate(address1, function(address1){ 
                getCoordinate(address2, function(address2){ 
                    var mid = midpoint(address1, address2);
                    temp(mid[0], mid[1]);
                    initialize(mid[0], mid[1],address2,address1);

                })
            });
            ;
            return false;
        })
    })
</script>

  <!-- About Section -->
    <section id="address" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Address</h2>
                <form class="form-inline" method="post">
                    <div class="form-group">
                        <input id="a1" type="text" name="address1" class="form-control" placeholder="Your Address" class="input-xlg">
                    </div>
                    <div class="form-group">
                        <input id= "a2" type="text" name="address2" class="form-control" placeholder="Your friend address">
                        </div>
                        <br></br>
               <button type="submit"  class="btn btn-primary btn-lg btn-block">Get Weather</button>
                 </form>
            </div>
        </div>
    </section>
    <!-- Weather Section -->

    <section id="weather" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>The weather</h2>
                    <!-- <div class="container"> -->
                       <div id="map-canvas">
                        </div>
                            <div id="icon"></div>
                        </div>
                        <div id="name"></div>
                            <div id="temp"></div>
                    </div>
                </div>
    </section>
    <!-- The Spot Section -->
   <!--  <section id="thespot" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>The Spot</h2>
                    <p></p>
                    <a href="" class="btn btn-default btn-lg">The spot</a>
                </div>
            </div>
        </div>
    </section>
    <br></br>
 -->
