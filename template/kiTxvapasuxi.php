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
		<h1><span class="icon-about" style="background-image: url('img/qanswers.png');"></span> კითხვა პასუხი</h1>
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
		?>
		<nav itemscope itemtype="https://schema.org/WebPage">
		  <ul class="pagination">
		    <li>
		      <a href="<?=$c["website.base"]?>კითხვა-პასუხი/გვერდი/<?=$prev?>" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    <?php
		    for($x=1; $x<=$maxpage; $x++){
		    	$active = ($x==$currentpage || ($currentpage==0 && $x==1)) ? ' class="active"' : '';
		    	echo '<li'.$active.'><a href="'.$c["website.base"].'კითხვა-პასუხი/გვერდი/'.$x.'" itemprop="relatedLink/pagination">'.$x.'</a></li>'; 	
		    }
		    ?>
		    
		    <li>
		      <a href="<?=$c["website.base"]?>კითხვა-პასუხი/გვერდი/<?=$next?>" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>
	</section>

	<section class="col-lg-3 col-md-3 col-sm-12 right-side">
		<div class="banners" style="margin-top:0">
			<ul>
				<li><a href="calc.php"><img src="img/banner1.png" alt=""></a></li>
			</ul>
		</div>

		<?php 
		$lib_modules_gamokitxva = new lib_modules_gamokitxva(); 
    	echo $lib_modules_gamokitxva->gamo($c);
    	?>

	</section>
	</main>

<?php
@include($c["website.directory.parts"]."/footer.php");
?>