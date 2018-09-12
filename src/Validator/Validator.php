<?php declare(strict_types=1);

namespace RicardoFiorani\Validator;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use RicardoFiorani\Validator\Response\ValidationResponseFactory;
use RicardoFiorani\Validator\Response\ValidationResponseInterface;

class Validator implements ValidatorInterface
{
    const CLOUDFLARE_AMP_VALIDATOR_ENDPOINT = 'https://amp.cloudflare.com/q/';

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var ValidationResponseFactory
     */
    private $responseFactory;

    public function __construct(ClientInterface $httpClient)
    {
        $this->setHttpClient($httpClient);
        $this->responseFactory = new ValidationResponseFactory();
    }

    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function validateUrl(string $url): ValidationResponseInterface
    {
        $url = $this->normaliseUrl($url);
        $request = new Request('GET', self::CLOUDFLARE_AMP_VALIDATOR_ENDPOINT . $url);
        $response = $this->httpClient->sendRequest($request);

        return $this->responseFactory->create($response);
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function validateContent(string $content): ValidationResponseInterface
    {
        $request = new Request('POST', self::CLOUDFLARE_AMP_VALIDATOR_ENDPOINT, [], $content);
        $response = $this->httpClient->sendRequest($request);

        return $this->responseFactory->create($response);
    }

    private function normaliseUrl(string $url): string
    {
        return str_replace(['http://', 'https://'], '', strtolower($url));
    }
}
