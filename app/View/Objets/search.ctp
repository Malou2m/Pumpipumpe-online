<!-- Cake paginator -->

    <div class="panel panel-default">
            <div class="panel-heading">
                  <h1 class="panel-title">Search results</h1>
            </div>
            <div class="panel-body">
                  <?php if(empty($objets_search)){ echo "No matches found, sorry.";}
                        else{
                              echo "
                  <table id='search' class='table display'>
                          <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Owner</th>
                            </tr>
                          </thead>
                          <tbody id='paginator_content'>  ";}  
                            foreach($objets_search as $objet): ?>
                              <tr>
                                  <td>
                                      <?php echo $this->Html->link($objet['Objet']['name'], array( 'action' => 'view', $objet['Objet']['id']), array('data-toggle'=>"tooltip", 'data-placement'=>'left', 'title'=>"Click to view object")); ?>
                                  </td>
                                  <td><?php echo $objet['Objet']['description']; ?> </td>
                                  <td><?php echo $objet['Objet']['PLZ']; ?></td>
                                  <td><?php echo $objet['Objet']['owner']; ?></td>
                              </tr>
                            <?php endforeach; ?>
                            <?php unset($objet); ?>
                          </tbody>
                   </table> 
            </div>
  </div> 

  <script>
  </script>