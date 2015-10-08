<?php

namespace DavidRojo\SearchEngineCrawler;

class CrawlerResult{

    /**
     * Result title
     * @var string
     */
    protected $title = "";

    /**
     * Result description
     * @var string
     */
    protected $description = "";

    /**
     * Result url
     * @var string
     */
    protected $url = "";

    

    /**
     * Gets the Result title.
     *
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the Result title.
     *
     * @param String $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the Result description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the Result description.
     *
     * @param string $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the Result url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the Result url.
     *
     * @param string $url the url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}