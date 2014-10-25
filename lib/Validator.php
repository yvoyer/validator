<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Star\Component\Validator\Handler\NotificationHandler;

/**
 * Class Validator
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 */
interface Validator
{
    /**
     * @param NotificationHandler $handler
     *
     * @return ValidationResult
     */
    public function validate(NotificationHandler $handler);
}
 