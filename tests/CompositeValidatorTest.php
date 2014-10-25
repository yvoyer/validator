<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Star\Component\Validator\Message\StringMessage;

/**
 * Class CompositeValidatorTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 *
 * @covers Star\Component\Validator\CompositeValidator
 * @uses Star\Component\Validator\ValidationResult
 * @uses Star\Component\Validator\Message\StringMessage
 */
class CompositeValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CompositeValidator
     */
    private $validator;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $handler;

    public function setUp()
    {
        $this->handler = $this->getMock('Star\Component\Validator\Handler\NotificationHandler');
        $this->validator = new CompositeValidator();
    }

    public function test_it_should_contains_validators()
    {
        $validator = $this->getMock('Star\Component\Validator\Validator');
        $validator
            ->expects($this->at(0))
            ->method('validate')
            ->with($this->handler)
            ->will($this->returnValue(new ValidationResult(array(new StringMessage('message1')))));
        $validator
            ->expects($this->at(1))
            ->method('validate')
            ->with($this->handler)
            ->will($this->returnValue(new ValidationResult(array(new StringMessage('message2')))));

        $this->validator->addValidator($validator);
        $this->validator->addValidator($validator);

        $result = $this->validator->validate($this->handler);

        $this->assertInstanceOf('Star\Component\Validator\ValidationResult', $result);
        $this->assertSame(
            array(
                'message1',
                'message2',
            ),
            $result->getErrors()
        );
    }
}
 