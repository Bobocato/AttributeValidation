<?php

namespace Attributes;

use Attribute;

#[Attribute]
class TypeValidator extends AbstractValidatorAttribute
{

    public const TYPE_STRING = 'string';
    public const TYPE_INT = 'integer';

    public function __construct(private readonly array $parameter)
    {
    }

    /**
     * @throws ValidationException
     * @noinspection PhpUnused
     */
    public function validate(mixed $request): ValidationResults
    {
        $result = new ValidationResults();

        foreach ($this->parameter as $key => $param) {

            $value = $this->getValueByKey($key, $request);

            if (is_null($value)) {
                $result->add(new ValidationResult($key, true));
            }

            if (gettype($value) !== $param) {
                $result->add(new ValidationResult($key, false, sprintf('Value must be of type "%s" is "%s"', $param, gettype($value))));
            }
        }

        return $result;
    }
}