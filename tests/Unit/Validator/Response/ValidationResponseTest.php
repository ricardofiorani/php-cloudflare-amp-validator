<?php

namespace Tests\RicardoFiorani\Unit\Validator\Response;

use PHPUnit\Framework\TestCase;
use RicardoFiorani\Validator\Response\Error\Collection\ErrorCollection;
use RicardoFiorani\Validator\Response\Error\ValidationError;
use RicardoFiorani\Validator\Response\ValidationResponse;
use Mockery as m;

class ValidationResponseTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGetters()
    {
        $source = 'source';
        $version = '123123123123';
        $isValid = false;

        $validationErrorMock = m::spy(ValidationError::class);
        $errors = new ErrorCollection();
        $errors->add($validationErrorMock);

        $response = new ValidationResponse(
            $source,
            $version,
            $isValid,
            $errors
        );

        $this->assertEquals($source, $response->getSource());
        $this->assertEquals($version, $response->getVersion());
        $this->assertEquals($isValid, $response->isValid());
        $this->assertEquals($errors, $response->getErrors());
    }
}
