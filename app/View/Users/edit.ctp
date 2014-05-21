<div><?= $this->Session->flash(); ?></div>
<div class="users form">
<?php echo $this->Form->create('User', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well'
)); ?>
    <fieldset>
        <legend><?php echo __('Change User Informations'); ?></legend>
        <?php 
        echo $this->Form->hidden('id', array('value' => $this->data['User']['id']));
        echo $this->Form->input('username', array( 'readonly' => 'readonly', 'label' => 'Usernames cannot be changed!'));
        echo $this->Form->input('email');
        echo $this->Form->input('password_update', array( 'label' => 'New Password (leave empty if you do not want to change)', 'maxLength' => 255, 'type'=>'password','required' => 0));
        echo $this->Form->input('password_confirm_update', array('label' => 'Confirm New Password *', 'maxLength' => 255, 'title' => 'Confirm New password', 'type'=>'password','required' => 0));
         
 
        echo $this->Form->input('PLZ', array('label' => 'Postal code', 'maxLength' => 4, 'title' => 'PLZ', 'type' => 'text'));
        echo $this->Form->submit('Change Informations', array('class' => 'form-submit btn btn-default',  'title' => 'Click here to add the user') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<br/>
