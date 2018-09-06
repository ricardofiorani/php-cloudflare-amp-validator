<?php declare(strict_types=1);

namespace RicardoFiorani\Validator;

use Http\Client\Exception as HttpException;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestInterface;
use RicardoFiorani\Validator\Response\ValidationResponseFactory;
use RicardoFiorani\Validator\Response\ValidationResponseInterface;

class Validator implements ValidatorInterface
{
    const CLOUDFLARE_AMP_VALIDATOR_ENDPOINT = 'https://amp.cloudflare.com/q/';

    /**
     * @var HttpClient
     */
    private $client;

    public function __construct(HttpClient $client)
    {
        $this->setClient($client);
    }

    public function setClient(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws HttpException
     */
    public function validateUrl(string $url): ValidationResponseInterface
    {
        $url = $this->normaliseUrl($url);
        $request =
        $response = $this->client->sendRequest('GET', self::CLOUDFLARE_AMP_VALIDATOR_ENDPOINT . $url);

        return ValidationResponseFactory::createFromGuzzleResponse($response);
    }

    /**
     * @throws HttpException
     */
    public function validateContent(string $content): ValidationResponseInterface
    {
        $response = $this->client->request(
            'POST',
            self::CLOUDFLARE_AMP_VALIDATOR_ENDPOINT,
            [
                'body' => $content,
            ]
        );

        return ValidationResponseFactory::createFromGuzzleResponse($response);
    }

    private function normaliseUrl(string $url): string
    {
        return str_replace(['http://', 'https://'], '', strtolower($url));
    }
}
