<?php declare(strict_types=1);

namespace RicardoFiorani\Validator;

use Http\Client\HttpClient;
use RicardoFiorani\Validator\Response\ValidationResponseInterface;

interface ValidatorInterface
{
    public function setClient(HttpClient $client);

    public function validateUrl(string $url): ValidationResponseInterface;

    public function validateContent(string $content): ValidationResponseInterface;
}
