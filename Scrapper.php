<?php 

class Scrapper
{

		private $url;
		private $keyword;

		private $html;
		private $domElement;
		
		private $titles;
		private $metaDescs;

		private $h1s;
		private $h2s;


		public function __construct($keyword, $url)
		{
			$this->url = $url;
			$this->keyword = $keyword;
			$this->html = $this->getHtmlFromUrl($url);
			$this->domElement = $this->createDom();
		}

		private function createDom()
		{
			$dom = new DOMDocument();
			$dom->encoding = 'UTF-8';
			@$dom->loadHTML($this->html);
			return $dom;
		}

		private function getHtmlFromUrl($url)
		{
			$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	        $html = curl_exec($ch);
	        curl_close($ch);
	        return utf8_decode($html);
		} 

		private function extractH1()
		{
			$this->h1s = [];
			$elements = $this->domElement->getElementsByTagName('h1');
			if (count($elements) > 0)
			{
			  foreach ($elements as $element)
			  {
			  	$this->h1s[] = $element->nodeValue;
			  }
			}
		}

		private function extractH2()
		{
			$this->h2s = [];
			$elements = $this->domElement->getElementsByTagName('h2');
			if (count($elements) > 0)
			{
			  foreach ($elements as $element)
			  {
			  	$this->h2s[] = $element->nodeValue;
			  }
			}
		}

		private function extractTitle()
		{
			$this->titles = [];
			$elements = $this->domElement->getElementsByTagName('title');
			if (count($elements) > 0)
			{
			  foreach ($elements as $element)
			  {
			  	$this->titles[] = $element->nodeValue;
			  }
			}
		}

		private function extractMetaDesc()
		{
			$this->metaDescs = [];
			$elements = $this->domElement->getElementsByTagName('meta');
			if (count($elements) > 0)
			{
			  foreach ($elements as $element)
			  {
			  	if (strtolower($element->getAttribute('name')) == 'description')
			  		$this->metaDescs[] = $element->nodeValue;
			  }
			}
		}

		public function getAudit()
		{
			$this->extractH1();
			$this->extractH2();
			$this->extractTitle();
			$this->extractmetaDesc();

			echo '<meta charset="utf-8">';

			var_dump($this->h1s);
			var_dump($this->h2s);
			var_dump($this->titles);
			var_dump($this->metaDescs);
		}

}
 ?>