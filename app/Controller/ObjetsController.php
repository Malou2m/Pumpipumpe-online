<?php 

// Permet d'utiliser la fonction mail pour envoyer des mails.
App::uses('CakeEmail', 'Network/Email');


class ObjetsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {

        // N'afficher que les objets dont le nom est le même que l'utilisateur -> Afficher les objets de l'utilisateur.
        $conditions = array('owner' => $this->Auth->user('username'));
        $this->paginate = array(
                'limit' => 4,
                'order' => array('Objet.name' => 'asc' ),
                'conditions' => $conditions
        );
        $my_objets = $this->paginate('Objet');
        $this->set(compact('my_objets'));

         // Affiche les objets empruntés par l'utilisateur.
        $conditions = array('borrower' => $this->Auth->user('username'));
        $this->paginate = array(
                'limit' => 4,
                'order' => array('Objet.name' => 'asc' ),
                'conditions' => $conditions
        );
        $borrowed_objets = $this->paginate('Objet');
        $this->set(compact('borrowed_objets'));

        // Affiche les objets prêtés par l'utilisateur.
        $conditions = array('owner' => $this->Auth->user('username'), 'borrower !=' => null);
        $this->paginate = array(
                'limit' => 4,
                'order' => array('Objet.name' => 'asc' ),
                'conditions' => $conditions
        );
        $shared_objets = $this->paginate('Objet');
        $this->set(compact('shared_objets'));

        // Stockage des valeurs des classes dans un tableau
        $classes = array('cooking', 'sport', 'tool', 'game', 'other');

        // Stockage des éléments par classe à l'aide du paginator.
        foreach ($classes as $class){
            $this->paginate = array(
                'limit' => 4,
                'order' => array('Objet.name' => 'asc' ),
                'conditions' => array('class'=>$class, 'owner !=' => $this->Auth->user('username'), 'borrower' => null )
            );
            $objets[$class] = $this->paginate('Objet');
            
        }

        // Envoi du tableau d'objets trié par classes à la vue.
        $this->set('objets_by_class', $objets);

        // Envoi des noms des classes à la vue.
        $this->set('objets_keys', array_keys($objets));

    }

    public function add() {

    	// Exécute cette commande lorsque le formulaire est envoyé.
    	if ($this->request->is('post')) {

    		// Stocke l'entrée de l'utilisateur du nom de l'objet dans la variable $object_request_name.
    		$object_request_name = $this->request->data['Objet']['name'];

    		// Stocke ou pas l'objet ayant le même nom et le même "owner" dans la variable $may_existing_objet.
    		$may_existing_objet = $this->Objet->find('first', array('conditions' => array('name' => $object_request_name, 'owner' => $this->Auth->user('username'))));


    		// Si l'object du même nom a déjà été créé par l'utilisateur, renvoie un message d'erreur, sinon, execute ceci
    		if (empty($may_existing_objet)){

    			// Ouverture de la table objet en écriture.
    			$this->Objet->create();

    			// Variable "owner" devient le nom de l'utilisateur loggué.
            	$this->Objet->saveField('owner', $this->Auth->user('username'));

                // Variable "PLZ" devient celui de l'utilisateur loggué.
                $this->Objet->saveField('PLZ', $this->Auth->user('PLZ'));


            	// Si les données du formulaire peuvent être enregistrées dans la bdd, alors affiche un message de succès, sinon, message d'erreur.
            	if ($this->Objet->save($this->request->data)) {
                	$this->Session->setFlash(__('You have successfuly added your object'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'));
                    $this->redirect(array('action' => 'view', $this->Objet->id));

           		} else {
                	$this->Session->setFlash(__('The user could not be created. Please, try again.'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'));
            	}   
    		}

            // Sinon, affiche un message d'erreur.
    		else{
    			$this->Session->setFlash(__('You already have created an object with this name.'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'));
    		}


               
            
        }
    }

    public function search() {
        if ($this->request->is('post')) {
        
            // Si la requête n'est pas vide.
            if (!empty($this->request->data['Objet']['search'])){
                // Stocke l'entrée de l'utilisateur dans le champ de recherche de l'objet dans la variable $search_objet_name.

                $searchstr = $this->request->data['Objet']['search'];

                // Stocke toutes les condition sur les objets pouvant contenir la chaine recherchée dans $conditions.
                $conditions = array(
                    'or' => array(
                        "Objet.name" => "$searchstr",
                        // searches, if the searchstr matches to A PART of the description.
                        "Objet.description LIKE" => "%$searchstr%",
                        "Objet.plz" => "$searchstr",
                        "Objet.class" => "$searchstr",
                        "Objet.owner" => "$searchstr",
                        "Objet.borrower" => "$searchstr",
                    ),
                    'borrower'=>null
                );

                // Affichage user-friendly avec paginate.
                $this->paginate = array(
                'limit' => 3,
                'order' => array('Objet.name' => 'asc' ),
                'conditions' => $conditions
                );
                $objets = $this->paginate('Objet');
                $this->set(compact('objets'));
            }
            // Si la requête est vide.
            else{


                // Un message d'erreur est affiché.
                $this->Session->setFlash(__('Please enter a word in the search field'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'));

                // l'utilisateur est redirigé vers la page d'accueil.
                $this->redirect($this->Auth->redirectUrl());
            }

        }

        // Si l'utilisateur n'arrive pas sur cet url via post, il est redirigé vers la page d'accueil.
        else{
            $this->redirect(array('controller'=>'users','action' => 'index'));
        }
    }

    public function view($id = null) { 

        // lors de l'appel de cette fonction, une ID est passée en argument. 
        // Stockage de l'objet relié à l'ID passé en argument dans une variable.
        $objet = $this->Objet->findById($id); 

        // Stockage du nom de l'utilisateur dans une variable envoyée à la vue correspondante. 
        $currentUser = $this->Auth->user('username');
        $this->set(compact($currentUser));

        // Si l'objet n'existe pas, afficher un message d'erreur.
        if (!$objet) { 
            $this->Session->setFlash(__('There is no existing object relied this id.'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'));
            $this->redirect(array('action' => 'index'));
        }

        // Sinon, envoyer les données de l'objet à la vue.
        else{
            $this->set('objet', $objet);
        }
    }

    public function borrow(){
        
        // Charge le modèle "User" vu qu'il prend par défaut l'objet "Objet".
        $this->loadModel('User');


        $owner = $this->request->data('Objet.owner');

        $objet = $this->Objet->findByOwner($owner);

        // Stockage des données de l'utilisateur et du possesseur de l'objet dans des variables correspondantes. 
        $currentUser = $this->Auth->user('username');
        $borrower_email = $this->Auth->user('email');
        $owner_infos = $this->User->findByUsername($owner);
        $owner_email = $owner_infos['User']['email'];

        // Si la requête est en méthode post, faire cela
        if ($this->request->is('post')){

            // Si la requête a pu être sauvée (en l'occurence, le borrower devient le currentuser), le faire et afficher un message de succès.
            if ($this->Objet->save($this->request->data)) {

                // Envoye un mail à l'owner.
                $Email = new CakeEmail();
                $Email->config('contactform')
                    ->from(array($borrower_email => $currentUser))
                    ->to($owner_email)
                    ->subject('A user from Pumpipumpe would like to borrow one of your object')
                    ->send('Dear User, 

Mr '. $currentUser . ' wants to borrow your ' . $objet['Objet']['name'] . '. 
Please answer him on this adress: ' . $borrower_email . '.

The Pumpipumpe team thanks you for sharing your objects.');

                // Envoye un mail au borrower.
                $Email2 = new CakeEmail();
                $Email2->config('contactform')
                    ->from(array($borrower_email => $currentUser))
                    ->to($borrower_email)
                    ->subject('You could successfully borrow your object')
                    ->send('Dear User, 
                        Mr '. $currentUser . ', an email has been send to the owner of the ' . $objet['Objet']['name'] . '. 
                        
Please wait untill he has contacted you. 
If he has not for any reason, you can join him on this adress: ' . $owner_email . '.

We thank you for using Pumpipumpe online.');

                // Affiche un message de succès et redirige l'utilisateur vers la page d'accueil objet.
                $this->Session->setFlash(__('You could successfuly borrow the object.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'));
                $this->redirect(array('action' => 'index'));
            }
            // Sinon, affichage d'un message d'erreur.
            else{
                $this->Session->setFlash(__('You could not borrow the object. Sorry, try again.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'));
            }
        }
    }

    // lors de l'appel de cette fonction, une ID est passée en argument. 
    public function edit($id=null){
        // Teste s'il existe une id valable.
        if (!$id) {
            $this->Session->setFlash('Please provide a user id', 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
            $this->redirect(array('action'=>'index'));
        }

        // Stockage de l'objet relié à l'ID passé en argument dans une variable.
        $objet = $this->Objet->findById($id);  

        // Vérification si l'auteur est bel et bien en train de changer son propre objet.
        if ($objet['Objet']['owner'] == $this->Auth->user('username') && $objet['Objet']['owner'] != null){
            // Si la requête est en 'post', faire
            if ($this->request->is('post') || $this->request->is('put')) {
                    // Si les données de l'objet ont pu être changées, afficher les données modifiées et rediriger l'utilisateur vers la page de l'objet en question.
                    if ($this->Objet->save($this->request->data)) {
                        $this->Session->setFlash(__('The object has successfully been updated'), 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-success'));
                        $this->redirect(array('action' => 'view', $id));


                    }

                    // Sinon, afficher un message d'erreur.
                    else{
                        $this->Session->setFlash(__('Unable to update your object. Please try again.'), 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
                    }
            }
            else {              

                    // S'il n'y a pas encore de données entrées par l'utilisateur, afficher les données de mysql.
                    if (!$this->request->data) {
                        $this->request->data = $objet;
                    }
                
            }
        }
        else {
            $this->Session->setFlash(__("You don't have the right to change those informations"), 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
            $this->redirect(array('action' => 'view', $id));
        }
    }
    public function delete($id = null) {
        
        // Teste s'il existe une id valable.
        if (!$id) {
            $this->Session->setFlash('Please provide an object id', 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
            $this->redirect(array('action'=>'index'));
        }
        
        // L'ID envoyée en paramètre de la fonction est attribuée à l'objet.
        $this->Objet->id = $id;

        // Si l'objet n'existe pas, affiche un message d'erreur et renvoye l'utilisateur vers la page d'accueil.
        if (!$this->Objet->exists()) {
            $this->Session->setFlash('Invalid objet id provided', 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Objet->delete($id)) {

            // Affiche un message de succès et redirige l'utilisateur vers la page d'accueil objet.
            $this->Session->setFlash('Your Object has successfully been deleted', 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-success'));
            $this->redirect(array('action' => 'index'));
        }

        // Si aucune de ces conditions n'est respectée, affiche un message d'erreur.
        $this->Session->setFlash(__('Object was not deleted'), 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
        $this->redirect(array('action' => 'index'));
    }

    public function returnObject($id = null){

        // Teste s'il existe une id valable.
        if (!$id) {
            $this->Session->setFlash('Please provide an object id', 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
            $this->redirect(array('action'=>'index'));
        }
        
        // L'ID envoyée en paramètre de la fonction est attribuée à l'objet.
        $this->Objet->id = $id;

        // Si l'objet n'existe pas, affiche un message d'erreur et renvoye l'utilisateur vers la page d'accueil.
        if (!$this->Objet->exists()) {
            $this->Session->setFlash('Invalid objet id provided', 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
            $this->redirect(array('action'=>'index'));
        }

        // S'il est possible de réinitialiser la valeur 'borrower' de l'objet à null, faire
        if ($this->Objet->saveField('borrower', null)) {

            // Affiche un message de succès et redirige l'utilisateur vers la page d'accueil objet.
            $this->Session->setFlash('The object could have been returned successfully', 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-success'));
            $this->redirect(array('action' => 'index'));
        }

        // Si aucune de ces conditions n'est respectée, affiche un message d'erreur.
        $this->Session->setFlash(__('An error occured. The object is always borrowed.'), 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'));
        $this->redirect(array('action' => 'index'));
    }
}



