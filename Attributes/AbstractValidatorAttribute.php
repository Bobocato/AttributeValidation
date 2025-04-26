<?php

require_once 'ValidationException.php';
require_once 'ValidatorAttribute.php';

class AbstractValidatorAttribute implements ValidatorAttribute
{
    /**
     * @throws ValidationException
     * @noinspection PhpUnused
     */
    public function validate(mixed $request): ValidationResults
    {
        throw new ValidationException('Not implemented');
    }

    /**
     * @throws ValidationException
     */
    protected function getValueByKey(int|string $key, mixed $request)
    {
        if(is_array($request)){
            return $request[$key];
        }

        if(is_object($request)){
            return $request->__get($key);
        }

        throw new ValidationException(sprintf('Value from Request could not be generated. Type: "%s" Key: "%s"', gettype($request), $key));
    }
}