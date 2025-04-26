<?php

require_once 'ValidationResult.php';
require_once 'AbstractValidatorAttribute.php';
#[Attribute]
class RangeValidatorAttribute extends AbstractValidatorAttribute
{

    public const RANGE_MIN = 'min';
    public const RANGE_MAX = 'max';


    public function __construct(private array $parameter)
    {
    }

    public function validate(mixed $request): bool|array
    {
        $errors = [];

        foreach ($this->parameter as $key => $param){

            $value = $this->getValueFromObject($key, $request);

            if (is_null($value)){
                return true;
            }

            if(!is_numeric($value)){
                 $errors[] = new ValidationResult($key, 'Value must be an integer', false);
            }

            if(isset($param[self::RANGE_MIN]) && $value < $param[self::RANGE_MIN]){
                $errors[] = new ValidationResult($key, 'Value must be greater than ' . $param[self::RANGE_MIN], false);
            }

            if(isset($param[self::RANGE_MAX]) && $value > $param[self::RANGE_MAX]){
                $errors[] = new ValidationResult($key, 'Value must be less than ' . $param[self::RANGE_MAX], false);
            }
        }

        if (count($errors) === 0) {
            return true;
        }
        return $errors;
    }


}