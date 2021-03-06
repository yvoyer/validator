<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Star\Component\Validator\Handler\DeferredNotificationHandler;
use Star\Component\Validator\Handler\ExceptionNotificationHandler;
use Star\Component\Validator\Handler\NotificationHandler;
use Star\Component\Validator\Message\ObjectTraceMessage;
use Star\Component\Validator\Message\StringMessage;


/**
 * Class ValidationTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 */
class SomeValidationExampleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SomeObject
     */
    private $object;

    public function setUp()
    {
        $this->object = new SomeObject();
    }

    public function test_it_should_generate_errors()
    {
        $handler = new DeferredNotificationHandler();
        $this->object->validate($handler);

        $result = $handler->createResult();
        $this->assertTrue($result->hasErrors());
        $this->assertCount(1, $result->getErrors());
    }

    public function test_it_should_not_generate_errors()
    {
        $handler = new DeferredNotificationHandler();

        $this->object->setName('non-empty');
        $this->object->validate($handler);

        $result = $handler->createResult();
        $this->assertFalse($result->hasErrors());
        $this->assertCount(0, $result->getErrors());
    }

    /**
     * @expectedException \Star\Component\Validator\Exception\ValidationErrorException
     * @expectedExceptionMessage A validation error occurred on object 'Star\Component\Validator\SomeObject' with message: 'Name cannot be empty.'.
     */
    public function test_it_should_throw_exception_on_error()
    {
        $this->object->validate(new ExceptionNotificationHandler());
    }
}

class SomeValidator implements Validator
{
    /**
     * @var SomeObject
     */
    private $object;

    /**
     * @param SomeObject $object
     */
    public function __construct(SomeObject $object)
    {
        $this->object = $object;
    }

    /**
     * @param NotificationHandler $handler
     */
    public function validate(NotificationHandler $handler)
    {
        $name = $this->object->getName();
        if (empty($name)) {
            $message = new StringMessage('Name cannot be empty.');
            $handler->notifyError(new ObjectTraceMessage($this->object, $message));
        }
    }
}

class SomeObject
{
    /**
     * @var string
     */
    private $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param NotificationHandler $handler
     *
     * @return ValidationResult
     */
    public function validate(NotificationHandler $handler)
    {
        $validator = new SomeValidator($this);

        return $validator->validate($handler);
    }

    public function getName()
    {
        return $this->name;
    }
}