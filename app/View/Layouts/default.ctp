<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>favicon.ico">

    <title>Pumpipume Online</title>

    <!-- Bootstrap core CSS -->
    <?= $this->Html->css('bootstrap'); ?>

    <!-- Yamm large dropdown css -->
    <?= $this->Html->css('yamm'); ?>

    <!-- Custom styles for this template -->
    <?= $this->Html->css('navbar'); ?>
    <!-- To load some css -->
    <?= $this->fetch('css'); ?>

    <!-- new font: open sans -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>

    <!-- paginator plugin -->

    <link href='//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css' rel='stylesheet' type='text/css'>

    
    
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" ><?= $this->Html->image('logo.png', array('alt' => 'logo', 'width'=>'150px'))?>  <?php if ($this->Session->check('Auth.User')){ echo 'from ' . $currentUser;} ?></a>
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
            echo $this->Html->link( "HOME",   array('plugin'=>null, 'controller' => 'users', 'action'=>'login')) . "</li>";

            // Affiche cela si l'utilisateur est logué
            if ($this->Session->check('Auth.User')){

                // Si la page actuelle est "objects", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'objets', 'action' => 'index'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "OBJECTS",   array('plugin'=>null, 'controller' => 'objets', 'action'=>'index')) . "</li>";

                // Si la page actuelle est "account", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'users', 'action' => 'edit'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "ACCOUNT",   array('plugin'=>null, 'controller' => 'users', 'action'=>'edit')) . "</li>";
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
                echo $this->Html->link( "SUBSCRIBE",   array('plugin'=>null, 'controller' => 'users', 'action'=>'subscribe') ) . "</li>" ;
        
                  // Si la page actuelle est "contact", alors la classe de "li" est "active"
                if ($this->request->here== Router::url(array('controller' => 'contactform'))){
                    echo "<li class='active'>";
                }
                else{
                    echo "<li>";
                }
                echo $this->Html->link( "CONTACT",   array('plugin'=>'contactform', 'controller' => 'contactform', 'action'=> 'show') ) . "</li>" ;

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
                echo "<li>" . $this->Html->link( "LOGOUT",   array('plugin'=>null, 'controller' => 'users', 'action'=>'logout')) . "</li>";
            }   
            ?>

          </ul>

          <?php 
          // Barre de recherche. Visible que si l'utilisateur est logué.
          if ($this->Session->check('Auth.User')){
            echo  "<div class='input-group navbar-right'>" . 
                        $this->Form->create('Objet', array(
                        'class'=>'form-inline navbar-form navbar-right',
                        'action'=>'search',
                        'role'=>'form',
                        'inputDefaults' => array(
                                'label' => false,
                                'div' => false,

                        ))) .
                        "<input name='data[Objet][search]' class='form-control' placeholder='Search' type='text' id='ObjetSearch'/>" .
                            "<span class='input-group-btn'>" .
                                $this->Form->button("<span class='glyphicon glyphicon-search'></span> Search", array(
                                'class'=>'btn btn-default',
                                'type'=>'submit')) . 
                            "</span>
                        ".
                        $this->Form->end() . 
                    "</div>";
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

    <!-- Pagination jquery-->
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#search').dataTable({
                    // N'affiche que les éléments "length", "info" et "pagination" autour de la table. voir http://www.datatables.net/examples/basic_init/dom.html
                    'sDom' : '<"top"l>tr<"bottom"ip><"clear">',
                    // Affiche le contenu par 10, par 25 ou par 50 sur une page.
                    "lengthMenu": [10, 25, 50],
                    // N'affiche les boutons que lorsqu'ils sont nécessaires, c'est à dire quand il y a plus d'une page à afficher.
                    "fnDrawCallback":function(){
                        if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1)  {
                            $('#search_paginate')[0].style.display = "block";
                            $('#search_info')[0].style.display = "block";
                            $('#search_length')[0].style.display = "block";
                        } else {
                            $('#search_paginate')[0].style.display = "none";
                            $('#search_info')[0].style.display = "none";
                            $('#search_length')[0].style.display = "none";
                        }
                    }
                });
                
                // Utilisation de "data tables" pour tous les éléments de la view index du controller objet.
                var ids = new Array("#objets_cooking", "#myObjets", "#shared_objets", "#borrowed_objets", "#objets_sport", "#objets_tool", "#objets_game", "#objets_other" );

                // Boucle sur les différentes paginations. Affiche à chaque fois les boutons ne navigation ("p") en dessous du tableau ("t")
                for(var i= 0; i < ids.length; i++)
                {
                     $(ids[i]).dataTable({
                        'sDom' : '<"top"tr><"bottom"p><"clear">',
                        "lengthMenu": [10],
                        // Idéalement, n'afficherait la pagination que lorsqu'il y a plus d'une page à afficher. Ne fonctionne que sur le premier élément, donc laissé en commentaire pour l'instant.
                        /*"fnDrawCallback":function(){
                            if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1)  {
                                $(ids[i]+'_paginate')[0].style.display = "block";
                                $(ids[i]+'_info')[0].style.display = "block";
                                $(ids[i]+'_length')[0].style.display = "block";
                            } else {
                                $(ids[i]+'_paginate')[0].style.display = "none";
                                $(ids[i]+'_info')[0].style.display = "none";
                                $(ids[i]+'_length')[0].style.display = "none";
                            }
                        }*/
                    });
                }
            } );
    </script>
  </body>
</html>