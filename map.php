<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 95%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
<div id="map"></div>
<?php
require_once('Navbar.php');
require_once('dbconfig.php');

$query = "SELECT * FROM dogs";
$result = mysqli_query($connect, $query);
$query2 = "SELECT * FROM dogs_vag";
$result2 = mysqli_query($connect, $query2);
$i=0;

$type = $_GET['type'];
if($type == "All"){
  $setall = 1;
}
elseif($type == "Cat"){
  $setall = 2;
}
elseif($type == "Dog"){
  $setall = 3;
}
else{
  $setall = 1;
}



?>
   
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow,marker;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 14.0656915, lng: 100.61388199999999},
          zoom: 12
        });

        infoWindow = new google.maps.InfoWindow;
        
        // HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            // Create the DIV to hold the control and call the CenterControl()
            // constructor passing in this DIV.
            var centerControlDiv = document.createElement('div');
            var centerControl = new CenterControl(centerControlDiv, map);

            centerControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
            infoWindow.setPosition(pos);
            //infoWindow.setContent("You're here.");
            //infoWindow.open(map);
            var currCenter = map.setCenter(pos);
            google.maps.event.trigger(map, 'resize');
            map.setCenter(pos);
             //current location marker
            var marker = new google.maps.Marker({
            position: pos,
            map: map,
            });
            // Icons for markers
            var icons = {
			       url: "images/DogIcon.png", // url
			       scaledSize: new google.maps.Size(50, 50), // scaled size
			     };
           var icons2 = {
             url: "images/DogIcon2.png", // url
             scaledSize: new google.maps.Size(50, 50), // scaled size
           };
           var homeicons = {
             url: "images/Home.png", // url
             scaledSize: new google.maps.Size(50, 50), // scaled size
           };
            // Sample marker
<?php

 while($row = mysqli_fetch_array($result))
  {
    // echo $type .$row['pet_type'];
    // Dog
    if($type == $row['pet_type'] && $setall == 3){

            echo 'var marker = new google.maps.Marker({position: {lat:'.$row['location_x'].', lng:'.$row['location_y'].'},
            map: map,
            icon:icons,
            url: "dog_detail.php?id='.$row['dog_id'].'&type='.$type.'"
           	});';

            echo " google.maps.event.addListener(marker, 'click', function() {
                window.location.href = this.url;
            });";
    // Cat
    }if($type == $row['pet_type'] && $setall == 2) {
        echo 'var marker = new google.maps.Marker({position: {lat:'.$row['location_x'].', lng:'.$row['location_y'].'},
        map: map,
        icon:icons2,
        url: "dog_detail.php?id='.$row['dog_id'].'&type='.$type.'"
        });';

        echo " google.maps.event.addListener(marker, 'click', function() {
            window.location.href = this.url;
        });";
    // All
    }elseif($setall == 1){
      if($row['pet_type'] == "Cat"){
        echo '      var icons = {
          url: "images/DogIcon2.png", // url
          scaledSize: new google.maps.Size(50, 50), // scaled size
        };';
      }
      else{
        echo '      var icons = {
          url: "images/DogIcon.png", // url
          scaledSize: new google.maps.Size(50, 50), // scaled size
        };';
      }


      echo 'var marker = new google.maps.Marker({position: {lat:'.$row['location_x'].', lng:'.$row['location_y'].'},
        map: map,
        icon:icons,
        url: "dog_detail.php?id='.$row['dog_id'].'&type='.$type.'"
        });';

        echo " google.maps.event.addListener(marker, 'click', function() {
            window.location.href = this.url;
        });";

    }
  }
?>

<?php

//  while($row2 = mysqli_fetch_array($result2))
//   {  

//             echo 'var marker2 = new google.maps.Marker({position: {lat:'.$row2['dc_x'].', lng:'.$row2['dc_y'].'},
//             map: map,
//             icon:icons2,
//             url: "dogsvag_detail.php?id='.$row2['dc_id'].'"
//             });';

//             echo " google.maps.event.addListener(marker2, 'click', function() {
//                 window.location.href = this.url;
//             });";
//   }
// ?>
           
            


            // Marker for Animal Shelter
            var hmarker = new google.maps.Marker({
            position: {lat:14.015359, lng:100.680771},
            map: map,
            icon:homeicons
            });

            var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h2 id="firstHeading" class="firstHeading">ศูนย์พึ่งพิง คลองสิบสอง เทศบาลนครรังสิต</h2>'+
            '<div id="bodyContent">'+
            '<p><b>ทดสอบ</b>, เทศบาลบ้านรับเลี้ยงสุนัข.</p>'+
            '<p>Attribution: ลองกดดู, <a href="http://www.rangsit.org/dog/part2.htm">'+
            'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
            '<br><br>'+
            '<a href= "dog_shelter.php?id=1">'+
            ' <button class="w3-button w3-red w3-round-xlarge w3-padding-large" >View Dogs in this shelter</button>'+
            '</a>'+
            '</div>'+
            '</div>';

            var infowindow = new google.maps.InfoWindow({
              content: contentString
            });
  
            hmarker.addListener('click', function() {
            /*window.location.href = "dogshelter_detail.php"// linked to info view of the shelter.*/
            infowindow.open(map, hmarker);
            /*map.setZoom(6);//Remove this if the link had been added.*/
            });
            function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
            var controlUI = document.createElement('div');
            controlUI.style.backgroundColor = '#fff';
            controlUI.style.border = '2px solid #fff';
            controlUI.style.borderRadius = '3px';
            controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI.style.cursor = 'pointer';
            controlUI.style.marginBottom = '22px';
            controlUI.style.textAlign = 'center';
            controlUI.title = 'Click to recenter the map';
            controlDiv.appendChild(controlUI);

            // Set CSS for the control interior.
            var controlText = document.createElement('div');
            controlText.style.color = 'rgb(25,25,25)';
            controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
            controlText.style.fontSize = '16px';
            controlText.style.lineHeight = '38px';
            controlText.style.paddingLeft = '5px';
            controlText.style.paddingRight = '5px';
            controlText.innerHTML = 'Center Map';
            controlUI.appendChild(controlText);

            // Setup the click event listeners: simply set the map to Chicago.
            controlUI.addEventListener('click', function() {
              map.setCenter(pos);
            });

      }


          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
     
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgVlJ_NecM0OUGWlenJcQRmYJpyb4i5vU&callback=initMap">
   
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


      
    </h1>
<div class="container">
  <div class="row m-2 justify-content-md-center">
    <div class="col col-lg-1">
      Search for pets:

    </div>
    <div class="col col-lg-2">
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php 
            if($_GET['type']){
              echo $type;
            }
            else{
              echo "Select type!";
            }
          ?>
          
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="map.php?type=<?php echo "All" ?>">All</a>
          <a class="dropdown-item" href="map.php?type=<?php echo "Dog" ?>">Dog</a>
          <a class="dropdown-item" href="map.php?type=<?php echo "Cat" ?>">Cat</a>
        </div>
      </div>
    </div>

  </div>

</div>

</div>