<?php
use Cake\Core\Configure;
?>
<?php $this->append('script'); ?>
<script src="http://maps.google.com/maps/api/js?key=<?php echo Configure::read('Google.maps.api.key'); ?>"></script>
<script>
    window.onload = function () {
        initialize();
    };

    function initialize() {
        var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);

        var myOptions = {
            zoom: 4,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        //var infowindow = new google.maps.InfoWindow({
        //    content: ""
        //});

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: ""
        });

        //google.maps.event.addListener(marker, 'click', function() {
        //    infowindow.open(map,marker);
        //});
    }
</script>
<?php $this->end(); ?>

<div id="map_canvas"></div>