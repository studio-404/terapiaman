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
    <div class="textpage">
      <h1><?=$data['title']?></h1>
    </div>
    <div class="main-content">
      <?php
      echo $data['articles'];
      ?>

      <?php
      $slug = lib_functions_geturl::slugs($c); 
      $additional = '';
      $addtags = '';
      if(!empty($slug[1]) && !empty($slug[2])){ $additional = $slug[1]."/".$slug[2]."/"; }
      if(lib_validate_request::method("GET","tags")){
        $addtags = '&tags='.lib_validate_request::method("GET","tags");
      }
      $lib_database_allarticles = new lib_database_allarticles();
      $all = $lib_database_allarticles->countArticles($c, $slug);

      $perpage = $c["per.page.questions"]; 
      if($all>$perpage):
      
      $currentpage = (int)lib_validate_request::method("GET","pn"); 
      $maxpage = ceil($all/$perpage); 
      $prev = ($currentpage>=2) ? ($currentpage - 1) : 1;
      $next = ($currentpage>=$maxpage) ? $maxpage : ($currentpage + 1);
      if(!$currentpage){ $next = 2; }
      ?>
      <nav itemscope itemtype="https://schema.org/WebPage">
        <ul class="pagination">
          <li>
            <a href="<?=$c["website.base"]?>ყველა-სტატია/<?=$additional?>?pn=<?=$prev.$addtags?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <?php
          for($x=1; $x<=$maxpage; $x++){
            $active = ($x==$currentpage || ($currentpage==0 && $x==1)) ? ' class="active"' : '';
            echo '<li'.$active.'><a href="'.$c["website.base"].'ყველა-სტატია/'.$additional.'?pn='.$x.$addtags.'" itemprop="relatedLink/pagination">'.$x.'</a></li>';  
          }
          ?>
          
          <li>
            <a href="<?=$c["website.base"]?>ყველა-სტატია/<?=$additional?>?pn=<?=$next.$addtags?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
      <?php
      endif;
      ?>
    </div>

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

