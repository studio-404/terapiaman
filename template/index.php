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
    $lib_modules_searchbox = new lib_modules_searchbox();
    echo $lib_modules_searchbox->search($c);
    
    $lib_modules_categorylist = new lib_modules_categorylist(); 
    echo $lib_modules_categorylist->cat($c);

    $main_options = array(
      "poll_id"=>"2", /* Poll unique ID */
      "header_text"=>"გამოკითხვა", /* Poll header text */
      "poll_question"=>"მოგწონთ ჩვენი ვებ გვერდი ?", /* Poll Question */
      "poll_answers"=>array(
        "დიახ", 
        "არაუშავს", 
        "არა" 
      ), /* Poll possible answers, You can have as many as you want */
      "please_wait"=>"<br />გთხოვთ დაიცადოთ ...<br /><br />", /* waiting text */
      "temp_path"=>$c["website.json.poll"] /* Temp folder path, recommending file permition 0755 */
    );
    echo '<div id="poll_container">';
    $lib_modules_gamokitxva = new lib_modules_gamokitxva(); 
    echo $lib_modules_gamokitxva->lanch($c, $main_options);
    echo '</div>';
    
    $lib_modules_banners = new lib_modules_banners();
    echo $lib_modules_banners->load($c); 
    ?>
  </section>
</main>
<?php
@include($c["website.directory.parts"]."/footer.php");
?>

