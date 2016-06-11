<?php
$t = (int)(isset($_GET['text']) && !empty($_GET['text'])) ? urldecode($_GET['text']) : 0;
$l = (int)(isset($_GET['link']) && !empty($_GET['link'])) ? urldecode($_GET['link']) : 0;
$text[0] = sprintf('პაროლის აღსადგენად დაკლიკეთ <a href="http://%s" target="_blank">აქ</a>', $l); 
?>
<html>
<head>
<meta charset="UTF-8">
<title><?=(isset($_GET['title']) && !empty($_GET['title'])) ? urldecode($_GET['title']) : ''?></title>
<style>
.entire-page {
  background: white;
  width: 100%;
  padding: 20px 0;
  font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif;
  line-height: 1.5;
}
.email-body {
  max-width: 600px;
  min-width: 600px;
  min-height: 450px;
  margin: 0 auto;
  background: white;
  border-collapse: collapse;
  border:solid 1px #cccccc;
}
.email-header {
  background: white;
  padding: 30px;
  border-bottom: solid 1px #f2f2f2;
}
.email-header img {
  max-width: 100%;
}
.news-section {
  padding: 20px 30px;
}
.news-section img {
  width: 100%;
}
.best-of-thumb {
  width: 40%;
  vertical-align: top;
}
.best-of-thumb img {
  width: 95%;
  margin: 15px;
}
.best-of-thumb2 img {
  width: 90%;
  margin: 30px;
}
.best-of-about {
  padding-left: 20px;
  vertical-align: top;
}
.best-of-thumb, .best-of-thumb2, .best-of-thumb3, best-of-thumb4,.best-of-about {
  border-bottom: 1px solid #ddd;
  padding-top: 20px;
  padding-bottom: 20px;
  text-align: center;
}

.sm-title {
  margin: 20px;
}

</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<body>
<div class="container-fluid">
<table class="entire-page">

<tr>

<td>

<table class="email-body" style="border: solid 1px #cccccc; width:600px;">

<tr>
<td class="email-header" style="background: white; padding: 30px; border-bottom: solid 1px #f2f2f2;">
<a href="https://www.terapia.ge/" target="_blank">
<img src="http://www.terapia.ge/img/logo.png" alt="terapia.ge">
</a>
</td>
</tr>

<tr>

<td class="news-section" style="padding: 20px 30px;">

<h2 style="color: black; font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif;  font-size: 25px !important;"><?=(isset($_GET['title']) && !empty($_GET['title'])) ? urldecode($_GET['title']) : ''?></h2>

<p style="min-height:200px; font-size: 13px; color: #555555; font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif;"><?=$text[$t]?></p>


</td>
</tr>
<!--Special Offer-->



<tr>
<td class="footer" style="background: #555555; padding: 10px; font-size: 12px; text-align: center;  font-family: 'roboto';  color: white;">
© 2016 Terapia.ge
</td>
</tr>
</table>
</td>
</tr>
</table>   
</div>

</body>
</html>
