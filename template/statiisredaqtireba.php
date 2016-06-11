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
		<form action="javascript:void(0)" method="post" id="mystatia" class="mystatia">
			<input type="hidden" name="statia_id" id="statia_id" value="<?=(int)$s[2]?>" />
		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="date">თარიღი: <font color="red">*</font></label>
		  <input type="text" class="form-control date padding10" id="date" value="<?=date("d-m-Y H:i:s", $data['form']['date'])?>" />
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="category">კატეგორია: <font color="red">*</font></label>
		  <?php
		  $lib_modules_categorylist = new lib_modules_categorylist(); 
		  echo $lib_modules_categorylist->catOptions($c, $data['form']['cat_id']);
		  ?>
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="title">დასახელება: <font color="red">*</font></label>
		  <input type="text" class="form-control title padding10" id="title" value="<?=$data['form']['title']?>" />
		</div>		

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="metatitle">მეტა დასახელება: <font color="red">*</font></label>
		  <input type="text" class="form-control metatitle padding10" id="metatitle" value="<?=$data['form']['meta_title']?>" />
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="metadescription">მეტა აღწერა: <font color="red">*</font></label>
		  <textarea class="form-control" id="metadescription" class="metadescription"><?=$data['form']['meta_desc']?></textarea>
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="shortdescription">მოკლე აღწერა: <font color="red">*</font></label>
		  <textarea class="form-control" id="shortdescription" class="shortdescription"><?=$data['form']['short_text']?></textarea>
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="text">ტექსტი: <font color="red">*</font></label>
		  <textarea class="form-control" id="text" class="text"><?=$data['form']['long_text']?></textarea>
		</div>

		<div class="input-group" style="margin:10px 0 0 0;">
		  <label for="tags">ტეგები: <font size="2">( გამოყავით მძიმით მაგ: სარკოიდოზი, პესტიციდები, და ა.შ.)</font> <font color="red">*</font></label>
		  <input type="text" class="form-control tags padding10" id="tags" value="<?=$data['form']['tags']?>" />
		</div>
		</form>

		<a href="javascript:void(0)" class="btn btn-primary" id="mystatia_button" data-type="edit">რედაქტირება</a>
		<script type="text/javascript" charset="utf-8">
        GeoKBD.map('mystatia','title');
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