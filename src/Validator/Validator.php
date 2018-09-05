<?php declare(strict_types=1);

namespace RicardoFiorani\Validator;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use RicardoFiorani\Validator\Response\ValidationResponseFactory;
use RicardoFiorani\Validator\Response\ValidationResponseInterface;

class Validator implements ValidatorInterface
{
    const CLOUDFLARE_AMP_VALIDATOR_ENDPOINT = 'https://amp.cloudflare.com/q/';

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(?ClientInterface $client = null)
    {
        if (is_null($client)) {
            $client = new Client();
        }

        $this->setClient($client);
    }

    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validateUrl(string $url): ValidationResponseInterface
    {
        $url = $this->normaliseUrl($url);
        $response = $this->client->request('GET', self::CLOUDFLARE_AMP_VALIDATOR_ENDPOINT . $url);

        return ValidationResponseFactory::createFromGuzzleResponse($response);
    }

    /**
     * @param string $content
     * @return ValidationResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
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