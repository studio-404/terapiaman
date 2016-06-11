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
		               echo '<a href="'.$c["website.base"].'ყველა-სტატია/?tags='.urlencode(trim($tag, " ")).'" itemprop="url"><span class="label label-success" style="color:white"><i class="fa fa-tag" aria-hidden="true"></i>&nbsp;&nbsp;<font itemprop="name">'.trim($tag," ").'</font></span></a>';
		          	}
		          	endif;
					?>
				</p>

				<p class="data-info">
					<span class="info-link" itemprop="author" itemscope="" itemtype="https://schema.org/Person">
						<a href="">
							<i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;&nbsp; <span itemprop="name"><?=$data['auther']?></span>
						</a>
					</span>
				</p>
				<?php
				if(isset($_SESSION[$c["session.prefix"]."usertype"]) && $_SESSION[$c["session.prefix"]."usertype"]=="administrator"){
					echo '<div style="clear:both"></div><hr style="margin:50px 0 20px 0; width:100%; height:1px; float:left; background-color:#f2f2f2; clear:both" />';
					echo '<strong style="clear:both; float:left; width:100%;">მოქმედება</strong><br /><div style="clear:both"></div>';
					echo '<a href="'.$c['website.base'].'ჩემი-სტატიები/რედაქტირება/'.$s[1].'" style="text-decoration:none">სტატიის რედაქტირება <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><br />';
					echo '<a href="javascript:void(0)" data-itemid="9" class="deleteMyStatia" style="text-decoration:none">სტატიის წაშლა <i class="fa fa-times" aria-hidden="true"></i></a>';
				}
				?>
			</div>
		</div>
	</section>
	<section class="col-lg-3 col-md-3 col-sm-12 right-side">
		<?php
		$lib_modules_searchbox = new lib_modules_searchbox();
    	echo $lib_modules_searchbox->search($c);

		$lib_modules_banners = new lib_modules_banners();
    	echo $lib_modules_banners->load($c); 
    	$main_options = array(
			"poll_id"=>"1000".$s[1], /* Poll unique ID */
			"header_text"=>"გამოკითხვა", /* Poll header text */
			"poll_question"=>"მოგწოთ მიმდინარე სტატია ?", /* Poll Question */
			"poll_answers"=>array(
				"კი", 
				"არა"
			), /* Poll possible answers, You can have as many as you want */
			"please_wait"=>"გთხოვთ დაიცადოთ ...", /* waiting text */
			"temp_path"=>$c["website.json.poll"] /* Temp folder path, recommending file permition 0755 */
		);
		echo '<div id="poll_container">';
		$lib_modules_gamokitxva = new lib_modules_gamokitxva(); 
		echo $lib_modules_gamokitxva->lanch($c, $main_options);
		echo '</div>';
		?>
	</section>
</main>



<?php
@include($c["website.directory.parts"]."/footer.php");
?>