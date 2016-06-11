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
	<section class="col-lg-9 col-md-9 col-sm-12 left-side textpage contact-page">
		<h1><?=$data['title']?></h1>
		<!-- <p style="margin:20px 0; font-size:16px; color:red">მოგვწერეთ საკონტაქტო ფორმის მეშვეობით..</p> -->
		<form action="javascript:void(0)" method="post" id="profile" class="profile">
		
		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="username">მომხმარებლის სახელი: <font color="red">*</font></label>
		  <input type="text" class="form-control username padding10" id="username" value="<?=$_SESSION[$c["session.prefix"]."email"]?>" disabled="disabled" />
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="namelname">სახელი გვარი: <font color="red">*</font></label>
		  <input type="text" class="form-control namelname padding10" id="namelname" value="<?=$data["user"]["namelname"]?>" />
		</div>		

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="phonenumber">საკონტაქტო ნომერი: </label>
		  <input type="text" class="form-control phonenumber padding10" id="phonenumber" value="<?=$data["user"]["contactphone"]?>" />
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="email">საკონტაქტო ელ-ფოსტა: </label>
		  <input type="text" class="form-control email padding10" id="email" value="<?=$data["user"]["contactemail"]?>" />
		</div>

		<a href="javascript:void(0)" class="btn btn-primary" id="updateprofile" data-type="add">განახლება</a>
		</form>

		
		<script type="text/javascript" charset="utf-8">
        GeoKBD.map('profile','namelname');
        </script>
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