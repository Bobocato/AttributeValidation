<?php

namespace Attributes;

use ReflectionClass;
use ReflectionException;

class AttributeValidation
{

    /**
     * @throws ReflectionException
     */
    protected function validate($request): ValidationResults
    {
        $reflection = new ReflectionClass($this);
        $backtrace = debug_backtrace();

        $method = $reflection->getMethod($backtrace[1]['function']);

        $attributes = $method->getAttributes();
        $result = new ValidationResults();
        foreach ($attributes as $attribute) {
            $inst = $attribute->newInstance();
            /** @var $inst ValidatorAttribute */
            $result->merge($inst->validate($request));
        }
        return $result;
    }

}