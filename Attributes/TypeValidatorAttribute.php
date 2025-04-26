<?php

require_once 'ValidationResult.php';
require_once 'AbstractValidatorAttribute.php';

#[Attribute]
class TypeValidatorAttribute extends AbstractValidatorAttribute
{

    public const TYPE_STRING = 'string';
    public const TYPE_INT = 'integer';

    public function __construct(private array $parameter)
    {
    }

    public function validate(mixed $request): bool|array
    {
        $errors = [];

        foreach ($this->parameter as $key => $param) {

            $value = $this->getValueFromObject($key, $request);

            if (is_null($value)) {
                return true;
            }

            if (gettype($value) !== $param) {
                $errors[] = new ValidationResult($key, sprintf('Value must be of type "%s" is "%s"', $param, gettype($value)), false);
            }
        }

        if (count($errors) === 0) {
            return true;
        }
        return $errors;
    }
}