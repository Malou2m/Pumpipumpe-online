<?php 

class Objet extends AppModel {
	public $validate = array(
		'name' => array(
	            'nonEmpty' => array(
	                'rule' => array('notEmpty'),
	                'message' => 'A name is required'
	            )),
	    'description' => array(
	            'nonEmpty' => array(
	                'rule' => array('notEmpty'),
	                'message' => 'A description is required'))
	    );
}