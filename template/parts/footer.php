<div class="clearer"></div>
<footer>
	<div class="content">
		<div class="col-lg-5 leftside">
			<?php
			$lib_modules_categorylist = new lib_modules_categorylist(); 
			$footer_cat = $lib_modules_categorylist->cat_footer($c);
			?>
			<div class="col-lg-6">
				<?=$footer_cat['left']?>
			</div>
			<div class="col-lg-6">
				<?=$footer_cat['right']?>
			</div>
		</div>	
		<div class="col-lg-4 col-sm-6 middle">
			<div class="email">ელ-ფოსტა: <a href="">info@terapia.ge</a></div>
			<div class="socials">
				<ul>
					<li>
						<a href="https://www.facebook.com/terapia.ge/" target="_blank">
							<img src="<?=$c['website.base']?>img/fblogo.png" />
						</a>
					</li>
					<li>
						<a href="http://www.terapia.ge/feed/" target="_blank">
							<img src="<?=$c['website.base']?>img/rsslogo.png" />
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 footerlogo">
		</div>
		<div class="clearer"></div>
	</div>
</footer>
	

<script src="<?=$c["website.base"]?>js/script.js" charset="utf-8"></script>
</body>
</html>