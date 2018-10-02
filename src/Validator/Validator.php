<?php declare(strict_types=1);

namespace RicardoFiorani\Validator;

use function GuzzleHttp\Psr7\stream_for;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use RicardoFiorani\Validator\Response\ValidationResponseFactory;
use RicardoFiorani\Validator\Response\ValidationResponseInterface;
use Zend\Diactoros\RequestFactory;

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

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    public function __construct(ClientInterface $httpClient, ?RequestFactoryInterface $requestFactory = null)
    {
        $this->setHttpClient($httpClient);
        $this->responseFactory = new ValidationResponseFactory();

        if (is_null($requestFactory)) {
            $requestFactory = new RequestFactory();
        }

        $this->requestFactory = $requestFactory;
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
        $request = $this->requestFactory->createRequest('GET', self::CLOUDFLARE_AMP_VALIDATOR_ENDPOINT . $url);
        $response = $this->httpClient->sendRequest($request);

        return $this->responseFactory->create($response);
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function validateContent(string $content): ValidationResponseInterface
    {
        $request = $this->requestFactory->createRequest('POST', self::CLOUDFLARE_AMP_VALIDATOR_ENDPOINT);
        $requestWithBody = $request->withBody(stream_for($content));

        $response = $this->httpClient->sendRequest($requestWithBody);

        return $this->responseFactory->create($response);
    }

    private function normaliseUrl(string $url): string
    {
        return str_replace(['http://', 'https://'], '', strtolower($url));
    }
}
