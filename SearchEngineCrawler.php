<?php

namespace DavidRojo\SearchEngineCrawler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use GuzzleHttp\Cookie\FileCookieJar;
use GuzzleHttp\Client;

class SearchEngineCrawler
{
    /**
     * Limits the amount of results to search for the current keyword
     * @var Int
     */
    protected $maxResults = 100;

    /**
     * Current search page
     * @var integer
     */
    protected $currentPage = 0;

    /**
     * Results per page to retrieve
     * @var integer
     */
    protected $rpp = 20;

    /**
     * 
     * @var Engines\SearchEngine
     */
    protected $engine = null;

    /**
     * Keyword to search
     * @var string
     */
    protected $keyword = "";

    /**
     * Crawler options
     * @var Array
     */
    protected $crawlerOptions = [
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36'
        ]
    ];

    /**
     * Constructor
     * @param String
     */
    public function __construct($type){
        $this->type = $type;
        $class = __NAMESPACE__.'\\Engines\\'.$type.'Engine';

        $this->engine = new $class();
    }

    /**
     * Loads the next page and returns true if there are new results
     * @return boolean
     */
    public function next(){
        if ($this->engine->hasNextPage()){
            echo "IN";
            $newPage = $this->fetchPage();
            $this->engine->parsePage($newPage);
            if ($this->engine->hasResults()){
                $this->currentPage++;
                return true;
            }
            else{
              return false;
            }
        }
        else{
          return false;
        }
    }

    public function fetchPage(){
        $url = $this->engine->buildUrl($this->keyword, $this->currentPage, $this->currentPage * $this->rpp, $this->rpp);
        $code = $this->fetchPageCode($url);
        return mb_convert_encoding($code, 'HTML-ENTITIES', "UTF-8");
    }

    public function fetchPageCode($url){
        $client = new Client();
        return $client->get($url, $this->crawlerOptions)
    }


    /**
     * Gets the Crawler name.
     *
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the Crawler name.
     *
     * @param String $name the name
     *
     * @return self
     */
    public function setName(String $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the Fetch url
     *
     * @return [type]
     */
    public function getFetchUrl()
    {
        return $this->fetchUrl;
    }

    /**
     * Sets the Fetch url
     *
     * @param String $fetchUrl the fetch url
     *
     * @return self
     */
    public function setFetchUrl(String $fetchUrl)
    {
        $this->fetchUrl = $fetchUrl;

        return $this;
    }

    /**
     * Gets the Limits the amount of results to search for the current keyword.
     *
     * @return Int
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * Sets the Limits the amount of results to search for the current keyword.
     *
     * @param Int $maxResults the max results
     *
     * @return self
     */
    public function setMaxResults(Int $maxResults)
    {
        $this->maxResults = $maxResults;

        return $this;
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

    /**
     * Gets the Results per page to retrieve.
     *
     * @return integer
     */
    public function getRpp()
    {
        return $this->rpp;
    }

    /**
     * Gets the Keyword to search.
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Sets the Keyword to search.
     *
     * @param string $keyword the keyword
     *
     * @return self
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }
}