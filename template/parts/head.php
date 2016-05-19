<!DOCTYPE html>
<html lang="ge">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$data['title']?> » თერაპია terapia.ge </title>
	<base href="<?=$c["website.base"]?>" />
	<!-- SEO tags (start) --> 
	<meta property="fb:app_id" content="1999692500254945" />
	<meta property="fb:admins" content="+995599623555" />
	<meta property="og:title" content="<?=$data['title']?> » თერაპია terapia.ge" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?=lib_functions_currenturl::u()?>"/>
	<meta property="og:image" content="<?=$c["website.base"]?>img/logo.png" />
	<meta property="og:image:width" content="1000">
	<meta property="og:image:height" content="523">
	<meta property="og:site_name" content="თერაპია"/>
	<meta property="og:description" content="<?=$data['meta_description']?>"/>
	<meta property="og:locale" content="ge_GE">
	<meta name="description" content="<?=$data['meta_description']?>">
	<meta name="robots" content="noodp">
	<link rel="canonical" href="<?=$c["website.base"]?>">
	<link rel="alternate" type="application/rss+xml" title="<?=$data['title']?> » თერაპია terapia.ge" href="<?=$c["website.base"]?>feed/">
	<link rel="shortlink" href="<?=$c["website.base"]?>" />
	<link rel="shortcut icon" href="<?=$c["website.base"]?>img/favicon.png" title="Favicon" />
	<!-- SEO tags (end)-->	
	<link rel="stylesheet" type="text/css" href="<?=$c["website.base"]?>css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=$c["website.base"]?>css/bootstrap-theme.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=$c["website.base"]?>css/general.css" />
	<script src="<?=$c["website.base"]?>js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="<?=$c["website.base"]?>js/bootstrap.min.js" type="text/javascript"></script>	
	<script src="<?=$c["website.base"]?>js/bootstrap-datepicker.js" type="text/javascript"></script>
	<link itemprop="logo" href="<?=$c["website.base"]?>img/logo.png" />	
</head>
<body>
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
    	<a href=""><span>შეტყობინება</span><i class="fa fa-bell-o"></i></a>
    	<a href=""><span>ფავორიტები</span> <i class="fa fa-heart"></i></i></a>
    	<a href=""><span>პროფილი</span> <i class="fa fa-user"></i></a> 
    	<a href="javascript:void(0); return false" class="last-elem signout-button"><span>გასვლა</span> <i class="fa fa-sign-out"></i></a>
   	</div>
	<?php endif; ?>
  </div>
</header>