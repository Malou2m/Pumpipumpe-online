<div><?= $this->Session->flash(); ?></div>

<div class="container">
    <div class="panel-group" id="accordion">
          
          <!-- show objects by class with the tab function of bootstrap --> 
          <div class="panel panel-default">
              <div class="panel-heading">
                    <h1 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseZero">Objects sorted by class</a>
                    </h1>
              </div>
              <div id="collapseZero" class="panel-collapse collapse in">
                <div class="panel-body">

                      <ul class="nav nav-tabs">
                          <li class="active"><a href="#cooking" data-toggle="tab">Cooking</a></li>
                          <li><a href="#sport" data-toggle="tab">Sport</a></li>
                          <li><a href="#tool" data-toggle="tab">Tool</a></li>
                          <li><a href="#game" data-toggle="tab">Game</a></li>
                          <li><a href="#other" data-toggle="tab">Other</a></li>
                      </ul>
                      
                      <div class="tab-content">

                        <!-- Boucle sur les noms des classes pour appeler ces noms dans les ids, indexes, etc.-->
                        <?php foreach ($objets_keys as $key):
                            
                            // Affichage du premier élément, ici "cooking".
                            if ($key == 'cooking'){
                                echo "<div class='tab-pane fade in active' id = '" . $key . "' >";
                            }
                            else{
                                echo "<div class='tab-pane fade' id = '" . $key . "' >";
                            }

                                  // Teste si l'élément est vide.
                                  if(empty($objets_by_class[$key])){ echo "<div class='container'></br>There are no " . $key . " objects yet</br></div> ";}
                                          else{
                                                echo "
                                    <table class='table'>
                                        <thead>
                                          <tr>
                                              <th>" . $this->Paginator->sort('name', 'Name') . "</th>
                                              <th>" . $this->Paginator->sort('description', 'Description') . "</th>
                                              <th>" . $this->Paginator->sort('PLZ', 'Location') . "</th>
                                              <th>" . $this->Paginator->sort('owner', 'Owner') . "</th>

                                          </tr>
                                        </thead>
                                        ";  

                                        // Boucle sur les objets de chaque classe pour les afficher.
                                          foreach ($objets_by_class[$key] as $objet): ?>
                                          <tr>
                                              <td>
                                                  <?php echo $this->Html->link($objet['Objet']['name'], array( 'action' => 'view', $objet['Objet']['id']), array('data-toggle'=>"tooltip", 'data-placement'=>'left', 'title'=>"Click to view object")); ?>
                                              </td>
                                              
                                              <td><?php echo $objet['Objet']['description']; ?></td>
                                              <td><?php echo $objet['Objet']['PLZ']; ?></td>
                                              <td><?php echo $objet['Objet']['owner']; ?></td>
                                          </tr>
                                          <?php endforeach; }?>                                 
                                      </table>
                                  <!-- Boostcake numbering -->
                                 <?php echo $this->Paginator->pagination(array(
                                  'ul' => 'pagination'
                                )); ?>    
                            </div>
                      <?php endforeach; 
                      unset($objets_keys);
                      unset($objets_by_class);?>
                  </div>
              </div>
            </div>
  </div>
          
          <!-- shows the objects possessed by the current user. -->
          <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">My Objects</a>
                </h1>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
              <div class="panel-body">
              
                  <?php if(empty($my_objets)){ echo " <div class='panel-body'> You don't have any objects yet, would you like to " . $this->Html->link('add some', array('action'=>'add')) . " ?. </div>";}
                      else{
                            echo "
                <table class='table'>
                <thead>
                  <tr>
                      <th>" . $this->Paginator->sort('name', 'Name') . "</th>
                      <th>" . $this->Paginator->sort('description', 'Description') . "</th>
                      <th>" . $this->Paginator->sort('class', 'Class') . "</th>
                  </tr>
                </thead>
                    ";  
                      // Boucle sur les objets de l'utilisateur pour les afficher.
                      foreach ($my_objets as $objet): ?>
                      <tr>
                          <td>
                              <?php echo $this->Html->link($objet['Objet']['name'], array( 'action' => 'view', $objet['Objet']['id']), array('data-toggle'=>"tooltip", 'data-placement'=>'left', 'title'=>"Click to edit object")); ?>
                          </td>
                          
                          <td><?php echo $objet['Objet']['description']; ?></td>
                          <td><?php echo $objet['Objet']['class']; ?></td>
                      </tr>
                      <?php endforeach; ?>
                      
                  </table>

                  <!-- Boostcake numbering -->
                  <?php echo $this->Paginator->pagination(array(
                  'ul' => 'pagination'
                )); ?>

                  <?php echo $this->Html->Link("add a new object", array('action'=>'add'), array('class'=>'btn btn-primary ')); }?>

                  <?php unset($my_objets); ?>
              </div>
            </div>
          </div>

          <!-- shows the objects shared by the current user. -->

          <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Shared Objects</a>
                    </h1>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                    
                        <?php if(empty($shared_objets)){ echo " You aren't sharing any objects yet, would you like to " . $this->Html->link('add some', array('action'=>'add')) . " ?. ";}
                            else{
                                  echo "
                      <table class='table'>
                      <thead>
                        <tr>
                            <th>" . $this->Paginator->sort('name', 'Name') . "</th>
                            <th>" . $this->Paginator->sort('description', 'Description') . "</th>
                            <th>" . $this->Paginator->sort('borrower', 'B orrower') . "</th>
                            <th> </th>
                        </tr>
                      </thead>
                          ";  
                            // Boucle sur les objets de l'utilisateur pour les afficher.
                            foreach ($shared_objets as $objet): ?>
                            <tr>
                                <td>
                                    <?php echo $objet['Objet']['name']; ?>
                                </td>
                                
                                <td><?php echo $objet['Objet']['description']; ?></td>
                                <td><?php echo $objet['Objet']['borrower']; ?></td>
                                <td><?php echo $this->Html->Link("I received it back", array('action'=>'returnObject', $objet['Objet']['id']), array('class'=>'btn btn-default ')); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            
                        </table>

                        <!-- Boostcake numbering -->
                        <?php echo $this->Paginator->pagination(array(
                        'ul' => 'pagination'
                      )); }?>

                        <?php unset($my_objets); ?>
                    </div>
                </div>
        
          </div>
            

            <!-- shows the objects borrowed by the current user. -->
    
            <div class="panel panel-default">
                  <div class="panel-heading">
                      <h1 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Borrowed Objects</a>
                      </h1>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                      <div class="panel-body">
                      
                          <?php if(empty($borrowed_objets)){ echo "You haven't borrowed any objects yet.";}
                              else{
                                    echo "
                        <table class='table'>
                        <thead>
                          <tr>
                              <th>" . $this->Paginator->sort('name', 'Name') . "</th>
                              <th>" . $this->Paginator->sort('description', 'Description') . "</th>
                              <th>" . $this->Paginator->sort('owner', 'Owner') . "</th>
                              <th> </th>
                          </tr>
                        </thead>
                            ";  
                              // Boucle sur les objets de l'utilisateur pour les afficher.
                              foreach ($borrowed_objets as $objet): ?>
                              <tr>
                                  <td>
                                      <?php echo $objet['Objet']['name']; ?>
                                  </td>
                                  
                                  <td><?php echo $objet['Objet']['description']; ?></td>
                                  <td><?php echo $objet['Objet']['owner']; ?></td>
                                  <td><?php echo $this->Html->Link("No longer in my posession", array('action'=>'returnObject', $objet['Objet']['id']), array('class'=>'btn btn-default ')); ?></td>
                              </tr>
                              <?php endforeach; ?>
                              
                          </table>

                          <!-- Boostcake numbering -->
                          <?php echo $this->Paginator->pagination(array(
                          'ul' => 'pagination'
                        )); }?>

                          <?php unset($borrowed_objets); ?>
                      </div>
                  </div>
          </div>
    </div>
</div>


<!-- bootstrap tab js -->

<script type="text/javascript">
    $('#sport').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })

</script>