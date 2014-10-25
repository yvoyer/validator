<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator\Message;

use Star\Component\Validator\Exception\InvalidArgumentException;

/**
 * Class ObjectTraceMessage
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Message
 */
class ObjectTraceMessage implements ErrorMessage
{
    /**
     * @var object
     */
    private $object;

    /**
     * @var ErrorMessage
     */
    private $message;

    /**
     * @param object $object
     * @param ErrorMessage $message
     *
     * @throws \Star\Component\Validator\Exception\InvalidArgumentException
     */
    public function __construct($object, ErrorMessage $message)
    {
        if (false === is_object($object)) {
            throw new InvalidArgumentException('The object argument must be an object.');
        }

        $this->object = $object;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getString()
    {
        $class = get_class($this->object);
        return "A validation error occurred on object '{$class}' with message: '{$this->message->getString()}'.";
    }
}
 