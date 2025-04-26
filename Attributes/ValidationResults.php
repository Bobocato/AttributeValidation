<?php

require_once 'ValidationResult.php';
class ValidationResults
{
    private array $results = [];

    public function merge(ValidationResults $results): void
    {
        $this->results = array_merge($this->results, $results->getResults());
    }

    public function add(ValidationResult $result): void
    {
        $this->results[] = $result;
    }

    public function getResults(): array
    {
        return $this->results;
    }

    public function isValid(): bool
    {
        foreach ($this->results as $result){
            if(!$result->isValid()){
                return false;
            }
        }
        return true;
    }

}