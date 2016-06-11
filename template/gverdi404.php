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
		<h1><?=$data['title']?></h1>
		<div class="content-text">
		<?php
		echo $data['text'];	
		?>
		</div>
	</section>

	<section class="col-lg-3 col-md-3 col-sm-12 right-side">
		<?php 
		$lib_modules_banners = new lib_modules_banners();
		echo $lib_modules_banners->load($c); 

		$main_options = array(
			"poll_id"=>"1", /* Poll unique ID */
			"header_text"=>"გამოკითხვა", /* Poll header text */
			"poll_question"=>"რა არ მოგწონთ Terapia.ge-ზე ?", /* Poll Question */
			"poll_answers"=>array(
				"ლოგო", 
				"დიზაინი", 
				"ფუნქციების ნაკლებობა" 
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