<!DOCTYPE html>
<html lang="en">
<head>
	<title>IWSnetwork</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href=<?php echo '"'.base_url().'assets/style.css"'?>>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyAEBh_6WKl7Ma-045DoO72Fl043Oz6SVjA"></script>
    <script src=<?php echo '"'.base_url().'assets/gmaps.min.js"'?>></script>
	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function (e) {
			$('#upload').on('click', function () {
				navigator.geolocation.getCurrentPosition(function(position){
					coords = position
					submitForm({
						lat: coords.coords.latitude,
						long: coords.coords.longitude
					})
				},function (error) {
					submitForm({
						lat: geoplugin_latitude(),
						long: geoplugin_longitude()
					})					
				});
			});
		});
		function submitForm(position){

			var file_data = $('#file').prop('files')[0];
			var form_data = new FormData();
			var description = $('#description').val();
			form_data.append('file', file_data);
			form_data.append('lat', position.lat);
			form_data.append('long', position.long);
			form_data.append('description', description);
			$.ajax({
				url: <?php echo '"'.base_url().'"' ?> + 'images/upload_file', 
				dataType: 'text', 
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#msg').html(response); 
				},
				error: function (response) {
					$('#msg').html(response); 
				}
			});
		}
	</script>

</head>
<body>
	<?php $this->load->view('template/nav.php'); ?>