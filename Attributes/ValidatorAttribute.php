<?php

interface ValidatorAttribute
{

    public function validate(mixed $request): ValidationResults;

}