<?php $this->load->view('template/header'); ?>

  <!--<h2>Image banner</h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      
      < ?php $i = 0;foreach($photos as $photo){
      	if($i==0){
      		echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
      	}
      	else{
      		echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
  		}
  		$i++;
      }?>

    </ol>

    <div class="carousel-inner">
    
      
      < ?php $i = 0; foreach ($photos as $photo){
      	if($i == 0){
      		echo '<div class="item active">
        <a href ='.$photo->url.'>
        <img src="assets/uploads/'.$photo->name. '" style="width:100%; ">
        </a>
      </div>';
      	}else{echo '<div class="item">
      	<a href ='.$photo->url.'>
        <img src="assets/uploads/'.$photo->name. '"  style="width:100%; ">
        </a>
      </div>';}
      $i++;
      
      }?>
      
      
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>-->
  
  <?php foreach($photos as $photo) {

echo '<div class="panel-body">
  <img class="card-img-top" src="assets/uploads/'.$photo->name.'" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">'.$photo->name.'</h4>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
  </div>'
  ;

}
?>
<?php $this->load->view('template/footer'); ?>