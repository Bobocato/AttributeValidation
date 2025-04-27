# PHP Validation Framework

A lightweight PHP validation framework that uses PHP 8 attributes for declarative validation rules. This framework allows you to define validation rules using attributes (annotations) directly in your code.

## Features

- Attribute-based validation rules
- Support for multiple validation rules per method
- Type validation
- Range validation
- Extensible validation system
- Clear validation result reporting

## Requirements

- PHP 8.0 or higher
- Reflection extension enabled

## Installation

Clone this repository to your project:

```bash
git clone [repository-url]
```
## Usage
### Basic Example
``` php
class Example {
    #[TypeValidatorAttribute(['name' => TypeValidatorAttribute::TYPE_STRING, 'age' => TypeValidatorAttribute::TYPE_INT])]
    #[RangeValidatorAttribute(['age' => [RangeValidatorAttribute::RANGE_MIN => 0, RangeValidatorAttribute::RANGE_MAX => 120]])]
    public function validatePerson($request): void 
    {
        $validationResult = $this->validate($request);
        // Process validation results
    }
}
```
### Available Validators
1. **TypeValidatorAttribute**
    - Validates data types of input values
    - Supported types:
        - `TYPE_STRING`
        - `TYPE_INT`

2. **RangeValidatorAttribute**
    - Validates numeric values within specified ranges
    - Parameters:
        - : Minimum value `RANGE_MIN`
        - : Maximum value `RANGE_MAX`

### Validation Results
The validation process returns a object containing: `ValidationResults`
- Validation status for each field
- Error messages if validation fails
- Methods to iterate through results

## Contributing
Feel free to submit issues and enhancement requests.