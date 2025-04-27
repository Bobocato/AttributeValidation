<?php

namespace Attributes;
interface ValidatorAttribute
{

    public function validate(mixed $request): ValidationResults;

}