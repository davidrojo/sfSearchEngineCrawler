<?php

namespace DavidRojo\SearchEngineCrawler\Utils;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GoogleCrawler extends SearchEngineCrawler{
    public function __construct($type){
        parent::__construct($type);

        $this->name = "Google";
        $this->fetchUrl = "http://www.google.com/search?q=[KEYWORD]&start=[FROM]";
    }
}