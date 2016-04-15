<?php
include("config.php");

if(isset($_GET['id'])){


$query = $db->prepare("SELECT * FROM klanten where klantnr = ?");
$query->bindValue(1, $_GET['id'], PDO::PARAM_STR);
$query->execute();
while($result = $query->fetch(PDO::FETCH_ASSOC)){
$adres = $result['adres']." ".$result['stad']."";
$content = $result['vnaam']." ".$result['anaam']."<br/>".$result['adres']."<br/>".$result['postcode']." ".$result['stad'];
$json = json_decode(file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($adres)."&sensor=false"));
if($json->status == "OK"){
$pos = $json->results[0]->geometry->location;
echo '<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>';
?>
<script>
  function initialize() {
  var pos = new google.maps.LatLng(<?php echo $pos->lat; ?>, <?php echo $pos->lng; ?>);
    var map_canvas = document.getElementById('map_canvas');
           var map_options = {
          center: pos,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options);
		
		var marker = new google.maps.Marker({
  position: pos,
  map: map
  });
  
  
     var iw1 = new google.maps.InfoWindow({
       content: "<?php echo $content; ?>"
     });
     google.maps.event.addListener(marker, "click", function (e) { iw1.open(map, this); });


  }
  
   google.maps.event.addDomListener(window, 'load', initialize);

</script>

<?php
echo "<h1>Maps</h1>";
echo '<div id="map_canvas" ></div>';
}else{
echo "<h1>error</h1>";
}
}

}else{
echo "<h1> error</h1>";
}
?>