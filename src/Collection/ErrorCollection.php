<?php declare(strict_types=1);

namespace RicardoFiorani\Collection;

use ArrayAccess;
use IteratorAggregate;
use RicardoFiorani\Validator\Response\Error\ValidationErrorInterface;

class ErrorCollection implements ArrayAccess, IteratorAggregate
{
    private $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function toArray()
    {
        return $this->elements;
    }

    public function first()
    {
        return reset($this->elements);
    }

    public function last()
    {
        return end($this->elements);
    }

    public function key()
    {
        return key($this->elements);
    }

    public function next()
    {
        return next($this->elements);
    }

    public function current()
    {
        return current($this->elements);
    }

    public function remove($key)
    {
        if (!isset($this->elements[$key]) && !array_key_exists($key, $this->elements)) {
            return null;
        }

        $removed = $this->elements[$key];
        unset($this->elements[$key]);

        return $removed;
    }

    public function removeElement(ValidationErrorInterface $element)
    {
        $key = array_search($element, $this->elements, true);

        if ($key === false) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        if (false == $value instanceof ValidationErrorInterface) {
            throw new \LogicException('Value must be an implementation of ValidationErrorInterface');
        }

        if (!isset($offset)) {
            $this->add($value);
            return;
        }

        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    public function containsKey($key)
    {
        return isset($this->elements[$key]) || array_key_exists($key, $this->elements);
    }

    public function indexOf($element)
    {
        return array_search($element, $this->elements, true);
    }

    public function get($key)
    {
        return $this->elements[$key] ?? null;
    }

    public function getKeys()
    {
        return array_keys($this->elements);
    }

    public function getValues()
    {
        return array_values($this->elements);
    }

    public function count()
    {
        return count($this->elements);
    }

    public function add(ValidationErrorInterface $element)
    {
        $this->elements[] = $element;

        return true;
    }

    public function isEmpty()
    {
        return empty($this->elements);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    public function clear()
    {
        $this->elements = [];
    }

    public function slice($offset, $length = null)
    {
        return array_slice($this->elements, $offset, $length, true);
    }
}