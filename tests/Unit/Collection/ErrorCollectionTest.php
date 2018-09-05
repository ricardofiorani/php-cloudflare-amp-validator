<?php

namespace Tests\RicardoFiorani\Unit\Collection;

use RicardoFiorani\Collection\ErrorCollection;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use RicardoFiorani\Validator\Response\Error\ValidationError;

class ErrorCollectionTest extends TestCase
{
    /**
     * @var ErrorCollection
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

        $this->assertEquals([$errorMock], $this->collection->toArray());
    }

    public function testRemoveElement()
    {
        $errorMock = m::mock(ValidationError::class);

        $this->collection->add($errorMock);
        $this->collection->removeElement($errorMock);

        $this->assertEmpty($this->collection->toArray());
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

        $this->assertEmpty($this->collection->toArray());
    }
}
