<?php
class lib_modules_welcomepagearticles{
	public function art($c){
	    
         $lib_database_welcomearticles = new lib_database_welcomearticles(); 
	    $articles = json_decode($lib_database_welcomearticles->articles($c), true);
		
	    $out = ''; 
	    foreach ($articles as $article) {
          $out .= '<article itemscope itemtype="http://schema.org/NewsArticle">';
          $out .= '<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>'; 
          $out .= '<meta itemprop="datePublished" content="'.date("d-m-Y", $article['ci_date']).'" />'; 
          $out .= '<meta itemprop="dateModified" content="'.date("d-m-Y", $article['ci_date']).'" />'; 
          
           
          $out .= '<div class="col-lg-2 post-date">';
          $out .= '<div class="all">';
          $out .= '<span class="day">'.date("d", $article['ci_date']).'</span>';
          $out .= '<span class="month">'.lib_functions_geomonthname::month(date("m", $article['ci_date'])).'</span>';
          $out .= '<span class="year">'.date("Y", $article['ci_date']).'</span>';
          $out .= '</div>';
          $out .= '<div class="likes likes_'.$article['ci_id'].'">'.(int)$article['ci_favourites'].'</div>';
          $signed = (isset($_SESSION[$c["session.prefix"]."id"])) ? 'yes' : 'no';
          if(isset($_SESSION[$c["session.prefix"]."id"])){
          	$checkfavoutite = new lib_functions_checkfavoutite();  
          	if($checkfavoutite->check($c,$_SESSION[$c["session.prefix"]."id"],$article['ci_id'])){
          		$offon = 'on';
          	}else{
          		$offon = 'off';
          	}
          }else{
            $offon = 'off';
          }
          $out .= '<div class="heart '.$offon.'" data-itemid="'.$article['ci_id'].'" data-signed="'.$signed.'"></div>';
        	$out .= '</div>';
          $out .= '<div class="col-lg-10 post-content">';
          $out .= '<a href="'.$c["website.base"].'სტატია/'.$article['ci_id'].'/'.urlencode($article['ci_slug']).'" itemprop="url">';
          $out .= '<h1 itemprop="headline"><span itemprop="name">'.strip_tags($article['ci_title']).'</span></h1>';
          $out .= '<p itemprop="description">'.strip_tags($article['ci_short_text']).'</p>';
          $out .= '</a>';
          $out .= '<p class="data-info">';
          $out .= '<span class="info-link"><a href="'.$c["website.base"]."ყველა-სტატია/".$article['c_id']."/".$article['c_slug'].'"><i class="fa fa-th-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;'.strip_tags($article['c_title']).'</a></span>';
          $out .= '<span class="info-link" itemprop="author" itemscope itemtype="https://schema.org/Person"><a href="" style="display:block"><i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; <span itemprop="name">'.strip_tags($article['u_name']).'</span></a></span>';
          
          
          $out .= '<p class="tags" itemscope itemtype="http://schema.org/SiteNavigationElement">';
          $tags = explode(",",$article['ci_tags']);
          foreach ($tags as $tag) {
               $out .= '<a href="'.$c["website.base"].'ყველა-სტატია/?tags='.urlencode(trim($tag, " ")).'" itemprop="url"><span class="label label-success"><i class="fa fa-tag" aria-hidden="true"></i>&nbsp;&nbsp;<font itemprop="name">'.trim($tag," ").'</font></span></a>';
          }
          $out .= '</p>';

          $out .= '</p>';
          $out .= '</div><div class="clearer"></div>';
        	
          $out .= '<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" style="visibility:hidden; position:absolute">
          <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
          <img src="'.$c["website.base"].'img/logo.png"/>
          <meta itemprop="url" content="'.$c["website.base"].'img/logo.png">
          <meta itemprop="width" content="117">
          <meta itemprop="height" content="57">
          </div>
          <meta itemprop="name" content="Terapia.Ge">
          </div>';
      		$out .= '</article>';
	 	}
		return $out;
	}
}
?>