<?php

require_once 'Attributes/TypeValidatorAttribute.php';
require_once 'Attributes/RangeValidatorAttribute.php';
require_once 'Attributes/ValidationResults.php';
class Test
{

    #[TypeValidatorAttribute(['stringVariable' => TypeValidatorAttribute::TYPE_STRING, 'integerVariable' => TypeValidatorAttribute::TYPE_INT])]
    #[RangeValidatorAttribute(['integerVariable' => [RangeValidatorAttribute::RANGE_MIN => 1, RangeValidatorAttribute::RANGE_MAX => 10]])]
    public function testing($request): void
    {
        $validationResult = $this->validate($request);

        foreach ($validationResult->getResults() as $result){
            if(!$result->isValid()){
                echo $result->getField() . ' ' . $result->getMessage() . PHP_EOL;
            }
        }
    }


    /**
     * @throws ReflectionException
     */
    private function validate($request): ValidationResults
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