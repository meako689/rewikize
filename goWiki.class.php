<?php

class goWiki
{
	public $google_url = "http://ajax.googleapis.com/ajax/services/search/images?v=1.0&imgsz=small|medium|large|xlarge&q=";
	public $wiki_url = "/w/api.php?action=query&prop=info&format=json&prop=extracts&titles=";
  private $wiki_domen;
  private $wiki_langs = array(
    'uk' => 'http://uk.wikipedia.org',
    'en' => 'http://en.wikipedia.org'    
  );
  private $wiki_articles_url = "/w/api.php?action=opensearch&prop=info&format=json&inprop=url&search=";
  
  private $youtube_url = "https://gdata.youtube.com/feeds/api/videos?key=AI39si6xrev4R-3h52VvnnDlv78h9pmFy9Nji5l0rlNYAgJYHswH2EzHejoNVEm0h6kX4sMJBvtUUA7_L5Dk8Sw5h7VTfWpJpg&alt=json&orderby=published&start-index=11&max-results=10&v=2&q=";
  private $img_url;

  
	public function getResults($word, $with_images)
	{
    $this->wiki_domen = $this->checkLang($word);
    
    $data = array(
      'text'   => $this->getText($word),
      'images' => $this->getImages($word),
      'videos'  => $this->getVideo($word)
    );
    if($with_images == true){
      $data['colors'] = $this->getColorPallete();
    }
    
    return $data;
	}

	protected function getImages($word)
	{
    $result = array();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->google_url.urlencode($word));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REMOTE_ADDR']);
		$body = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($body);
    
    foreach ($json->responseData->results as $image){
      $result[] = $image->url;
    }
    
    $this->image_url = $result['0'];
		return $result;

	}

	protected function getText($word)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->wiki_domen.$this->wiki_url.urlencode($word));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REMOTE_ADDR']);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		$body_wiki = curl_exec($ch);
		curl_close($ch);
		return $this->prepareText($body_wiki);
	}

	protected function prepareText($page)
	{
		$res = json_decode($page);
		$output = '';
    
    foreach ($res->query->pages as $page)
    {
      $output .= $page->extract;
    }

    return $output;
	}
  
  protected function getVideo($word)
  {
    $videos = array();
    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->youtube_url.urlencode($word));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REMOTE_ADDR']);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		$body = curl_exec($ch);
		curl_close($ch);
		
    $res = str_replace('$', '_', $body);
    $json = json_decode($res);
   
    if(isset($json->feed->entry)){
      foreach ($json->feed->entry as $video)
      {
        $videos[] = $video->media_group->yt_videoid->_t;
      }
    }
    return $videos;
  }
  
  private function checkLang($word)
  {
   if($word == convert_cyr_string($word , 'w' , 'k'))
   {
    return $this->wiki_langs['en']; 
   }else{
    return $this->wiki_langs['uk']; 
   }
  }
  
  protected function getColorPallete()
  {
    $ch = curl_init();
    $url = 'http://pictaculous.com/api/1.0/';

    $fields = array('image'=>file_get_contents($this->image_url));

    # Set some default CURL options
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_URL, $url);

    $json = curl_exec($ch);
    return(json_decode($json)); 
  }
  
  public function getArticles($word)
  {
   $this->wiki_domen = $this->checkLang($word);
   
    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->wiki_domen.$this->wiki_articles_url.urlencode($word));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REMOTE_ADDR']);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		$body_wiki = curl_exec($ch);
		curl_close($ch);
   
   return json_decode($body_wiki);
  }
}

?>
