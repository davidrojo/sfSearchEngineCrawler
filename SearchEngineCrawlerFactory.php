<?php

namespace DavidRojo\SearchEngineCrawler;


class SearchEngineCrawlerFactory
{
    
    function createCrawler($type){
        return new SearchEngineCrawler($type);
    }
}
