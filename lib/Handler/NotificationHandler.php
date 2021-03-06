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
 * Class NotificationHandler
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Handler
 */
interface NotificationHandler
{
    /**
     * @param ErrorMessage $message
     */
    public function notifyError(ErrorMessage $message);

    /**
     * @return ValidationResult
     */
    public function createResult();
}
 