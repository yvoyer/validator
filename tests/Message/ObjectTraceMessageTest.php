<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator\Message;

/**
 * Class ObjectTraceMessageTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator\Message
 *
 * @covers Star\Component\Validator\Message\ObjectTraceMessage
 */
class ObjectTraceMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectTraceMessage
     */
    private $message;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $wrappedMessage;

    public function setUp()
    {
        $this->wrappedMessage = $this->getMock('Star\Component\Validator\Message\ErrorMessage');

        $this->message = new ObjectTraceMessage(new \stdClass(), $this->wrappedMessage);
    }

    public function test_it_should_return_the_type_of_object_the_error_occured_with()
    {
        $this->assertContains("A validation error occurred on object 'stdClass' ", $this->message->getString());
    }

    public function test_it_should_return_the_message_of_the_wrapped_message()
    {
        $this->wrappedMessage
            ->expects($this->once())
            ->method('getString')
            ->will($this->returnValue('wrapped-message'));

        $this->assertContains("with message: 'wrapped-message'.", $this->message->getString());
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The object argument must be an object.
     */
    public function test_it_should_throw_an_exception_if_the_object_is_of_wrong_type()
    {
        new ObjectTraceMessage('', $this->wrappedMessage);
    }
}
 