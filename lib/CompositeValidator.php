<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Star\Component\Validator\Handler\NotificationHandler;

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
     */
    public function validate(NotificationHandler $handler)
    {
        foreach ($this->validators as $validator) {
            $validator->validate($handler);
        }
    }
}
 