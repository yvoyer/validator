<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Star\Component\Validator\Message\ErrorMessage;

/**
 * Class ValidationResult
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 */
class ValidationResult
{
    /**
     * @var ErrorMessage[]
     */
    private $messages;

    /**
     * @param ErrorMessage[] $errorMessages
     */
    public function __construct(array $errorMessages)
    {
        $this->messages = $errorMessages;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->messages) > 0;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $errors = array();
        foreach ($this->messages as $message) {
            $errors[] = $message->getString();
        }

        return $errors;
    }
}
 