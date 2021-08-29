<?php

namespace JetBox\Repositories\Exceptions;

use Exception;

final class RepositoryException extends Exception
{
    /**
     * @param object $object
     * @return RepositoryException
     */
    public static function orderByDirection(object $object): RepositoryException
    {
        $className = get_class($object);

        $message = 'The Given Value Is Incorrect - The Value Should Be `desc` or `asc`';
        $errorMessage = "${className} #orderByDirection = '$object->orderByDirection' ${message}";

        logger()->error($errorMessage);

        return new self ($errorMessage);
    }
}
