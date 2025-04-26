<?php

require_once 'Attributes/TypeValidatorAttribute.php';
require_once 'Attributes/RangeValidatorAttribute.php';
require_once 'Attributes/ValidationResults.php';
class Test
{

    #[TypeValidatorAttribute(['teil' => TypeValidatorAttribute::TYPE_STRING, 'integer' => TypeValidatorAttribute::TYPE_INT])]
    #[RangeValidatorAttribute(['integer' => [RangeValidatorAttribute::RANGE_MIN => 1, RangeValidatorAttribute::RANGE_MAX => 10]])]
    public function testing($request): void
    {
        try {
            $validationResult = $this->validate($request);

            if(!$validationResult->isValid()){
                throw new Exception('Validation Failed');
            }
        } catch (Throwable $e) {
            echo $e->getMessage();
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
            $result->add($inst->validate($request));
        }
        return $result;
    }

}