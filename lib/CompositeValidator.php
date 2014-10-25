<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Star\Component\Validator\Handler\NotificationHandler;
use Star\Component\Validator\Message\StringMessage;

/**
 * Class CompositeValidator
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 */
class CompositeValidator implements Validator
{
    /**
     * @var Validator[]
     */
    private $validators = array();

    /**
     * @param Validator $validator
     */
    public function addValidator(Validator $validator)
    {
        $this->validators[] = $validator;
    }

    /**
     * @param NotificationHandler $handler
     *
     * @return ValidationResult
     */
    public function validate(NotificationHandler $handler)
    {
        $errors = array();
        foreach ($this->validators as $validator) {
            $result = $validator->validate($handler);
            foreach ($result->getErrors() as $errorMessages) {
                $errors[] = new StringMessage($errorMessages);
            }
        }

        return new ValidationResult($errors);
    }
}
 