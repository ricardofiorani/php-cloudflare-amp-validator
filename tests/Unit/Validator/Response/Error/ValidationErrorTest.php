<?php

namespace Tests\RicardoFiorani\Unit\Validator\Response\Error;

use PHPUnit\Framework\TestCase;
use RicardoFiorani\Validator\Response\Error\ValidationError;
use Mockery as m;

class ValidationErrorTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGetters()
    {
        $code = 'ERROR_CODE';
        $errorMessage = 'This is a test message';
        $helpUrl = 'http://helpmeeee.com';
        $line = 1;
        $col = 2;

        $error = new ValidationError(
            $code,
            $errorMessage,
            $helpUrl,
            $line,
            $col
        );

        $this->assertEquals($code, $error->getCode());
        $this->assertEquals($errorMessage, $error->getErrorMessage());
        $this->assertEquals($helpUrl, $error->getHelpUrl());
        $this->assertEquals($line, $error->getLine());
        $this->assertEquals($col, $error->getCol());
    }
}
