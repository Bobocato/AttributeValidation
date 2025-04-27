<?php

use Attributes\AttributeValidation;
use Attributes\RangeValidator;
use Attributes\TypeValidator;

class Test extends AttributeValidation
{

    #[TypeValidator(['stringVariable' => TypeValidator::TYPE_STRING, 'integerVariable' => TypeValidator::TYPE_INT])]
    #[RangeValidator(['integerVariable' => [RangeValidator::RANGE_MIN => 1, RangeValidator::RANGE_MAX => 10]])]
    public function testing($request): void
    {
        $validationResult = $this->validate($request);

        foreach ($validationResult->getResults() as $result) {
            if (!$result->isValid()) {
                echo $result->getField() . ' ' . $result->getMessage() . PHP_EOL;
            }
        }
    }

}