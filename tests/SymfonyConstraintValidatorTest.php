<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Symfony\Component\Validator\Constraints\Email;

/**
 * Class SymfonyConstraintValidatorTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 *
 * @covers Star\Component\Validator\SymfonyConstraintValidator
 * @uses Star\Component\Validator\Message\StringMessage
 */
class SymfonyConstraintValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $handler;

    public function setUp()
    {
        $this->handler = $this->getMock('Star\Component\Validator\Handler\NotificationHandler');
    }

    public function test_is_should_trigger_error()
    {
        $this->handler
            ->expects($this->once())
            ->method('notifyError');

        $validator = new SymfonyConstraintValidator('string', new Email());
        $validator->validate($this->handler);
    }

    public function test_is_should_not_trigger_error()
    {
        $this->handler
            ->expects($this->never())
            ->method('notifyError');

        $validator = new SymfonyConstraintValidator('user@example.com', new Email());
        $validator->validate($this->handler);
    }
}
 