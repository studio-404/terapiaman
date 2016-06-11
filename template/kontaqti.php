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
		<!-- <p style="margin:20px 0; font-size:16px; color:red">მოგვწერეთ საკონტაქტო ფორმის მეშვეობით..</p> -->
		<form action="javascript:void(0)" method="post" id="mycontactform" class="mycontactform">
		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="namelname">სახელი გვარი: <font color="red">*</font></label>
		  <input type="text" class="form-control" id="contact_namelname" class="contact_namelname" />
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="title">სათაური: <font color="red">*</font></label>
		  <input type="text" class="form-control" id="contact_subject" />
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="email">ელ-ფოსტა: <font color="red">*</font></label>
		  <input type="text" class="form-control" id="contact_email" />
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="text">შეტყობინება: <font color="red">*</font></label>
		  <textarea class="form-control" id="contact_message" class="contact_message"></textarea>
		</div>

		<a href="javascript:void(0)" class="btn btn-primary" id="contact_button">გაგზავნა</a>
		<script type="text/javascript" charset="utf-8">
        GeoKBD.map('mycontactform','contact_namelname');
        GeoKBD.map('mycontactform','contact_subject');
        GeoKBD.map('mycontactform','contact_message');
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