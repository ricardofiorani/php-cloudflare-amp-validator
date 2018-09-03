<?php declare(strict_types=1);

namespace RicardoFiorani\Validator;

use GuzzleHttp\ClientInterface;

interface ValidatorInterface
{
    public function setClient(ClientInterface $client);

    public function validateUrl(string $url): ValidationResponse;

    public function validateContent(string $content): ValidationResponse;
}