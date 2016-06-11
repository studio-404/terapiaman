<?php
class lib_modules_feeds{
	public function sitemap($c){
		$out = '<?xml version="1.0" encoding="UTF-8"?>';
		$out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';
		
		$lib_database_menu = new lib_database_menu();
		$navs = json_decode($lib_database_menu->selectNavigation($c),true);
		foreach ($navs as $nav) {
			if($nav['slug']=="მთავარი-გვერდი"){ continue; }
			$out .= '<url>';
			$out .= '<loc>'.$c['website.base'].$nav['slug'].'</loc>';
			$out .= '<changefreq>always</changefreq>';
			$out .= '</url>';
		}

		$lib_database_allarticles = new lib_database_allarticles(); 
		$articles = json_decode($lib_database_allarticles->allArticlesRss($c),true);
		foreach ($articles as $article) {
			$out .= '<url>';
			$out .= '<loc>'.$c['website.base'].'სტატია/'.$article['ci_id'].'/'.$article['ci_slug'].'</loc>';
			$out .= '<changefreq>always</changefreq>';
			$out .= '</url>';
		}
		$out .= '</urlset>';
		return $out;
	}

	public function news($c){
		$out = '<?xml version="1.0" encoding="UTF-8"?>';
		$out .= '<rss version="1.0">';
		$out .= '<channel>';
		$out .= '<title>'.$c["website.name"].'</title>';
		$out .= '<link>'.$c["website.base"].'</link>';
		$out .= '<description>'.$c["website.description"].'</description>';
		// $out .= '<lastBuildDate>Wed, 25 May 2016 20:27:09 +0000</lastBuildDate>';
		$out .= '<lastBuildDate>'.date('D, d M Y H:i:s O').'</lastBuildDate>';
		$out .= '<language>ge-KA</language>';
		
		$out .= '<image>';
		$out .= '<url>http://www.terapia.ge/img/favicon.png</url>';
		$out .= '<title>'.$c["website.name"].'</title>';
		$out .= '<link>'.$c["website.base"].'</link>';
		$out .= '<width>32</width>';
		$out .= '<height>32</height>';
		$out .= '</image>';
		
		$lib_database_allarticles = new lib_database_allarticles(); 
		$articles = json_decode($lib_database_allarticles->allArticlesRss($c),true);

		foreach ($articles as $article) {
			$out .= '<item>';
			$out .= '<title>'.htmlentities($article['ci_title']).'</title>';
			$out .= '<link>'.$c['website.base'].'სტატია/'.$article['ci_id'].'/'.$article['ci_slug'].'</link>';
			$out .= '<pubDate>'.date('D, d M Y H:i:s O',$article['ci_date']).'</pubDate>';
			$out .= '<creator>'.htmlentities($article['u_name']).'</creator>';
			$out .= '<category>'.htmlentities($article['c_title']).'</category>';
			$out .= '<description>'.htmlentities(strip_tags($article['ci_long_text'],'<p><ul><li><a><em><strong><br>')).'</description>';
			$out .= '</item>';
		}
		$out .= '</channel>';
		$out .= '</rss>';

		return $out;
	}
}
?>