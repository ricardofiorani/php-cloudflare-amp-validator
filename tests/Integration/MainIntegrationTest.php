<?php declare(strict_types=1);

namespace Tests\RicardoFiorani\Integration;

use Http\Adapter\Guzzle6\Client;
use PHPUnit\Framework\TestCase;
use RicardoFiorani\Validator\Validator;

class MainIntegrationTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $this->client = new Client();
    }

    /**
     * @dataProvider invalidUrlProvider
     */
    public function testValidateInvalidUrl(string $url)
    {
        $validator = new Validator($this->client);
        $response = $validator->validateUrl($url);

        $this->assertFalse($response->isValid());
        $this->assertNotEmpty($response->getErrors()->toArray());
    }

    public function testValidateInvalidContent()
    {
        $validator = new Validator($this->client);
        $response = $validator->validateContent($this->getInvalidContent());

        $this->assertFalse($response->isValid());
        $this->assertNotEmpty($response->getErrors()->toArray());
    }

    /**
     * @dataProvider validUrlProvider
     */
    public function testValidateValidUrl(string $url)
    {
        $validator = new Validator($this->client);
        $response = $validator->validateUrl($url);

        $this->assertTrue($response->isValid());
        $this->assertEmpty($response->getErrors()->toArray());
    }

    public function testValidateValidContent()
    {
        $validator = new Validator($this->client);
        $response = $validator->validateContent($this->getValidContent());

        $this->assertTrue($response->isValid());
        $this->assertEmpty($response->getErrors()->toArray());
    }

    public function invalidUrlProvider()
    {
        return [
            ['https://gist.githubusercontent.com/ricardofiorani/b7dc847f9ff1329a9eca3ab4650ff41a/raw/b056dfc1fff2708a5235afbfa54ce2bc311bc811/invalid-amp.html'],
        ];
    }

    public function validUrlProvider()
    {
        return [
            ['https://gist.githubusercontent.com/ricardofiorani/7ce4d7b049f52fa95236c242fa87653c/raw/70e984de742c1b163eeef7425214cc9b2db9c9fa/valid-amp.html'],
        ];
    }

    private function getInvalidContent()
    {
        return <<<HTML
<!doctype html>
<html amp lang="en">
  <head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>Hello, AMPs</title>
    <link rel="canonical" href="http://example.ampproject.org/article-metadata.html">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "headline": "Open-source framework for publishing content",
        "datePublished": "2015-10-07T12:02:41Z",
        "image": [
          "logo.jpg"
        ]
      }
    </script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
  </head>
  <body>
    <h1>Welcome to the mobile web</h1>
    <amp-img src="" alt="Welcome" height="400" width="800"></amp-img>
  </body>
</html>
HTML;
    }

    private function getValidContent()
    {
        return <<<HTML
<!doctype html>
<html amp lang="en">
  <head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>Hello, AMPs</title>
    <link rel="canonical" href="http://example.ampproject.org/article-metadata.html">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "headline": "Open-source framework for publishing content",
        "datePublished": "2015-10-07T12:02:41Z",
        "image": [
          "logo.jpg"
        ]
      }
    </script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
  </head>
  <body>
    <h1>Welcome to the mobile web</h1>
    <amp-img src="image.jpg" alt="Welcome" height="400" width="800"></amp-img>
  </body>
</html>
HTML;
    }
}