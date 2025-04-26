<?php

class ValidationResult
{

    public function __construct(private string $field, private string $message, private bool $valid)
    {
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

}