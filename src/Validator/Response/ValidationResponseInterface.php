<?php declare(strict_types=1);

namespace RicardoFiorani\Validator\Response;

use RicardoFiorani\Collection\ErrorCollection;

interface ValidationResponseInterface
{
    public function getSource(): string;

    public function getVersion(): string;

    public function isValid(): bool;

    public function getErrors(): ErrorCollection;
}