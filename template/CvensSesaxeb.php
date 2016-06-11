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
		if(isset($_SESSION[$c["session.prefix"]."usertype"]) && $_SESSION[$c["session.prefix"]."usertype"]=="administrator" && lib_validate_request::method('GET','edit')=="true"){
			echo '<form action="javascript:void(0)" method="post">';
			echo '<textarea name="chvenshesaxebtext" id="chvenshesaxebtext" class="chvenshesaxebtext">'.$data['text'].'</textarea>';
			echo '</form>';
			echo '<a href="'.$c['website.base'].'ჩვენს-შესახებ" class="btn btn-primary" role="button" style="margin:20px 10px 0 0; background-color:#555555; color:#ffffff"> გაუქმება</a>';
			echo '<a href="javascript:void(0)" class="btn btn-primary" role="button" id="edit-chvnshesaxeb" style="margin:20px 0 0 0;"> რედაქტირება</a>';
		}else{
			echo $data['text'];
			if(isset($_SESSION[$c["session.prefix"]."usertype"]) && $_SESSION[$c["session.prefix"]."usertype"]=="administrator"){
				echo '<hr style="margin:50px 0 20px 0; width:100%; height:1px; float:left; background-color:#f2f2f2; clear:both" />';
				echo '<strong style="clear:both; float:left; width:100%">მოქმედება</strong><br />';
				echo '<a href="'.$c['website.base'].'ჩვენს-შესახებ/?edit=true" style="text-decoration:none; color:#1fa67a; clear:both">ტექსტის რედაქტირება <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><br />';
			}
		}
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