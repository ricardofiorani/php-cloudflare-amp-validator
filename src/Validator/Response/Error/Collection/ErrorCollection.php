<?php declare(strict_types=1);

namespace RicardoFiorani\Validator\Response\Error\Collection;

use RicardoFiorani\Validator\Response\Error\ValidationErrorInterface;

class ErrorCollection
{
    private $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    public function removeElement(ValidationErrorInterface $element): self
    {
        $key = array_search($element, $this->elements, true);

        if ($key !== false) {
            unset($this->elements[$key]);
        }

        return $this;
    }

    public function add(ValidationErrorInterface $element): self
    {
        $this->elements[] = $element;

        return $this;
    }

    public function clear(): self
    {
        $this->elements = [];

        return $this;
    }
}
