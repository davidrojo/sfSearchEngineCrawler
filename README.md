# sfSearchEngineCrawler
Search engine crawler for symfony

## Install

### Composer

Add requirement:

```json
{
  "require": {
   "davidrojo/sfSearchEngineCrawler": "dev-master"
  }
}
```

Via command line:

```
$ composer require davidrojo/sfSearchEngineCrawler
```

## Usage

```php
  // Create a factory engine crawler
  $factory = new SearchEngineCrawlerFactory();
  
  // Get a engine using parameter, options available are: "Google", "Yahoo", "Bing"
  $crawler = $factory->createCrawler("Google");
  
  // Set maximum amount of results to fetch (default: 100)
  $crawler->setMaxResults(30);
  
  // Set timeout between each request (default: 500)
  $crawler->setTimeout(200);
  
  // Set a header option (default: 
  $crawler->setHeader("User-Agent", "My awesome user agent/2.3");
  
  // Search results, $r is an array of CrawlerResult object with getTitle(), getDescription() and getUrl() operations
  $r = $crawler->search('madrid');
  
  // Search the Nth result for the $keyword that matches the $domain string, $r is an instance of CrawlerResult, or null if not found. Use $r->getPosition() to retrieve the position of the result
  $r = $crawler->searchForDomain($domain, $keyword);
```
