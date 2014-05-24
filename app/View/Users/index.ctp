

</div>
 <!-- Carousel Slider
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item bg bg1 active">
          <div class="container">
            <div class="carousel-caption">
              <h1>You need Objects? You want to add some new ones? </h1>
              <p>You can add ore borrow objects now on our object page</p>
              <p><?= $this->Html->link( "Object page",   array('controller' => 'objets', 'action'=>'index'), array('class' => 'btn btn-lg btn-primary') ); ?></p>
            </div>
          </div>
        </div>
        <div class="item bg bg2">
          <div class="container">
            <div class="carousel-caption">
              <h1>You need to change your informations or add some new objects? you can do this via the account page</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><?= $this->Html->link( "Account page",   array('controller' => 'users', 'action'=>'edit'), array('class' => 'btn btn-lg btn-primary') ); ?></p>
            </div>
          </div>
        </div>
      
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

<div class="container">
<div ><?= $this->Session->flash() ?></div>

<!-- content classified with bootstrap grid system-->
    <div class="row">
        <div class="col-md-3 ">

          <!-- Main component for a primary marketing message or call to action -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1 class="panel-title">How to use pumpipumpe?</h1>
            </div>
            <div class="panel-body">
            Simply add some objects you want to share via the object page or by clicking <?= $this->Html->link( "here",   array('controller' => 'objets', 'action'=>'index') ); ?>. If you want to change informations about your account, go through the <?= $this->Html->link( "account page",   array('controller' => 'users', 'action'=>'edit') ); ?>. If you want to borrow some objects, just click on their names and you will be redirected to the specific object page. And that's it!
            </div> 
          </div>
            
          

        </div> 

        <!-- Cake paginator -->
        <div class="col-md-9 ">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1 class="panel-title">Objects Suggestions</h1>
            </div>
            <div class="panel-body">
              <?php if(empty($objets)){ echo "There are not enough people in your area using pumpipumpe yet.";}
                    else{ 
                      
                      echo
              "<table class='table'>
                  <thead>
                    <tr>
                        <th>". $this->Paginator->sort('name', 'Name') . "</th>
                        <th>". $this->Paginator->sort('description', 'Description') . "</th>
                        <th>". $this->Paginator->sort('owner', 'Owner') . "</th>
                        <th>" . $this->Paginator->sort('PLZ', 'Location') . "</th>
                    </tr>
                  </thead>
                    <tbody id='paginator_content'>";
                          foreach($objets as $objet): ?>
                          
                              <tr>
                                  <td><?php echo $this->Html->link($objet['Objet']['name'], array('controller'=>'objets', 'action' => 'view', $objet['Objet']['id']), 
                                    // tooltip from bootstrap (activated in footer)
                                  array('data-toggle'=>"tooltip", 'data-placement'=>'left', 'title'=>"Click to view object")); ?> </td>
                                  <td><?php echo $objet['Objet']['description']; ?> </td>
                                  <td><?php echo $objet['Objet']['owner']; ?></td>
                                  <td><?php echo $objet['Objet']['PLZ']; ?></td>
                              </tr>
                          <?php endforeach; ?>
                          <?php unset($objet); ?>
                    </tbody>
               </table> 
               <!-- Boostcake numbering -->
               <?php echo $this->Paginator->pagination(array(
                'ul' => 'pagination'
              )); }?>
            </div>
        </div> 
    </div>