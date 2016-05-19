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
	<section class="col-lg-9 col-md-9 col-sm-12 left-side textpage" itemscope  itemtype="http://schema.org/NewsArticle">
		<meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="https://google.com/article">
		<meta itemprop="datePublished" content="<?=date("d-m-Y", $data['date'])?>">
		<meta itemprop="dateModified" content="<?=date("d-m-Y", $data['date'])?>">
		<meta itemprop="url" content="<?=lib_functions_currenturl::u()?>">
		<h1 itemprop="headline"><span itemprop="name"><?=$data['title']?></span></h1>
		<div class="content-text">
			<div class="col-lg-3 desktop-inside1">
				<article>
					<div class="post-date">
						<time class="day"><?=date("d", $data['date'])?></time>
						<time class="month"><?=lib_functions_geomonthname::month(date("m", $data['date']))?></time>
						<time class="year"><?=date("Y", $data['date'])?></time>
						<div class="likes likes_<?=$data['id']?>" style="background:#ffffff">
							<?php
							$lib_database_countfavourites = new lib_database_countfavourites(); 
							echo $lib_database_countfavourites->co($c,$data['id']);
							?>
						</div>
						<?php
						if(isset($_SESSION[$c["session.prefix"]."id"])){
				          	$checkfavoutite = new lib_functions_checkfavoutite();  
				          	if($checkfavoutite->check($c,$_SESSION[$c["session.prefix"]."id"],$data['id'])){
				          		$offon = 'on';
				          	}else{
				          		$offon = 'off';
				          	}
				          }else{
				            $offon = 'off';
				          }
						?>
						<div class="heart <?=$offon?>" data-itemid="<?=$data['id']?>" data-signed="<?=(isset($_SESSION[$c["session.prefix"]."id"]) ? 'yes' : 'no')?>"></div>
					</div>
				</article>
			</div>
			<div class="col-lg-9 desktop-inside2" itemprop="description">
				<?=html_entity_decode($data['text'])?>
				<p class="tags" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<?php
					$tags = explode(",",$data['tags']);
					if(count($tags)>0):
					foreach ($tags as $tag) {
		               echo '<a href="'.$c["website.base"].'ყველა-სტატია/?tags='.urlencode(trim($tag, " ")).'" itemprop="url"><span class="label label-success"><i class="fa fa-tag" aria-hidden="true"></i>&nbsp;&nbsp;<font itemprop="name">'.trim($tag," ").'</font></span></a>';
		          	}
		          	endif;
					?>
				</p>
			</div>
		</div>
	</section>
	<section class="col-lg-3 col-md-3 col-sm-12 right-side">
		<div class="banners" style="margin-top:0">
			<ul>
				<li><a href=""><img src="img/banner1.png" alt=""></a></li>
			</ul>
		</div>

		<div class="poll-box">
			<div class="poll-header">გამოკითხვა</div>
			<div class="poll-question">გაქვთ თუ არა სამედიცინო დაზღვევა ?</div>
			<div class="poll-answers">
				<div class="poll-answer" style="background-size:80% 20px; margin-top:0">
					<span class="text">კი 80%</span>
				</div>
				<div class="poll-answer" style="background-size:20% 20px">
					<span class="text">არა 20%</span>
				</div>
			</div>
			<a href="">სხვა გამოკითხვები »</a>
		</div>

	</section>
</main>



<?php
@include($c["website.directory.parts"]."/footer.php");
?>