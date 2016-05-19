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
	<section class="col-lg-9 col-md-9 col-sm-12 left-side textpage">
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
				<textarea name="replay" id="replay"></textarea>
				<p id="countWords"><span id="typed">0</span> / 800</p>
				<a href="javascript:;" class="btn btn-primary" role="button" id="replay-answer" style="margin-top:15px;">დამატება</a>
			</div><div style="clear:both"></div>
			
				          

		</div>
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