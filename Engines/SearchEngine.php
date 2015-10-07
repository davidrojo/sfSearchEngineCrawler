<?php

namespace DavidRojo\SearchEngineCrawler\Utils;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

abstract class SearchEngine
{
    /**
     * Crawler name
     * @var String
     */
    protected $name = "";

    /**
     * Fetch url setted to get results, it replaces the wildcards provided:
     * [KEYWORD]   Current keyword to search
     * [PAGE]      Current page to search
     * [FROM]      From index to search
     * [TO]        To index to search
     * [RPP]       Results per page to search 
     * @var [type]
     */
    protected $fetchUrl = "";

    /**
     * The current page code
     * @var string
     */
    protected $currentPageCode = "";

    /**
     * Last results fetched
     * @var Array
     */
    protected $results = [];


    public function buildUrl($url, $keyword, $currentPage, $currentIndex, $rpp){
        return str_replace(
            ['[KEYWORD]', '[PAGE]', '[FROM]', '[TO]', '[RPP]'],
            [$keyword, $currentPage, $currentIndex, $currentIndex + $rpp, $rpp],
            $url;
        )
    }

    public abstract function hasNextPage();

    public abstract function parsePage($content);

    /**
     * Gets the The current page code.
     *
     * @return string
     */
    public function getCurrentPageCode()
    {
        return $this->currentPageCode;
    }

    /**
     * Gets the Last results fetched.
     *
     * @return Array
     */
    public function getResults()
    {
        return $this->results;
    }

    public function hasResults(){
        return count($this->results) > 0;
    }
}