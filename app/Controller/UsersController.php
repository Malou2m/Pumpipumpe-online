<?php 

class UsersController extends AppController {

    
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','subscribe'); 
    }
    


    public function login() {
        
        $this->User->validator()->remove('username');

        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){  
            $this->redirect(array('action' => 'index'));    
        }

        
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome '. $this->Auth->user('username')), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'));
                // Redirige l'utilisateur sur la page sur laquelle il était avant le login
                $this->redirect(array('action' => 'index'));
            } 

            // Bootstrap alert message using boostcake plugin.
            else {
                $this->Session->setFlash(__('Invalid username or password'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'), 'auth_error');
            }
        } 
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {

        // stockage du code postal de l'utilisateur dans une variable
        $currentUserPLZ = $this->Auth->user('PLZ');

        // Charge le modèle "Objet" vu qu'il prend par défaut l'objet "User".
        $this->loadModel('Objet');

        // $objets_suggestion = $this->Objet->find('all', array('conditions' => array('PLZ' => $currentUserPLZ))); (plus nécessaire avec paginator)
       if (!empty($currentUserPLZ)){
            $this->paginate = array(
                'limit' => 3,
                'order' => array('Objet.name' => 'asc' ),

                // Ne sont affichés que les objets: 
                // - Dont le PLZ est le même que celui de l'utilisateur
                // - Qui ne sont pas empruntés
                // - Dont le propriétaire n'est pas l'utilisateur
                'conditions' => array(
                        'PLZ' => $currentUserPLZ, 
                        'borrower'=>null, 
                        'owner !=' => $this->Auth->user('username'))
            );
            $objets = $this->paginate('Objet');
            $this->set(compact('objets'));
       }

    }


    public function subscribe() {
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){  
            $this->redirect(array('action' => 'index'));    
        }

        if ($this->request->is('post')) {
                
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Auth->login();
                $this->Session->setFlash(__('You have successfuly been registered'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'));
            }   
        }
    }

    public function edit() {

            $currentUserId = $this->Auth->user('id');
            $this->set(compact('currentUserId'));
            if (!$currentUserId) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'index'));
            }

            $user = $this->User->findById($currentUserId);
            if (!$user) {
                $this->Session->setFlash('Invalid User ID Provided');
                $this->redirect(array('action'=>'index'));
            }

            if ($this->request->is('post') || $this->request->is('put')) {

                // Vérifie qu'au moins une information soit bien changée
                $this->User->id = $currentUserId;
                if($this->request->data('User.username')==$user['User']['username'] && 
                    $this->request->data('User.email')==$user['User']['email'] && 
                    $this->request->data('User.PLZ')==$user['User']['PLZ']){
                        $this->Session->setFlash(__('You must at least change one field'), 'alert', array(
                                            'plugin' => 'BoostCake',
                                            'class' => 'alert-warning'));
                }
                
                else if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been updated'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'));
                    $this->redirect(array('action' => 'edit'));
                }else{
                    $this->Session->setFlash(__('Unable to update your user.'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'));
                }
            }

            if (!$this->request->data) {
                $this->request->data = $user;
            }
    }

    public function delete($id = null) {
        
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function activate($id = null) {
        
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }

}
