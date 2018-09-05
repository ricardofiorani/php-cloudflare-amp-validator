<?php declare(strict_types=1);

namespace RicardoFiorani\Validator;

use GuzzleHttp\ClientInterface;
use RicardoFiorani\Validator\Response\ValidationResponseInterface;

interface ValidatorInterface
{
    public function setClient(ClientInterface $client);

    public function validateUrl(string $url): ValidationResponseInterface;

    public function validateContent(string $content): ValidationResponseInterface;
}