<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator\Handler;

/**
 * Class ExceptionNotificationHandlerTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Handler
 *
 * @covers Star\Component\Validator\Handler\ExceptionNotificationHandler
 * @uses Star\Component\Validator\ValidationResult
 */
class ExceptionNotificationHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExceptionNotificationHandler
     */
    private $handler;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $message;

    public function setUp()
    {
        $this->message = $this->getMock('Star\Component\Validator\Message\ErrorMessage');
        $this->handler = new ExceptionNotificationHandler();
    }

    /**
     * @expectedException        \Star\Component\Validator\Exception\ValidationErrorException
     * @expectedExceptionMessage message
     */
    public function test_it_should_throw_an_exception_when_a_message_is_available()
    {
        $this->message
            ->expects($this->once())
            ->method('getString')
            ->will($this->returnValue('message'));

        $this->handler->notifyError($this->message);
    }

    public function test_it_should_not_throw_exception_when_no_error_registered()
    {
        $result = $this->handler->createResult();
        $this->assertInstanceOf('Star\Component\Validator\ValidationResult', $result);
        $this->assertFalse($result->hasErrors());
        $this->assertCount(0, $result->getErrors());
    }
}
 