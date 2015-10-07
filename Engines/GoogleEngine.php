<?php

namespace DavidRojo\SearchEngineCrawler\Engines;

class GoogleEngine extends SearchEngine{

    protected $fetchUrl = "https://www.google.es/search?q=[KEYWORD]&start=[FROM]";
	
	public function parsePage($content){
		$this->currentPageCode = $content;
		echo $content;
	}
	
}