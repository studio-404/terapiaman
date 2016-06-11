<!DOCTYPE html>
<html lang="ge">
<head>
<?php 
echo lib_modules_theme::metadata($c,$data);
echo lib_modules_theme::links($c,$data);
echo lib_modules_theme::js($c);
?>		
</head>
<body>
<?php
@include($c["website.directory.parts"]."/facebooksdk.php");
@include($c["website.directory.parts"]."/analytics.php");
?>
<!-- message START -->
<div class="modal fade message-box" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="message-title">შეტყობინება</h4>
      </div>
      <div class="modal-body message-body">
      </div>
    </div>
  </div>
</div>
<!-- message END -->
<div class="loader-spin"></div>
<header class="container content">
  <div class="logo"></div>
  <div class="usersspace">
  	<?php if(!isset($_SESSION[$c["session.prefix"]."id"])) : ?>
    <div class="auth signedin">
    	<a href="" data-toggle="modal" data-target=".bs-example-modal-sm"><span>ავტორიზაცია</span> <i class="fa fa-sign-in" aria-hidden="true"></i></a>
    	<a href="" data-toggle="modal" data-target=".bs-example-modal-sm2"><span>რეგისტრაცია</span> <i class="fa fa-user-plus" aria-hidden="true"></i></a></div>
	<?php endif; ?>
	<?php if(isset($_SESSION[$c["session.prefix"]."id"])) : ?>
    <div class="auth signedin">
    	<?php if(isset($_SESSION[$c["session.prefix"]."usertype"]) && $_SESSION[$c["session.prefix"]."usertype"]=="administrator") : ?>
    	<a href="<?=$c["website.base"]?>ლოგები"><span>ლოგები</span><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
      <a href="<?=$c["website.base"]?>ჩემი-სტატიები"><span>ჩემი სტატიები</span><i class="fa fa-newspaper-o"></i></a>
    	<?php endif; ?>
      <?php if(isset($_SESSION[$c["session.prefix"]."usertype"]) && $_SESSION[$c["session.prefix"]."usertype"]!="administrator") : ?>
      <a href="<?=$c["website.base"]?>ჩემი-კითხვები"><span>ჩემი კითხვები</span><i class="fa fa-question-circle" aria-hidden="true"></i></a>
      <?php endif; ?>

    	<a href="<?=$c["website.base"]?>ფავორიტები"><span>ფავორიტები</span> <i class="fa fa-heart"></i></i></a>
    	<a href="<?=$c["website.base"]?>პროფილი/<?=$_SESSION[$c["session.prefix"]."id"]?>/<?=str_replace(" ","-",$_SESSION[$c["session.prefix"]."namelname"])?>"><span><?=$_SESSION[$c["session.prefix"]."namelname"]?></span> <i class="fa fa-user"></i></a> 
    	<a href="javascript:void(0); return false" class="last-elem signout-button"><span>გასვლა</span> <i class="fa fa-sign-out"></i></a>
   	</div>
	<?php endif; ?>
  </div>
</header>