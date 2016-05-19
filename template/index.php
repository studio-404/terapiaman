<?php
@include($c["website.directory.parts"]."/head.php");
@include($c["website.directory.parts"]."/reg-auth.php");
?>

<section class="container navigarion">
  <?php
  $lib_modules_navigation = new lib_modules_navigation(); 
  echo $lib_modules_navigation->menu($c);
  ?>
</section>

<main class="content">
  <section class="col-lg-9 col-md-9 col-sm-12 left-side">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <?php
        $lib_modules_slideshow = new lib_modules_slideshow(); 
        echo $lib_modules_slideshow->slider($c); 
        ?>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="leftarrow"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="rightarrow"></span>
      </a>
    </div>

    <div class="main-content">
      <?php
      $lib_modules_welcomepagearticles = new lib_modules_welcomepagearticles(); 
      echo $lib_modules_welcomepagearticles->art($c); 
      ?>
    </div>
    <div class="loadergif"></div>
      <div class="loader"><a href="<?=$c["website.base"]?>ყველა-სტატია">ყველა სტატია »</a></div>

  </section>
  <section class="col-lg-3 col-md-3 col-sm-12 right-side">
    <?php
    $lib_modules_categorylist = new lib_modules_categorylist(); 
    echo $lib_modules_categorylist->cat($c);

    $lib_modules_gamokitxva = new lib_modules_gamokitxva(); 
    echo $lib_modules_gamokitxva->gamo($c);
    ?>

    

    <div class="banners">
      <ul>
        <li><a href="calc.php"><img src="img/banner1.png" alt="" /></a></li>
      </ul>
    </div>

  </section>
</main>
<?php
@include($c["website.directory.parts"]."/footer.php");
?>

