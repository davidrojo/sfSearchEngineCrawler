<?php

namespace DavidRojo\SearchEngineCrawler\Utils;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

abstract class SearchEngineCrawler
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
     * Constructor
     * @param String
     */
    public function __construct($type){
        $this->type = $type;

        if (class_exists($type)){
            $this->engine = new $type();
        }
        else{
            throw new Exception("Crawler ".$type." not found");
        }
    }

    /**
     * Loads the next page and returns true if there are new results
     * @return boolean
     */
    public function next(){
        if ($this->engine->hasNextPage()){
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
        $url = $this->engine->buildUrl($this->fetchUrl, $this->keyword, $this->currentPage, $this->currentPage * $this->rpp, $this->rpp);
        return file_get_contents($url);
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
    protected function setName(String $name)
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
     * @param [type] $fetchUrl the fetch url
     *
     * @return self
     */
    protected function setFetchUrl([type] $fetchUrl)
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
    protected function setMaxResults(Int $maxResults)
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
}