<!-- content -->

<div class="users form container">
 
<?php echo $this->Form->create('User');?>
    <fieldset class="jumbotron">
        <h1><?php echo __('Subscribe'); ?></h1>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password'));
        echo $this->Form->input('PLZ', array('label' => 'PLZ', 'maxLength' => 4, 'title' => 'PLZ', 'type' => 'text'));
         
        echo $this->Form->submit('Subscribe', array('class' => 'form-submit',  'title' => 'Click here to subscribe') ); 
?>
    
<?php echo $this->Form->end(); ?>
</fieldset>
</div>