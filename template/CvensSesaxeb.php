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
		<h1><span class="icon-about" style="background-image: url('img/iconabout.png');"></span> <?=$data['title']?></h1>
		<div class="content-text">
		<?=$data['text']?>

		<!-- <div class="row teambox">
			<div class="col-lg-3 team-member">
				<a href="profile.php">
					<img src="img/member1.jpg" alt="" width="100%">
					<p>თამარ სანიკიძე</p>
				</a>
			</div>
			<div class="col-lg-3 team-member">
				<a href="profile.php">
					<img src="img/member2.jpg" alt="" width="100%">
					<p>ჯიმშერ ჯაჯანიძე</p>
				</a>
			</div>
			<div class="col-lg-3 team-member">
				<a href="profile.php">
					<img src="img/member3.jpg" alt="" width="100%">
					<p>ანია პალიტოვსკაია</p>
				</a>
			</div>
			<div class="col-lg-3 team-member">
				<a href="profile.php">
					<img src="img/member4.jpg" alt="" width="100%">
					<p>ცისანა ხაბაზი</p>
				</a>
			</div>
		</div> -->
	</div></section>

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