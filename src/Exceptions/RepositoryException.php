<?php

namespace JetBox\Repositories\Exceptions;


final class RepositoryException extends BaseException
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

        return new self ($errorMessage);
    }

    /**
     * Report Error Log File
     */
    public function report(): void
    {
        $this->reportError();
    }
}
