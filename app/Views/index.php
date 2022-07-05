<html>
<head>
    <title>SIAB SDWan Deployment</title>
    <style>
body {
  margin: 0px;
  padding: 0px;
}

h1 {
    display: inline-block;
    background-color: white;
    border: 2px solid black;
}

#map {
  height: 100%;
  width: 100%;
  background-color: grey;
}
#legend {
  font-family: Arial, sans-serif;
  background: #fff;
  padding: 10px;
  margin: 10px;
  border: 3px solid #000;
}

#legend h3 {
  margin-top: 0;
}

#legend img {
  vertical-align: middle;
}
    </style>
</head>
<body>
<div id="map"></div>
<div id="siab_sdwan" style="padding-left: 10px"><h1>&nbsp;&nbsp;PT. SIAB SDWAN Network&nbsp;&nbsp;</h1></div>

<script type="text/javascript">
function initMap() {
  var center = { <?php echo $google_data['MAPS_CENTER']; ?> };
  var noPoi = [{
      featureType: "poi",
      elementType: "labels",

      stylers: [{
            visibility: "off"
      }]
  }];
  var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 5.5,
      center: center
  });

  map.setOptions({styles: noPoi});

  var locations = [
<?php
    foreach($data as $d) {
        echo "['" . $d['name'] . "'," . $d['geolocation'] . ",", $d['connection_status_id'] . ", '" . $d['connection_type_id'] . "'],\n";
    };
?>
   ];

  var infowindow =  new google.maps.InfoWindow({});
  var marker, count;

  const iconBase = "https://maps.google.com/mapfiles/ms/icons/";
  const icons = {
    sdwan: {
      name: "SDWAN",
      icon: iconBase + "green-dot.png",
    },
    vpnip: {
      name: "VPNIP",
      icon: iconBase + "yellow-dot.png",
    },
    nolive: {
      name: "NO LIVE",
      icon: iconBase + "red-dot.png",
    },
  };

  /*
  const legend_content = {
    <?php 
    for($i=1;$i<=count($connection_status);$i++) {
      echo "'" . $connection_status[$i]."' : { counter: 0, },";
    }
    ?>
  };
  */

  for (count = 0; count < locations.length; count++) {
      marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[count][1], locations[count][2]),
          map: map,
          title: locations[count][0]
      });

      //legend_content[locations[count][0]].counter += 1
      //console.log(legend_content[locations[count][0]].counter)

      google.maps.event.addListener(marker, 'click', (function (marker, count) {
          return function () {
              infowindow.setContent(locations[count][0]);
              infowindow.open(map, marker);
          }
      })(marker, count));

      marker.setIcon(icons['sdwan'].icon);
      /*
      if (locations[count][3] == 1) {
          if (locations[count][4] == 1) {
              marker.setIcon(icons['sdwan'].icon);
          } else {
              marker.setIcon(icons['vpnip'].icon);
          }
      } else {
          marker.setIcon(icons['nolive'].icon);
      }
      */
  }

    /*
  const legend = document.getElementById("legend");

  for (const key in legend_content) {
    const type = legend_content[key];
    const counter = type.counter;
    //const icon = type.icon;
    const div = document.createElement("div");

    div.innerHTML = '<h4>' + counter + ' => ' + key + '</h4>';
    legend.appendChild(div);
  }

  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);

     */

    // Title
    const siab_sdwan = document.getElementById("siab_sdwan");
    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(siab_sdwan);

}

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_data['GOOGLE_MAPS_API_KEY'] ?>&callback=initMap">
</script>
</body>
</html>