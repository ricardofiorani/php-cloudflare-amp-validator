<?php declare(strict_types=1);

namespace RicardoFiorani\Validator\Response\Error;

interface ValidationErrorInterface
{
    public function getCode(): string;

    public function getErrorMessage(): string;

    public function getHelpUrl():string;

    public function getLine(): int;

    public function getCol(): int;
}