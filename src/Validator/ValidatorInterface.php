<?php declare(strict_types=1);

namespace RicardoFiorani\Validator;

use Psr\Http\Client\ClientInterface;
use RicardoFiorani\Validator\Response\ValidationResponseInterface;

interface ValidatorInterface
{
    public function setHttpClient(ClientInterface $client);

    public function validateUrl(string $url): ValidationResponseInterface;

    public function validateContent(string $content): ValidationResponseInterface;
}
