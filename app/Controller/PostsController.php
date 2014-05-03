<?php 
class PostsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {

    	Debugger::dump($this->Post);

        $this->set('posts', $this->Post->find('all'));

    }
}