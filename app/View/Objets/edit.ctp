<div><?= $this->Session->flash(); ?></div>
<div class="objects form">
<?php echo $this->Form->create('Objet', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well'
)); ?>
    <fieldset>
        <legend><?php echo __('Change Object Informations'); ?></legend>
        <?php 
        echo $this->Form->hidden('id');
        echo $this->Form->input('name', array('label' => 'Name'));
        echo $this->Form->input('description');
        echo $this->Form->input('class', array(
            'options' => array( 'cooking' => 'Cooking', 'sport' => 'Sport', 'tool' => 'Tool', 'game' => 'Game', 'other' => 'Other')
        ));
        echo $this->Form->submit('Change Informations', array('class' => 'form-submit btn btn-default',  'title' => 'Click here to add the user') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<br/>