<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <?php $this->load->view('template/common.php'); ?>
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

</div>
</body>
</html>
