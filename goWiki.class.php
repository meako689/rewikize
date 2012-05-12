<?php

class goWiki
{

	public $google_url = "http://ajax.googleapis.com/ajax/services/search/images?v=1.0&imgsz=small|medium|large|xlarge&q=";
	public $wiki_url   = "http://uk.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&titles=";

	public function getResults($word)
	{
       $images = $this->getImages($word);
       $text   = $this->getText($word);

       $result = array(
       		'text' => $text
       	);

       foreach ($images as $image){
       	$result['images'][] = $image->url;
       }
       
       return $result;
	}

	protected function getImages($word)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->google_url.urlencode($word));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REMOTE_ADDR']);
		$body = curl_exec($ch);

		curl_close($ch);
		// now, process the JSON string
		$json = json_decode($body);

		return $json->responseData->results;

	}

	protected function getText($word)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->wiki_url.$word);
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

}

?>