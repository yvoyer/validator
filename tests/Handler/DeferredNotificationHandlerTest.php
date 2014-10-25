<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator\Handler;

/**
 * Class DeferredNotificationHandlerTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Handler
 *
 * @covers Star\Component\Validator\Handler\DeferredNotificationHandler
 * @uses Star\Component\Validator\ValidationResult
 */
class DeferredNotificationHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DeferredNotificationHandler
     */
    private $handler;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $message;

    public function setUp()
    {
        $this->message = $this->getMock('Star\Component\Validator\Message\ErrorMessage');
        $this->handler = new DeferredNotificationHandler();
    }

    public function test_it_should_add_error_to_the_stack()
    {
        $this->message
            ->expects($this->once())
            ->method('getString')
            ->will($this->returnValue('message'));

        $this->handler->notifyError($this->message);
        $result = $this->handler->createResult();

        $this->assertInstanceOf('Star\Component\Validator\ValidationResult', $result);
        $this->assertTrue($result->hasErrors());
        $this->assertSame(array('message'), $result->getErrors());
    }

    public function test_it_should_not_throw_exception_when_no_error_registered()
    {
        $result = $this->handler->createResult();
        $this->assertInstanceOf('Star\Component\Validator\ValidationResult', $result);

        $this->assertFalse($result->hasErrors());
        $this->assertCount(0, $result->getErrors());
    }
}
 