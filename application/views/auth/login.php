<?php $this->load->view('template/header'); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-heading">
      <h2 class="text-center">Login</h2>
    </div>
    <hr />
    <div class="modal-body">
      <div id="infoMessage"><?php echo $message;?></div>

      <?php echo form_open("auth/login");?>

      <p>
        <span class="glyphicon glyphicon-user"></span>
        <?php echo lang('login_identity_label', 'identity');?>
        <?php echo form_input($identity);?>
      </p>

      <p>
       <span class="glyphicon glyphicon-lock"></span>
       <?php echo lang('login_password_label', 'password');?>
       <?php echo form_input($password);?>
     </p>

     <p>
      
      <?php echo lang('login_remember_label', 'remember');?>
      <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
    </p>


    <p><?php echo form_submit('submit', lang('login_submit_btn'),"class='btn btn-danger btn-lg'");?></p>

    <?php echo form_close();?>

    <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
  </div>
</div>
</div>

