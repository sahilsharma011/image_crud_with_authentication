<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<?php $this->load->view('template/common.php'); ?>
	<?php 
	foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
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
		<a href='<?php echo site_url('images/imageWithTitle')?>'>Upload photos</a> | 
		<a href='<?php echo site_url('images/gallery')?>'>View photos</a>
	</div>
	<div style='height:20px;'></div>  
	<div>
		<?php echo $output; ?>
	</div>
</body>
</html>
