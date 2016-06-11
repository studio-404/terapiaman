<?php
@include($c["website.directory.parts"]."/head.php");
@include($c["website.directory.parts"]."/reg-auth.php");
@include($c["website.directory.parts"]."/questions.php");
?>

<section class="container navigarion">
  <?php
  $lib_modules_navigation = new lib_modules_navigation(); 
  echo $lib_modules_navigation->menu($c);
  ?>
</section>
<main class="content">
<section class="col-lg-9 col-md-9 col-sm-12 left-side textpage">
		<h1>კითხვა პასუხი</h1>
		<div class="content-text">
			<button class="askquestion <?php echo (isset($_SESSION[$c["session.prefix"]."id"])) ? 'on' : 'off' ?>">დასვი კითხვა</button>
		</div>

		<div class="media">
			  <div class="media-body" itemscope itemtype="http://schema.org/Question">
			  	<?php
			  	$lib_modules_questions = new lib_modules_questions(); 
			  	echo $lib_modules_questions->ques($c); 
			  	?>
			  	<div class="loadmore_questions"></div>
			  </div>
		</div>
		<?php
		$all = $lib_modules_questions->countall;
		$perpage = $c["per.page.questions"]; 
		$currentpage = (int)lib_functions_geturl::num($c,2); 
		$maxpage = ceil($all/$perpage); 
		$prev = ($currentpage>=2) ? ($currentpage - 1) : 1;
		$next = ($currentpage>=$maxpage) ? $maxpage : ($currentpage + 1);
		if(!$currentpage){ $next = 2; }

		$aditional_search = '';
		$search = urldecode(lib_validate_request::method("GET","search")); 
		if(!empty($search) && strlen($search) > 3){
			$aditional_search = "/?search=".$search; 
		}
		?>
		<nav itemscope itemtype="https://schema.org/WebPage">
		  <ul class="pagination">
		    <li>
		      <a href="<?=$c["website.base"]?>კითხვა-პასუხი/გვერდი/<?=$prev.$aditional_search?>" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    <?php
		    for($x=1; $x<=$maxpage; $x++){
		    	$active = ($x==$currentpage || ($currentpage==0 && $x==1)) ? ' class="active"' : '';
		    	echo '<li'.$active.'><a href="'.$c["website.base"].'კითხვა-პასუხი/გვერდი/'.$x.$aditional_search.'" itemprop="relatedLink/pagination">'.$x.'</a></li>'; 	
		    }
		    ?>
		    
		    <li>
		      <a href="<?=$c["website.base"]?>კითხვა-პასუხი/გვერდი/<?=$next.$aditional_search?>" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>
	</section>

	<section class="col-lg-3 col-md-3 col-sm-12 right-side">
		<?php 
		$lib_modules_searchbox = new lib_modules_searchbox();
    	echo $lib_modules_searchbox->search($c, 2);

		$lib_modules_banners = new lib_modules_banners();
    	echo $lib_modules_banners->load($c); 
    	?>

	</section>
	</main>

<?php
@include($c["website.directory.parts"]."/footer.php");
?>