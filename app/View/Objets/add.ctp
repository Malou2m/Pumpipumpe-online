<div><?= $this->Session->flash(); ?></div>


<?php echo $this->Form->create('Objet', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
));?>
    <fieldset>
        <legend><?php echo __('Add Object'); ?></legend>
        <?php echo $this->Form->input('name', array('placeholder' => 'myName'));
        echo $this->Form->input('description', array('type' => 'textarea'));
        echo $this->Form->input('class', array(
            'options' => array( 'cooking' => 'Cooking', 'sport' => 'Sport', 'tool' => 'Tool', 'game' => 'Game', 'other' => 'Other')
        ));
        
        echo $this->Form->submit('Add Object', array('class' => 'form-submit btn btn-default',  'title' => 'Click here to add the object') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); ?>