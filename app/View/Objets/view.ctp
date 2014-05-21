<?= $this->Session->flash(); ?>

<div class="jumbotron">
	<h1><?php echo h($objet['Objet']['name']); ?></h1>
	<p><small>Class: <?php echo $objet['Objet']['class']; ?></small></p> 
	<p><small>Owner: <?php echo $objet['Objet']['owner']; ?></small></p> 
	<p><?php echo h($objet['Objet']['description']); ?></p>
	<?php 
	if ($currentUser != $objet['Objet']['owner']){
		echo $this->Form->create('Objet', array('action'=>'borrow'));
			echo $this->Form->hidden('id', array('value' => $objet['Objet']['id']));
			echo $this->Form->hidden('borrower', array('value' => $currentUser));
			echo $this->Form->hidden('owner', array('value' => $objet['Objet']['owner']));
			echo $this->Form->submit('I want this object', array('class'=> 'btn btn-default'));
		echo $this->Form->end(); 
	}
	else {
		echo $this->Html->Link("Edit this object", array('action'=>'edit', $objet['Objet']['id']), array('class'=>'btn btn-default '));
		
		echo $this->Form->Button('Delete Object', array('class'=>'btn btn-default ', 'data-toggle'=>"modal", 'data-target'=>"#myModal"));
	?>
	
	<!-- Alert if wants to delete objet-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Do you really want to delete this object?</h4>
	      </div>
	      <div class="modal-body">
	        If you clicked on this button by mistake, please close this window. 
	        If not, make sure you want to delete this object and please click on the delete button.
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <?php echo $this->Html->Link("Delete this object", array('action'=>'delete', $objet['Objet']['id']), array('class'=>'btn btn-primary ')); ?>
	      </div>
	    </div>
	  </div>
	</div>

	<?php }
	unset($objet)?>

</div>
<div class='container'> <?php echo $this->Html->Link("Go back to the object page", array('action'=>'index'), array('class'=>'btn btn-default ')); ?> </div>