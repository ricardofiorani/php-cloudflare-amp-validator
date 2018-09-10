<?php declare(strict_types=1);

namespace RicardoFiorani\Validator\Response;

use RicardoFiorani\Validator\Response\Error\Collection\ErrorCollection;

class ValidationResponse implements ValidationResponseInterface
{
    private $source;
    private $version;
    private $isValid;
    private $errors;

    public function __construct(
        string $source,
        string $version,
        bool $isValid,
        ErrorCollection $errors
    ) {
        $this->source = $source;
        $this->version = $version;
        $this->isValid = $isValid;
        $this->errors = $errors;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getErrors(): ErrorCollection
    {
        return $this->errors;
    }
}
