<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator\Message;

/**
 * Class ErrorMessage
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Message
 */
interface ErrorMessage
{
    /**
     * @return string
     */
    public function getString();
}
 