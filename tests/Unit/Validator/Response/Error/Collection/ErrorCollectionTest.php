<?php

namespace Tests\RicardoFiorani\Unit\Validator\Response\Error\Collection;

use RicardoFiorani\Validator\Response\Error\Collection\ErrorCollection;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use RicardoFiorani\Validator\Response\Error\ValidationError;

class ErrorCollectionTest extends TestCase
{
    /**
     * @var \RicardoFiorani\Validator\Response\Error\Collection\ErrorCollection
     */
    private $collection;

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->collection = new ErrorCollection();
    }

    public function testAddAndToArray()
    {
        $errorMock = m::mock(ValidationError::class);

        $this->collection->add($errorMock);

        TestCase::assertEquals([$errorMock], $this->collection->toArray());
    }

    public function testRemoveElement()
    {
        $errorMock = m::mock(ValidationError::class);

        $this->collection->add($errorMock);
        $this->collection->removeElement($errorMock);

        TestCase::assertEmpty($this->collection->toArray());
    }

    public function testClear()
    {
        $errorMock1 = m::mock(ValidationError::class);
        $errorMock2 = m::mock(ValidationError::class);
        $errorMock3 = m::mock(ValidationError::class);

        $this->collection
            ->add($errorMock1)
            ->add($errorMock2)
            ->add($errorMock3);

        $this->collection->clear();

        TestCase::assertEmpty($this->collection->toArray());
    }
}
