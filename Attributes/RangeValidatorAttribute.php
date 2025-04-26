<?php

require_once 'ValidationResult.php';
require_once 'ValidationResults.php';
require_once 'AbstractValidatorAttribute.php';

#[Attribute]
class RangeValidatorAttribute extends AbstractValidatorAttribute
{

    public const RANGE_MIN = 'min';
    public const RANGE_MAX = 'max';


    public function __construct(private readonly array $parameter)
    {
    }

    /**
     * @throws ValidationException
     * @noinspection PhpUnused
     */
    public function validate(mixed $request): ValidationResults
    {
        $results = new ValidationResults();

        foreach ($this->parameter as $key => $param) {

            $value = $this->getValueByKey($key, $request);

            if (is_null($value)) {
                $results->add(new ValidationResult($key, true));
            }

            if (!is_numeric($value)) {
                $results->add(new ValidationResult($key, false, 'Value must be an integer'));
            }

            if (isset($param[self::RANGE_MIN]) && $value < $param[self::RANGE_MIN]) {
                $results->add(new ValidationResult($key, false, 'Value is '. $value .' must be greater than ' . $param[self::RANGE_MIN]));
            }

            if (isset($param[self::RANGE_MAX]) && $value > $param[self::RANGE_MAX]) {
                $results->add(new ValidationResult($key, false, 'Value is '. $value .' must be less than ' . $param[self::RANGE_MAX]));
            }
        }

        return $results;
    }


}