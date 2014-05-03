<?php 
class ObjetsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {

        $this->set('objets', $this->Objet->find('all'));

    }
}