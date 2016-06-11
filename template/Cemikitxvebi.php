<?php
@include($c["website.directory.parts"]."/head.php");
?>
<section class="container navigarion">
  <?php
  $lib_modules_navigation = new lib_modules_navigation(); 
  echo $lib_modules_navigation->menu($c);
  ?>
</section>

<main class="content">
	<section class="col-lg-9 col-md-9 col-sm-12 left-side textpage">
	
		<div class="panel panel-default">

		  <div class="panel-heading" style="background-color:#1fa67a; color:white"><?=$data['title']?></div>
		  <table class="table"> 
		  	<thead> 
		  		<tr> 
		  			<th>#</th> 
		  			<th>კითხვა</th> 
		  			<th>მოქმედება</th> 
		  		</tr> 
		  	</thead> 
		  	<tbody> 		  		
		  		<?php
				echo $data['myquestions'];
				?>
		  	</tbody> 
		  </table>
		
		</div>

		<?php
		$all = $data['countall']; 
		$perpage = $c["per.page.myquestions"]; 
		$currentpage = (lib_validate_request::method("GET","pn")>0) ? (lib_validate_request::method("GET","pn")) : 0; 
		$maxpage = ceil($all/$perpage); 
		$prev = ($currentpage>=2) ? ($currentpage - 1) : 1;
		$next = ($currentpage>=$maxpage) ? $maxpage : ($currentpage + 1);
		if(!$currentpage){ $next = 2; }
		?>
		<nav itemscope itemtype="https://schema.org/WebPage">
		  <ul class="pagination">
		    <li>
		      <a href="<?=$c["website.base"]?>ჩემი-კითხვები/?pn=<?=$prev?>" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    <?php
		    for($x=1; $x<=$maxpage; $x++){
		    	$active = ($x==$currentpage || ($currentpage==0 && $x==1)) ? ' class="active"' : '';
		    	echo '<li'.$active.'><a href="'.$c["website.base"].'ჩემი-კითხვები/?pn='.$x.'" itemprop="relatedLink/pagination">'.$x.'</a></li>'; 	
		    }
		    ?>
		    
		    <li>
		      <a href="<?=$c["website.base"]?>ჩემი-კითხვები/?pn=<?=$next?>" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>

	</section>

	<section class="col-lg-3 col-md-3 col-sm-12 right-side">
		<?php 
		$lib_modules_banners = new lib_modules_banners();
		echo $lib_modules_banners->load($c); 
    	?>
	</section>
</main>

<?php
@include($c["website.directory.parts"]."/footer.php");
?>