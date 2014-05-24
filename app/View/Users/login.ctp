<!-- affiche "welcome $username lors d'un login" -->

<div><?= $this->Session->flash('auth_error') ?></div>
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
          <?php // echo $this->Html->image('pumpipumpe_slide1.png', array('alt' => 'pumpipumpe_slide1')); ?>
          <div class="container">
            <div class="carousel-caption">
              <h1>Welcome in Pumpipumpe online, the sharing community</h1>
              <p>In Pumpipumpe online, you will place some useful obects you own at the community's disposal. If you have for example a bike pump, you could share it with someone else who may do not have any. In the same way, you will be able to borrow objects you don't want to buy for using it twice a year! So, you will have both economical and ecological advantages by sharing your objects and borrowing other's!</p>
              <p><?= $this->Html->link( "Subscribe now!",   array('action'=>'subscribe'), array('class' => 'btn btn-lg btn-primary') ); ?></p>
            </div>
          </div>
        </div>
        <div class="item bg bg2">
          <div class="container">
            <div class="carousel-caption">
              <h1>Sharing is now the trend in Switzerland!</h1>
              <p>This Project is based on the <a href="http://www.pumpipumpe.ch/le-projet/">Pumpipumpe</a> project from the firm “Meteor Collectif”. They won several prices and their system works with stickers you put on your letter box.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <?php echo $this->Html->image('share-button.png', array('alt' => 'share-button')); ?>
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Begin now</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

<!-- content -->

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>What is pumpipumpe?</h1>
        <p>Pumpipumpe online is an online objects sharing platform based on the project <a href="http://www.pumpipumpe.ch/le-projet/"> Pumpipumpe</a> from the firm “Meteor Collectif”. The idea is to place some useful obects you own at the community's disposal. If you have for example a bike pump, you could share it with someone else who may do not have any. In the same way, you will be able to borrow objects you don't want to buy for using it twice a year! So, you will have both economical and ecological advantages by sharing your objects and borrowing other's! It's now time to <?= $this->Html->link( "join us!",   array('action'=>'subscribe'), array('class' => 'btn btn-lg btn-primary'))?></p>
        
      </div>

    </div> 



