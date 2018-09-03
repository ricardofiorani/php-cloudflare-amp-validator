<?php declare(strict_types=1);

namespace RicardoFiorani\Validator\Response;

use RicardoFiorani\Collection\ErrorCollectionInterface;

interface ValidationResponse
{
    public function getSource(): string;

    public function getVersion(): string;

    public function isValid(): bool;

    public function getErrors(): ErrorCollectionInterface;
}