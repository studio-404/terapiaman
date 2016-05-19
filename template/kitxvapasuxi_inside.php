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
		<h1>
			<span class="icon-about" style="background-image: url('img/qanswers.png');"></span>
			<?=$data['title']?>
		</h1>
		<div class="content-text">
			<!-- <h4 class="media-heading">12 აგვვისტო 2015 | თამარ ბაბაიანი</h4>
			<p>მოგესალმებით,რამდენიმე დღის წინ უკანა ტანზე ხვრელთან ზედამხარეს გამიჩნდა მცირე ზომის გამონაზარდი, მაგრამ არ ვუჩივი არც სისხლდენას არც შეკრულობას და სხვა ბუასილის სიმპტომებს,თუ შეგიძლიათ მითხრათ რა შეიძლება იყოს და როგორ შეიძლება სახლის პირობებში მკურნალობა?წინასწარ გმადლობ პასუხისთვის.</p>
			<div class="actions-box">
				<a href=""><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;პასუხის მიწერა</a>
				<a href=""><i class="fa fa-gavel" aria-hidden="true"></i>&nbsp;&nbsp; გასაჩივრება</a>
				<a href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp; წაშლა</a>
			</div> -->
			<?=$data['qustions']?>

			<div style="clear:both"></div>
			<div class="answers-box">

				<div class="media">
			          <div class="media-left" style="min-width:100px;">
			            <div class="post-date">
			            	<div class="all">
			            		<span class="day">12</span>
			            		<span class="month">მაისი</span>
			            		<span class="year">2016</span>
			            		<span class="time">12:22</span>
			            	</div>
			            </div>
			          </div>
			          <div class="media-body">
			            <h4 class="media-heading">ჯაბა ანთიძე</h4>
			            <p style="min-height:55px;">არაფერიც არ გაწუხებთ.</p>
			            <div class="actions-box">
							<a href=""><i class="fa fa-gavel" aria-hidden="true"></i>&nbsp;&nbsp; გასაჩივრება</a>
							<a href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp; წაშლა</a>
						</div><div style="clear:both"></div>
			          </div>
			    </div>			    
			    <div style="clear:both"></div>
			</div><div style="clear:both"></div>

			<div class="replay-box">
				<div class="alert alert-warning" role="alert">* კომენტარის დამატება შეუძლია მხოლოდ კითხვის დამსმელს და ვებ გვერდის ადმინისტრატორებს !</div>
				<textarea name="replay" id="replay"></textarea>
				<a href="javascript:;" class="btn btn-primary" role="button" id="replay-answer" style="margin-top:15px;">დამატება</a>
			</div><div style="clear:both"></div>
			
				          

		</div>
	</section>

	<section class="col-lg-3 col-md-3 col-sm-12 right-side">
		<div class="banners" style="margin-top:0">
			<ul>
				<li><a href="calc.php"><img src="img/banner1.png" alt=""></a></li>
			</ul>
		</div>

		<div class="poll-box">
			<div class="poll-header">გამოკითხვა</div>
			<div class="poll-question">გაქვთ თუ არა სამედიცინო დაზღვევა ?</div>
			<div class="poll-answers">
				<div class="poll-answer" style="background-size:80% 20px; margin-top:0">
					<span class="text">კი 80%</span>
				</div>
				<div class="poll-answer" style="background-size:20% 20px">
					<span class="text">არა 20%</span>
				</div>
			</div>
			<a href="">სხვა გამოკითხვები »</a>
		</div>

	</section>
</main>

<?php
@include($c["website.directory.parts"]."/footer.php");
?>