<!-- Cake paginator -->

          <div class="panel panel-default">
            <div class="panel-heading">
              <h1 class="panel-title">Search results</h1>
            </div>
            <div class="panel-body">
              <?php if(empty($objets)){ echo "No matches found, sorry.";}
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
                  ";}  
                  foreach($objets as $objet): ?>
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
               </table> 
               <!-- Boostcake numbering -->
               <?php echo $this->Paginator->pagination(array(
                'ul' => 'pagination'
              )); ?>
            </div>
        </div> 