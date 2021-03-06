<?php
/**
 * This file is part of the validator.local project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator\Handler;

use Star\Component\Validator\Exception\ValidationErrorException;
use Star\Component\Validator\ValidationResult;
use Star\Component\Validator\Message\ErrorMessage;

/**
 * Class ExceptionNotificationHandler
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Handler
 */
class ExceptionNotificationHandler implements NotificationHandler
{
    /**
     * @var string
     */
    private $exceptionClass;

    /**
     * @param string $exceptionClass Class name that derives from \Exception.
     */
    public function __construct($exceptionClass = null)
    {
        if (null === $exceptionClass) {
            $exceptionClass = ValidationErrorException::CLASS_NAME;
        }

        $this->exceptionClass = $exceptionClass;
    }

    /**
     * @param ErrorMessage $message
     */
    public function notifyError(ErrorMessage $message)
    {
        throw new $this->exceptionClass($message->getString());
    }

    /**
     * @return ValidationResult
     */
    public function createResult()
    {
        return new ValidationResult(array());
    }
}
