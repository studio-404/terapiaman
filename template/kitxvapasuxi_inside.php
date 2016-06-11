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
	<section class="col-lg-9 col-md-9 col-sm-12 left-side textpage" itemscope itemtype="http://schema.org/Question">
		<h1>
			<span class="icon-about" style="background-image: url('img/qanswers.png');"></span>
			<?=$data['title']?>
		</h1>
		<div class="content-text">
			<?=$data['qustions']?>

			<div style="clear:both"></div>
			<div class="answers-box">
				<?=$data['answers']?>
			</div><div style="clear:both"></div>

			<div class="replay-box">
				<div class="alert alert-warning" role="alert">* კომენტარის დამატება შეუძლიათ მხოლოდ კითხვის დამსმელს და ვებ გვერდის ადმინისტრატორებს !</div>
				<form action="javascript:void(0); return false" method="post" id="replayForm" class="replayForm">
				<input type="hidden" name="hqid" id="hqid" value="<?=$GLOBALS["CURRENTSLUG"][1]?>" />
				<textarea name="replay" id="replay" class="replay" data-offon="<?=(isset($_SESSION[$c["session.prefix"]."id"]) ? 'on' : 'off')?>" data-maxlength="<?=$c["post.max.length"]?>" data-minlength="<?=$c["post.min.length"]?>"></textarea>
				<p id="countWords"><span id="typed">0</span> / <?=$c["post.max.length"]?></p>
				<a href="javascript:void(0);" class="btn btn-primary" role="button" id="replay-answer" style="margin-top:15px;">დამატება</a>
				</form>
				<script type="text/javascript" charset="utf-8">
				GeoKBD.map('replayForm','replay');
				</script>
			</div><div style="clear:both"></div>
			
				          

		</div>
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