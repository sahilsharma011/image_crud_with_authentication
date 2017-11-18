<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href='<?php echo site_url('/')?>'>My Site</a>
    </div>
    <ul class="nav navbar-nav">
      <?php if ($this->ion_auth->is_admin()){
       echo '<li><a href='.site_url('images').'>Admin Panel</a></li>';
     }?>		
   </ul>
   <ul class="nav navbar-nav navbar-right">
    <?php if (!$this->ion_auth->logged_in()){
     echo '<li><a href='.site_url('auth/login').'><span class="glyphicon glyphicon-log-in"></span> Login</a></li>'; }
     else{
       echo '<li><a href='.site_url('auth/logout').'><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>';
     } ?>
   </ul>
 </div>
</nav>
<div class="container">