Validator
=========

[![Build Status](https://travis-ci.org/yvoyer/validator.svg?branch=master)](https://travis-ci.org/yvoyer/validator)

Validation tool that can be connected on any object you want to validate.

Usage
-----

Validators
----------

Validators are classes that will determines if the value was valid.
In the following example, the `YourNonEmptyValidator` would make sure the name on the `SomeObject` cannot be empty.

    // YourNonEmptyValidator.php
    class YourNonEmptyValidator implements Validator
    {
        /**
         * @var SomeObject
         */
        private $object;

        /**
         * @param SomeObject $object
         */
        public function __construct(SomeObject $object)
        {
            $this->object = $object;
        }

        /**
         * @param ValidationNotificationHandler $handler
         *
         * @return ValidationResult
         */
        public function validate(ValidationNotificationHandler $handler)
        {
            $name = $this->object->getName();

            if (empty($name)) {
                $handler->notifyError(new StringMessage('Name cannot be empty.'));
            }

            return $handler->createResult();
        }
    }

The validators will return a `ValidationResult` to determine whether any constraints have failed.

ValidationNotificationHandler
-----------------------------

The `ValidationNotificationHandler` are responsible to notify the user about an error.

The only supported strategy currently implemented are:

* ExceptionNotificationHandler: Will throw a `ValidationErrorException` on the first error (recommended for development).
* DeferredNotificationHandler: Will keep the trace of all errors for future use by the `ValidationResult`.

Example
-------

Given you created a class that needs to be validated:

    // SomeObject.php
    class SomeObject
    {
        /**
         * @var string
         */
        private $name;

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getName()
        {
            return $this->name;
        }
    }

You will need to implement a validation method in which you will put all the validators to push in the `ValidationHandler`.

    // SomeObject.php
    ...
    /**
     * @param ValidationNotificationHandler $handler
     *
     * @return ValidationResult
     */
    public function validate(ValidationNotificationHandler $handler)
    {
        $validator = new YourNonEmptyValidator($this); // This is your custom validator implementing Validator interface

        return $validator->validate($handler);
    }
    ...

Creating the validator for your object (or using built-in validators, you can get the result from the validation.

By using the structure, validating your code will look something like this.

    // Using the Exception handler on a valid object
    $validObject = new SomeObject();
    $validObject->setName('non-empty');
    $result = $validObject->validate(new ExceptionNotificationHandler());
    $result->hasErrors(); // Returns false
    $result->getErrors()); // Returns empty array(), since there was no errors

    // Using the Exception handler on a invalid object
    $invalidObject = new SomeObject();
    $invalidObject->validate(new ExceptionNotificationHandler()); // Would throw an exception on the first error (because of the handler).

    // Using the deferred handler on a invalid object
    $result = $invalidObject->validate(new DeferredNotificationHandler());
    $result->hasErrors(); // Returns true
    $result->getErrors()); // Returns empty array('Name cannot be empty.')
