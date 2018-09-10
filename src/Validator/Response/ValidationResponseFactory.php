<?php declare(strict_types=1);

namespace RicardoFiorani\Validator\Response;

use Psr\Http\Message\ResponseInterface;
use RicardoFiorani\Validator\Response\Error\Collection\ErrorCollection;
use RicardoFiorani\Validator\Response\Error\ValidationError;

class ValidationResponseFactory
{
    public function create(ResponseInterface $response): ValidationResponseInterface
    {
        $jsonResponse = (string)$response->getBody();
        $jsonResponseObject = json_decode($jsonResponse);

        $errorCollection = $jsonResponseObject->valid ?
            new ErrorCollection() :
            $this->createErrorCollectionFromJsonResponseObject($jsonResponseObject);

        return new ValidationResponse(
            $jsonResponseObject->source,
            $jsonResponseObject->version,
            $jsonResponseObject->valid,
            $errorCollection
        );
    }

    private function createErrorCollectionFromJsonResponseObject(\stdClass $jsonResponseObject): ErrorCollection
    {
        $collection = new ErrorCollection();

        foreach ($jsonResponseObject->errors as $error) {
            $collection->add(
                new ValidationError(
                    $error->code,
                    $error->error,
                    $error->help,
                    $error->line,
                    $error->col
                )
            );
        }

        return $collection;
    }
}
