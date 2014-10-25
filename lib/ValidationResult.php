<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Star\Component\Validator\Exception\InvalidArgumentException;
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
    private $messages = array();

    /**
     * @param ErrorMessage[] $errorMessages
     */
    public function __construct(array $errorMessages = array())
    {
        $this->addErrors($errorMessages);
    }

    /**
     * @param ErrorMessage[] $messages
     *
     * @throws InvalidArgumentException
     */
    public function addErrors(array $messages)
    {
        foreach ($messages as $message) {
            if (false === $message instanceof ErrorMessage) {
                throw new InvalidArgumentException('Validation result only accepts ErrorMessage instances.');
            }

            $this->addError($message);
        }
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
            $errors[] = (string) $message->getString();
        }

        return $errors;
    }

    /**
     * @param ErrorMessage $message
     */
    public function addError(ErrorMessage $message)
    {
        $this->messages[] = $message;
    }
}
 