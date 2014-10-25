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
    public function test_should_not_have_errors_when_no_messages()
    {
        $result = new ValidationResult(array());

        $this->assertFalse($result->hasErrors());
        $this->assertSame(array(), $result->getErrors());
    }

    public function test_should_have_errors_when_messages_are_configured()
    {
        $message = $this->getMock('Star\Component\Validator\Message\ErrorMessage');
        $message
            ->expects($this->any())
            ->method('getString')
            ->will($this->returnValue('message'));

        $result = new ValidationResult(array($message));

        $this->assertTrue($result->hasErrors());
        $this->assertSame(array('message'), $result->getErrors());
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Validation result only accepts ErrorMessage instances.
     */
    public function test_it_should_throw_exceptions_when_invalid_arguments()
    {
        new ValidationResult(array(new \stdClass()));
    }
}
 