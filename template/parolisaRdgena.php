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
	<section class="col-lg-9 col-md-9 col-sm-12 left-side textpage contact-page">
		<h1><?=$data['title']?></h1>
		<?php
		if(lib_validate_request::method("GET","recover")):
		?>
		<form action="javascript:void(0)" method="post">
			<div class="input-group" style="margin:10px 0 0 0;">
			  <label for="newpassword">ახალი პაროლი: <font color="red">*</font></label>
			  <input type="password" class="form-control" id="newpassword" value="" />
			</div>
			<div class="input-group" style="margin:10px 0 0 0;">
			  <label for="comfirmNewPassword">დაადასტურეთ პაროლი: <font color="red">*</font></label>
			  <input type="password" class="form-control" id="comfirmNewPassword" value="" />
			</div>
			<a href="javascript:void(0)" class="btn btn-primary" id="newpassword_button">შეცვლა</a>
		</form>
		<?php
		endif;
		if(!lib_validate_request::method("GET","recover")):
		?>
		<div class="alert alert-warning" role="alert" style="margin:20px 0 0 0;">* პაროლის აღსადგენ ბმულს მიიღებთ ელ-ფოსტაზე რომელიც გამოიყენეთ რეგისტრაციისას !</div>
		<form action="javascript:void(0)" method="post">
			<div class="input-group" style="margin:10px 0 0 0;">
			  <label for="email">ელ-ფოსტა: <font color="red">*</font></label>
			  <input type="text" class="form-control" id="recover_email" />
			</div>
			<a href="javascript:void(0)" class="btn btn-primary" id="recover_button">აღდგენა</a>
		</form>
		<?php
		endif;
		?>
	</section>

	<section class="col-lg-3 col-md-3 col-sm-12 right-side">

		<?php 
		$lib_modules_searchbox = new lib_modules_searchbox();
    	echo $lib_modules_searchbox->search($c);

		$lib_modules_banners = new lib_modules_banners();
    	echo $lib_modules_banners->load($c); 
    	?>
		

	</section>
</main>

<?php
@include($c["website.directory.parts"]."/footer.php");
?>