<?php

namespace DavidRojo\SearchEngineCrawler\Utils;


class SearchEngineCrawlerFactory
{
    
    function createCrawler($type){
        return new SearchEngineCrawler($type);
    }
}
