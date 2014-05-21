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
    <?= $this->Html->css('bootstrap'); ?>

    <!-- Yamm large dropdown css -->
    <?= $this->Html->css('yamm'); ?>

    <!-- Custom styles for this template -->
    <?= $this->Html->css('navbar'); ?>
    <!-- To load some css -->
    <?= $this->fetch('css'); ?>
    
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="yamm navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" >Pumpipumpe Online  <?php if ($this->Session->check('Auth.User')){ echo 'from ' . $currentUser;} ?></a>
        </div>
        <div class="navbar-collapse collapse" id="navigation">
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
            echo $this->Html->link( "Home",   array('plugin'=>null, 'controller' => 'users', 'action'=>'login')) . "</li>";

            // Affiche cela si l'utilisateur est logué
            if ($this->Session->check('Auth.User')){

                // Si la page actuelle est "objects", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'objets', 'action' => 'index'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "Objects",   array('plugin'=>null, 'controller' => 'objets', 'action'=>'index')) . "</li>";

                // Si la page actuelle est "account", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'users', 'action' => 'edit'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "Account",   array('plugin'=>null, 'controller' => 'users', 'action'=>'edit')) . "</li>";
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
                echo $this->Html->link( "Subscribe",   array('plugin'=>null, 'controller' => 'users', 'action'=>'subscribe') ) . "</li>" ;
            
            // Dropdown Login
                /*echo "
            <li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Login <b class='caret'></b></a>
              <ul class='dropdown-menu'>
                <div class='users form'>" .
                    $this->Form->create('User', array(
                        'inputDefaults' => array(
                            'div' => 'form-group',
                            'label' => array(
                                'class' => 'col col-md-3 control-label'
                            ),
                            'wrapInput' => 'col col-md-9',
                            'class' => 'form-control'
                        ),
                        'class' => 'well form-horizontal')) .
                    "<fieldset>" .
                            $this->Form->input('username', array('label'=>'Username')) .
                            $this->Form->input('password', array('label'=>'Password')) .
                    "</fieldset>" .
                    $this->Form->end(__('Login', array('action'=>'login'))) .
                "</div>
              </ul>
            </li>";**/

                  // Si la page actuelle est "contact", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'contactform'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "Contact",   array('plugin'=>'contactform', 'controller' => 'contactform', 'action'=> 'show') ) . "</li>" ;

                // Login dans la barre de recherche.
                echo  $this->Form->create('User', array(
                    'class'=>'form-inline navbar-form navbar-right',
                    'plugin'=>null,
                    'controller'=>'users',
                    'action'=>'login',
                    'role'=>'form',
                    'inputDefaults' => array(
                            'label' => false,
                            'div' => false,

                    ))) .
                    "<div class='form-group'>" .
                    $this->Form->input('username', array(
                        'type'=>'text',
                        'class'=>'form-control',
                        'placeholder'=>'Username'
                        )) . "</div>".
                    "<div class='form-group'>" .
                    $this->Form->input('password', array(
                        'type'=>'password',
                        'class'=>'form-control',
                        'placeholder'=>'Password'
                        )) . "</div>".
                    $this->Form->button('Login', array(
                        'class'=>'btn btn-default',
                        'type'=>'submit')) .
                    $this->Form->end();
        } ?>
            
            <?php 
            if ($this->Session->check('Auth.User')){
                echo "<li>" . $this->Html->link( "Logout",   array('plugin'=>null, 'controller' => 'users', 'action'=>'logout')) . "</li>";
            }   
            ?>

          </ul>

          <?php 
          // Barre de recherche. Visible que si l'utilisateur est logué.
          if ($this->Session->check('Auth.User')){
            echo  $this->Form->create('Objet', array(
                    'class'=>'form-inline navbar-form navbar-right',
                    'action'=>'search',
                    'role'=>'form',
                    'inputDefaults' => array(
                            'label' => false,
                            'div' => false,

                    ))) .
                    "<div class='form-group'>" .
                    $this->Form->input('search', array(
                        'type'=>'text',
                        'class'=>'form-control',
                        'placeholder'=>'Search'
                        )) . "</div>".
                $this->Form->button("<span class='glyphicon glyphicon-search'></span> Search", array(
                    'class'=>'btn btn-default',
                    'type'=>'submit')) .
                $this->Form->end();
            }
        ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <a>&nbsp;</a>
    <div class="container">
    <?= $this->fetch('content'); ?>
    </div>
    <?= $this->Js->writeBuffer(); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'); ?>
    <?= $this->Html->script('bootstrap'); ?>
    <?= $this->fetch('script'); ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle=tooltip]').tooltip()
    });
    </script>
  </body>
</html>