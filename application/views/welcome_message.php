<?php $this->load->view('template/header'); ?>
<?php
if ($this->ion_auth->logged_in()) {
    echo '<div class="card">

        <div class="card-block">

            <form id="form-new-post">

                <textarea id="description" name="description" placeholder="Share what you think"
                          style="width: 100%;overflow:hidden;"></textarea>
                <hr>
                <div class="row">
                    <div class="col-xs-4">

                        <p id="msg"></p>
                        <input type="file" id="file" class="btn btn-primary btn-submit pull-left" name="file"/>

                    </div>
                    <div class="col-xs-4">

                    </div>
                    <div class="col-xs-4">

                        <button id="upload" type="button" class="btn btn-primary btn-submit pull-right">
                            Post!
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="gap"></div>';
}
?>

<?php foreach ($photos as $photo) {

    echo '<div class="card text-center" data-lat="' . $photo->latitude . '" data-long="' . $photo->longitude . '">
    <img style="display: block;width: 70%;  height: auto; margin-left:auto;margin-right:auto" class="card-img-top" src="assets/uploads/' . $photo->name . '" alt="Card image cap">
    <div class="card-block">
    <h4 class="card-title">'.$photo->description.'</h4>
    <p class="card-text"><small class="text-muted"></small></p>
    </div>
    </div><div class = "gap"></div>';

}
?>
    <script>
        var lat = null, long = null;

        $('.card[data-lat][data-long]').each(function (key, elem) {
            lat = $(elem).data().lat
            long = $(elem).data().long
            var latlng = new google.maps.LatLng(lat, long),
                geocoder = new google.maps.Geocoder();
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        for (var i = 0; i < results.length; i++) {
                            if (results[i].types[0] === "locality") {
                                var city = results[i].address_components[0].short_name;
                                var state = results[i].address_components[2].short_name;
                                $(elem).find('.card-text > .text-muted').text('Posted from '+city + ", " + state)
                            }
                        }
                    }
                    else {
                        console.log("No reverse geocode results.")
                    }
                }
                else {
                    console.log("Geocoder failed: " + status)
                }
            })
        })
    </script>
<?php $this->load->view('template/footer'); ?>