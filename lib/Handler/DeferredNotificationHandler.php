<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator\Handler;

use Star\Component\Validator\Message\ErrorMessage;
use Star\Component\Validator\ValidationResult;

/**
 * Class DeferredNotificationHandler
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Handler
 */
class DeferredNotificationHandler implements NotificationHandler
{
    /**
     * @var ErrorMessage[]
     */
    private $errors = array();

    /**
     * @param ErrorMessage $message
     */
    public function notifyError(ErrorMessage $message)
    {
        $this->errors[] = $message;
    }

    /**
     * @return ValidationResult
     */
    public function createResult()
    {
        return new ValidationResult($this->errors);
    }
}
 