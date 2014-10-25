<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

/**
 * Class CompositeValidatorTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 *
 * @covers Star\Component\Validator\CompositeValidator
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
            ->with($this->handler);
        $validator
            ->expects($this->at(1))
            ->method('validate')
            ->with($this->handler);

        $this->validator->addValidator($validator);
        $this->validator->addValidator($validator);

        $this->validator->validate($this->handler);
    }
}
 