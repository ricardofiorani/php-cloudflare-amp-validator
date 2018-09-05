<?php

namespace Tests\RicardoFiorani\Unit\Validator\Response;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use RicardoFiorani\Validator\Response\ValidationResponseFactory;
use Mockery as m;

class ValidationResponseFactoryTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testFactoryForValidResponse()
    {
        $jsonBody = <<<JSON
{
  "source": "http://amp.usatoday.com/story/82055560/", 
  "valid": true, 
  "version": "1488238516283"
}
JSON;
        $guzzleResponseMock = m::mock(ResponseInterface::class);
        $guzzleResponseMock
            ->shouldReceive('getBody')
            ->andReturn($jsonBody);

        $generatedResposne = ValidationResponseFactory::createFromGuzzleResponse($guzzleResponseMock);

        $this->assertTrue($generatedResposne->isValid());
        $this->assertEmpty($generatedResposne->getErrors()->toArray());
    }

    public function testFactoryForInvalidResponse()
    {
        $jsonBody = <<<JSON
{
  "errors": [
    {
      "code": "MANDATORY_TAG_MISSING", 
      "col": 7, 
      "error": "The mandatory tag 'link rel=canonical' is missing or incorrect.", 
      "help": "https://www.ampproject.org/docs/reference/spec.html#required-markup", 
      "line": 13
    }
  ], 
  "source": "POST", 
  "valid": false, 
  "version": "1485227592804"
}
JSON;
        $guzzleResponseMock = m::mock(ResponseInterface::class);
        $guzzleResponseMock
            ->shouldReceive('getBody')
            ->andReturn($jsonBody);

        $generatedResposne = ValidationResponseFactory::createFromGuzzleResponse($guzzleResponseMock);

        $this->assertFalse($generatedResposne->isValid());
        $this->assertNotEmpty($generatedResposne->getErrors()->toArray());
    }
}
