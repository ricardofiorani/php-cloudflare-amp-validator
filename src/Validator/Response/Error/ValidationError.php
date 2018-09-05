<?php declare(strict_types=1);

namespace RicardoFiorani\Validator\Response\Error;

class ValidationError implements ValidationErrorInterface
{
    private $code;
    private $errorMessage;
    private $helpUrl;
    private $line;
    private $col;

    public function __construct(string $code, string $errorMessage, string $helpUrl, int $line, int $col)
    {
        $this->code = $code;
        $this->errorMessage = $errorMessage;
        $this->helpUrl = $helpUrl;
        $this->line = $line;
        $this->col = $col;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getHelpUrl(): string
    {
        return $this->helpUrl;
    }

    public function getLine(): int
    {
        return $this->line;
    }

    public function getCol(): int
    {
        return $this->col;
    }
}
