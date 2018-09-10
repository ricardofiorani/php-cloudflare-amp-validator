<?php declare(strict_types=1);

namespace RicardoFiorani\Validator\Response;

use RicardoFiorani\Validator\Response\Error\Collection\ErrorCollection;

interface ValidationResponseInterface
{
    public function getSource(): string;

    public function getVersion(): string;

    public function isValid(): bool;

    public function getErrors(): ErrorCollection;
}
