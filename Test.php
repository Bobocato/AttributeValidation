<?php

require_once 'Attributes/TypeValidatorAttribute.php';
require_once 'Attributes/RangeValidatorAttribute.php';
class Test
{

    #[TypeValidatorAttribute(['teil' => TypeValidatorAttribute::TYPE_STRING, 'integer' => TypeValidatorAttribute::TYPE_INT])]
    #[RangeValidatorAttribute(['integer' => [RangeValidatorAttribute::RANGE_MIN => 1, RangeValidatorAttribute::RANGE_MAX => 10]])]
    public function testing($request)
    {
        $validationResult = $this->validate($request);

        if(is_array($validationResult)){
            throw new Exception('Validation Failed');
        }
    }


    /**
     * @throws ReflectionException
     */
    private function validate($request): bool|array
    {
        $reflection = new ReflectionClass($this);
        $backtrace = debug_backtrace();

        $method = $reflection->getMethod($backtrace[1]['function']);

        $attributes = $method->getAttributes();
        $result = [];
        foreach ($attributes as $attribute) {
            $inst = $attribute->newInstance();
            $result[] = $inst->validate($request);
        }
        return $result;
    }

}