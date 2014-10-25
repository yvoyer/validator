<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

/**
 * Class ValidationResultTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 *
 * @covers Star\Component\Validator\ValidationResult
 */
class ValidationResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ValidationResult
     */
    private $result;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $message;

    public function setUp()
    {
        $this->message = $this->getMock('Star\Component\Validator\Message\ErrorMessage');
        $this->result = new ValidationResult();
    }

    public function test_should_not_have_errors_when_no_messages()
    {
        $this->assertFalse($this->result->hasErrors());
        $this->assertSame(array(), $this->result->getErrors());
    }

    public function test_should_have_errors_when_messages_are_configured()
    {
        $this->message
            ->expects($this->any())
            ->method('getString')
            ->will($this->returnValue('message'));

        $result = new ValidationResult(array($this->message));

        $this->assertTrue($result->hasErrors());
        $this->assertSame(array('message'), $result->getErrors());
    }

    /**
     * @expectedException        \Star\Component\Validator\Exception\InvalidArgumentException
     * @expectedExceptionMessage Validation result only accepts ErrorMessage instances.
     */
    public function test_it_should_throw_exceptions_when_invalid_arguments()
    {
        new ValidationResult(array(new \stdClass()));
    }

    public function test_should_add_one_message_at_a_time()
    {
        $this->result->addError($this->message);
        $this->assertSame(array(''), $this->result->getErrors());
    }
}
 