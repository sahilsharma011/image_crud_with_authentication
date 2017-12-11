<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <?php $this->load->view('template/common.php'); ?>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyAEBh_6WKl7Ma-045DoO72Fl043Oz6SVjA"></script>
    <script src=<?php echo '"'.base_url().'assets/gmaps.min.js"'?>></script>
    <style type='text/css'>
        body
        {
            font-family: Arial;
            font-size: 14px;
        }
        a {
            color: blue;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover
        {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<?php $this->load->view('template/nav.php'); ?>
<div>
    <?php $this->load->library('session'); ?>
    <input type="hidden" value="<?php echo $this->session->userdata['user_id']?>" name="user_id">
    <a href='<?php echo site_url('images/gallery')?>'>View photos</a>
</div>
<div style='height:20px;'></div>
<div>
    <div id="map-render" style="width: 100%; height: 500px">

    </div>
</div>
</body>
<script>
    var coords = null;
    navigator.geolocation.getCurrentPosition(function(position){
        coords = {
            lat: position.coords.latitude,
            long: position.coords.longitude
        }
        renderMap(coords)
    },function (error) {
        coords = {
            lat: geoplugin_latitude(),
            long: geoplugin_longitude()
        }
        renderMap(coords)
    });
</script>
<script type="text/javascript">
    var map = null;
    var isRequestSent = false
    function renderMap(coords) {
        map = new GMaps({
                el: '#map-render',
                lat: coords.lat,
                lng: coords.long,
                zoom: 14
            });
        var myLatLng = new google.maps.LatLng(coords.lat, coords.long);
        var circleOptions = {
            center: myLatLng,
            fillOpacity: 0,
            strokeOpacity: 0,
            map: map,
            radius: 25000
        }
        var myCircle = new google.maps.Circle(circleOptions);
        map.fitBounds(myCircle.getBounds());
        map.addMarker({
            lat: coords.lat,
            lng: coords.long,
            title: 'You',
            icon: <?php echo '"'.base_url().'assets/home_marker.png"'?>,
//            icon: <?php //echo '"'.base_url().'assets/uploads/pin-sizedthumb__ac41b-Sahil.jpeg"'?>//,
            infoWindow: {content: 'You'}
        });

        var mapBounds = null;
        map.addListener('bounds_changed', function () {
            mapBounds = map.getBounds();

            var lat1 = mapBounds.f.b
            var lat2 = mapBounds.f.f
            var long1 = mapBounds.b.b
            var long2 = mapBounds.b.f
            setTimeout(function () {
                if (!isRequestSent) {
                    isRequestSent = true
                    $.ajax({
                        url: <?php echo '"' . base_url() . '"'?>+'/images/nearbyImages',
                        data: {lat1: lat1, lat2: lat2, long1: long1, long2: long2},
                        success: function (data) {
                            isRequestSent = false
                            data = JSON.parse(data)
                            data.forEach(function (user) {
                                map.addMarker({
                                    lat: user.latitude,
                                    lng: user.longitude,
                                    title: user.username,
                                    icon: <?php echo '"'.base_url().'assets/uploads/"'?>+'pin-sizedthumb__'+user.name,
                                    infoWindow: {
                                        content: '<img height="350px" src='+<?php echo '"'.base_url().'assets/uploads/"'?>+user.name+'>'
                                    },
                                    click: function (e) {
                                        //  alert('You clicked in this marker');
                                    }
                                });
                            })
                        }
                    })
                }
            }, 500)
        });
    }
</script>
</html>
