<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">-->

    <title>Pumpipume Online</title>

    <!-- Bootstrap core CSS -->
    <?= $this->Html->css('bootstrap.min'); ?>

    <!-- Custom styles for this template -->
    <?= $this->Html->css('navbar'); ?>
    <!-- To load some css -->
    <?= $this->fetch('css'); ?>
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" >Pumpipumpe Online  <?php if ($this->Session->check('Auth.User')){ echo 'from ' . $currentUser;} ?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

            <?php 

            // Si la page actuelle est "login" ou "index" de users, alors la classe de "li" est "active"
            if ($this->request->here== Router::url(array(
                                    'controller' => 'users', 
                                    'action' => 'login')) or 
                $this->request->here== Router::url(array(
                                    'controller' => 'users', 
                                    'action' => 'index'))){
                echo "<li class='active'>";
            }
            else{
                echo "<li>";
            }
            echo $this->Html->link( "Home",   array('controller' => 'users', 'action'=>'login')) . "</li>";

            // Affiche cela si l'utilisateur est logué
            if ($this->Session->check('Auth.User')){

                // Si la page actuelle est "objects", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'objets', 'action' => 'index'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "Objects",   array('controller' => 'objets', 'action'=>'index')) . "</li>";

                // Si la page actuelle est "account", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'users', 'action' => 'edit'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "Account",   array('controller' => 'users', 'action'=>'edit')) . "</li>";
                }
                

            // Affiche ceci s'il n'est pas logué
            else{
                // Si la page actuelle est "subscribe", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'users', 'action' => 'subscribe'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "Subscribe",   array('controller' => 'users', 'action'=>'subscribe') ) . "</li>" ;
            
            // Dropdown Login
                echo "
            <li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Login <b class='caret'></b></a>
              <ul class='dropdown-menu'>
                <div class='users form'>" .
                    $this->Form->create('User') .
                    "<fieldset>
                            <legend>" . 
                            __('Please enter your username and password'). 
                            "</legend>".
                            $this->Form->input('username') .
                            $this->Form->input('password') .
                    "</fieldset>" .
                    $this->Form->end(__('Login')) .
                "</div>
              </ul>
            </li>"; } ?>

            
            <li><a href='#contact'>Contact</a></li>
            
            <?php 
            if ($this->Session->check('Auth.User')){
                echo "<li>" . $this->Html->link( "Logout",   array('controller' => 'users', 'action'=>'logout')) . "</li>";
            }   
            ?>

          </ul>

          <?php 
          // Barre de recherche. Visible que si l'utilisateur est logué.
          if ($this->Session->check('Auth.User')){
            echo "
          <form class='navbar-form navbar-right' role='search'>
            <div class='form-group'>
              <input type='text' class='form-control' placeholder='Search'>
            </div>
            <button type='submit' class='btn btn-default'>
                <span class='glyphicon glyphicon-search'></span> Search
            </button>
          </form>";
            }
        ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    <?= $this->fetch('content'); ?>
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'); ?>
    <?= $this->Html->script('bootstrap.js'); ?>
    <?= $this->fetch('script'); ?>
  </body>
</html>