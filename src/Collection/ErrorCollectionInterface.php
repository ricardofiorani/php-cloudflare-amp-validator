<?php declare(strict_types=1);

namespace RicardoFiorani\Collection;

use RicardoFiorani\Collection\CollectionInterface;
use RicardoFiorani\Validator\Response\Error\ErrorInterface;

interface ErrorCollectionInterface extends CollectionInterface
{
    public function add(ErrorInterface $error);

    public function has(ErrorInterface $error);
}